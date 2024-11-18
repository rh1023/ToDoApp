<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    //タスク一覧画面
    public function show()
    {
        // ログインユーザーIDを取得
        $userId = Auth::id();

        // ユーザーに関連するタスクを取得
        $tasks = Task::with(['users' => function ($query) use ($userId) {
            $query->where('user_id', $userId); // ログインユーザーの進捗状況のみ取得
        }])
            ->where(function ($query) use ($userId) {
                // 個人タスク
                $query->where(function ($q) use ($userId) {
                    $q->where('user_id', $userId)
                        ->where('type', '個人');
                })
                    // 任意タスク
                    ->orWhere(function ($q) use ($userId) {
                        $q->where('type', '任意')
                            ->where(function ($subQuery) use ($userId) {
                                $subQuery->where('status', '未着手')
                                    ->orWhere('progress_by', $userId)
                                    ->orWhere('completed_by', $userId);
                            });
                    })
                    // 共有タスク
                    ->orWhere(function ($q) use ($userId) {
                        $q->where('type', '共有')
                            ->whereHas('userStatus', function ($subQuery) use ($userId) {
                                $subQuery->where('user_id', $userId);
                            });
                    });
            })
            ->sortable()
            ->get();

        // 日付フォーマットの設定と進捗ステータスの割り当て
        foreach ($tasks as $task) {
            $task->formatted_deadline = $task->deadline ? Carbon::parse($task->deadline)->format('Y年n月j日') : null;
        }

        // tasklistビューにタスクを渡す
        return view('tasklist', compact('tasks'));
    }


    //タスク追加画面
    public function create()
    {

        $users = User::all(); // 全ユーザー取得
        return view('taskadd', compact('users'));
    }

    //タスクの保存処理
    public function store(Request $request)
    {
        //バリデーション
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'important' => 'required|integer|min:1|max:5',
                'deadline' => 'nullable|date',
                'repeat' => 'nullable|string|max:255',
                'detail' => 'nullable|string',
                'type' => 'required|string|in:個人,共有,任意',
                'user_ids' => 'nullable|array', // 共有タスクに関連するユーザーIDの配列
                'user_ids.*' => 'exists:users,id', // ユーザーIDが存在するか確認
            ]
        );

        //タスクの作成
        $task = Task::create(
            [
                'user_id' => Auth::id(),
                'title' => $request->title,
                'category' => $request->category,
                'type' => $request->type,
                'important' => $request->important,
                'status' => $request->status,
                'deadline' => $request->deadline,
                'repeat' => $request->repeat,
                'score' => 0,
                'detail' => $request->detail
            ]
        );

        // タスクのスコアを計算して保存
        $task->score = $task->calculateScore();
        $task->save();

        if ($task->type === '共有') {
            $allUserIds = User::pluck('id')->toArray(); // 全ユーザーのIDを取得
            foreach ($allUserIds as $userId) {
                $task->users()->attach($userId, [
                    'status' => '未着手',
                    'score' => $task->calculateScore(), // スコアを中間テーブルに保存
                ]);
            }
        }

        return redirect()->route('tasklist.show')->with('success', 'タスクが追加されました');
    }


    //タスク詳細
    public function detail($id)
    {
        $task = Task::findOrFail($id);
        return view('taskdetail', compact('task'));
    }


    //タスク編集
    public function edit($id)
    {
        $task = Task::with(['userStatus'])->findOrFail($id);

        // アクセス制御
        if ($task->type === '共有') {
            if (!$task->userStatus->contains('id', Auth::id())) {
                abort(403, 'このタスクを編集する権限がありません。');
            }

            // 共有タスクの場合、中間テーブルのデータを取得
            $userStatus = $task->userStatus->firstWhere('id', Auth::id())->pivot;
        } elseif ($task->type === '個人' || $task->type === '任意') {
            if ($task->user_id !== Auth::id()) {
                abort(403, 'このタスクを編集する権限がありません。');
            }

            // 個人タスクまたは任意タスクの場合、直接タスクのステータスを使用
            $userStatus = (object) [
                'status' => $task->status,
                'completed_at' => $task->updated_at,
            ];
        }

        return view('taskedit', [
            'task' => $task,
            'userStatus' => $userStatus,
        ]);
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $userId = Auth::id();

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'important' => 'required|integer|min:1|max:5',
            'deadline' => 'nullable|date',
            'repeat' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'status' => 'required|string|max:255',
            'type' => 'required|string|in:個人,共有,任意',
        ]);

        $oldType = $task->type;
        $oldStatus = $task->status;
        $newType = $request->type;
        $newStatus = $request->status;

        // タスクデータの更新
        $task->update([
            'title' => $request->title,
            'category' => $request->category,
            'type' => $newType,
            'important' => $request->important,
            'status' => $newStatus,
            'deadline' => $request->deadline,
            'repeat' => $request->repeat,
            'detail' => $request->detail,
        ]);

        // タスクが「個人」から「共有」に変更された場合
        if ($oldType === '個人' && $newType === '共有') {
            $allUserIds = User::pluck('id')->toArray(); // 全ユーザーのIDを取得
            foreach ($allUserIds as $userId) {
                $task->users()->attach($userId, ['status' => '未着手']); // 中間テーブルにデータを追加
            }
        }

        // タスクが「進行中」状態に変更された場合の処理
        if ($oldStatus !== '進行中' && $newStatus === '進行中') {
            $task->progress_by = Auth::id();
            $task->save();
        }

        // タスクが「完了」状態に変更された場合の処理
        if ($oldStatus !== '完了' && $newStatus === '完了') {
            // 中間テーブルで完了状況とスコアを更新
            $task->users()->updateExistingPivot(Auth::id(), [
                'status' => '完了',
                'completed_at' => now(),
                'completed_by' => Auth::id(),
                'score' => $task->calculateScore(), // スコアを計算して保存
            ]);
            // tasksテーブルの`completed_by`を更新
            $task->completed_by = Auth::id();
            $task->save();
            return redirect()->route('tasklist.show')->with('success', 'タスクが完了し、スコアが付与されました。');
        }

        // タスクが共有タスクの場合、中間テーブルを更新
        if ($newType === '共有') {
            $allUserIds = User::pluck('id')->toArray(); // 全ユーザーIDを取得
            foreach ($allUserIds as $userId) {
                $task->users()->wherePivot('user_id', Auth::id())->updateExistingPivot(Auth::id(), [
                    'status' => '完了',
                    'completed_at' => now(),
                    'completed_by' => Auth::id(),
                    'score' => $task->calculateScore(),
                ]);
            }
        }

        // タスクのスコア更新
        $task->score = $task->calculateScore();
        $task->save();

        return redirect()->route('tasklist.show')->with('success', 'タスクが更新されました');
    }


    //タスクの削除
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasklist.show')->with('success', 'タスクが削除されました');
    }
}

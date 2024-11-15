<?php
//共有タスクの中間テーブル作成。処理未実装

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

        $tasks = Task::where(function ($query) use ($userId) {
            //個人タスク
            $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)
                    ->where('type', '個人');
            })
                //共有タスク
                ->orWhere(function ($q) use ($userId) {
                    $q->where('user_id', $userId)
                        ->where('type', '共有');
                })

                //任意タスク
                ->orWhere(function ($q) use ($userId) {
                    $q->where('type', '任意')
                        ->where('status', '未着手')
                        ->orWhere('progress_by', $userId)
                        ->orWhere('completed_by', $userId);
                });
        })
            ->sortable()->get();



        // 日付フォーマットの設定
        foreach ($tasks as $task) {
            $task->formatted_deadline = Carbon::parse($task->deadline)->format('Y年n月j日');
        }

        // tasklistビューにタスクを渡す
        return view('tasklist', compact('tasks'));
    }

    //タスク追加画面
    public function create()
    {
        return view('taskadd');
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
                'detail' => 'nullable|string'

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
                // 'status' => '未着手',
                'status' => $request->status,
                'deadline' => $request->deadline,
                'repeat' => $request->repeat,
                'score' => 0,
                'detail' => $request->detail
            ]
        );

        $task->score = $task->calculateScore();
        $task->save();

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
        $task = Task::findOrFail($id);
        return view('taskedit', compact('task'));
    }

    //タスク更新
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'important' => 'required|integer|min:1|max:5',
            'deadline' => 'nullable|date',
            'repeat' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'status' => 'required|string|max:255',
        ]);

        $oldStatus = $task->status;
        $newStatus = $request->status;

        $task->update([
            'title' => $request->title,
            'category' => $request->category,
            'type' => $request->type,
            'important' => $request->important,
            'status' => $newStatus,
            'deadline' => $request->deadline,
            'repeat' => $request->repeat,
            'detail' => $request->detail,
        ]);

        //タスクが進行中状態に変更された場合の処理
        if ($oldStatus !== '進行中' && $newStatus === '進行中') {
            $task->progress_by = Auth::id();
            $task->save();
        }

        // タスクが完了状態に変更された場合の処理
        if ($oldStatus !== '完了' && $newStatus === '完了') {
            $task->completed_by = Auth::id();
            $task->save();

            // 完了したユーザーにスコア加算
            $completedUser = Task::find($task->completed_by);
            if ($completedUser) {
                $completedUser->score += $task->score;
                $completedUser->save();
            }

            return redirect()->route('tasklist.show')->with('success', 'タスクが完了し、スコアが付与されました。');
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

    // 共有タスクの完了処理

}

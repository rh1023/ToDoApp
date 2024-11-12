<?php
// 24.11.11
// タスクの追加
// タスクの更新
// タスクの削除
// の機能追加
// 24.11.12
// タスクの並び替え機能（sortable)
//タスクの繰り返し処理を実装
//日付フォーマットを2024-11-12から2024年11月12日に変更

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    //タスク一覧画面
    public function taskshow()
    {
        // ログインユーザーのタスクを取得
        $tasks = Task::where('user_id', Auth::id())
            ->sortable()
            ->get();

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
                'status' => '未着手',
                'deadline' => $request->deadline,
                'repeat' => $request->repeat,
                'score' => 0,
                'detail' => $request->detail
            ]
        );

        $task->score = $task->calculateScore();
        $task->save();

        //リダイレクト
        return redirect()->route('tasklist.taskshow')->with('success', 'タスクが追加されました');
    }

    //タスク編集画面
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

        $task->update([
            'title' => $request->title,
            'category' => $request->category,
            'type' => $request->type,
            'important' => $request->important,
            'status' => $request->status,
            'deadline' => $request->deadline,
            'repeat' => $request->repeat,
            'detail' => $request->detail
        ]);

        $task->score = $task->calculateScore();
        $task->save();

        return redirect()->route('tasklist.taskshow')->with('success', 'タスクが更新されました');
    }

    //タスクの削除
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasklist.taskshow')->with('success', 'タスクが削除されました');
    }

    //タスクの繰り返し
    private function parseRepeatData($repeatString)
    {
        if (empty($repeatString)) {
            return null;
        }

        $parts = explode(':', $repeatString);
        $type = $parts[0];

        switch ($type) {
            case 'daily':
                return ['type' => 'daily'];
            case 'weekly':
                return ['type' => 'weekly', 'day' => (int)$parts[1]];
            case 'monthly':
                if (strpos($parts[1], 'week') !== false) {
                    $weekParts = explode('-', $parts[1]);
                    return ['type' => 'monthly', 'week' => (int)$weekParts[0], 'weekday' => (int)$weekParts[1]];
                } else {
                    return ['type' => 'monthly', 'date' => (int)$parts[1]];
                }
            default:
                return null;
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //タスク一覧画面
    public function taskshow()
    {
        // return view('tasklist');
        $tasks = Task::where('user_id', Auth::id())->get(); // ログインユーザーのタスクを取得
        return view('tasklist', compact('tasks')); // tasklistビューにタスクを渡す
    }

    //タスク追加編集画面
    public function create()
    {
        return view('taskadd');
    }

    //タスクの保存処理
    public function store(Request $request)
    {
        //リクエストデータの確認
        // dd($request->all());

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
        Task::create(
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

        //リダイレクト
        return redirect()->route('tasklist.taskshow')->with('success', 'タスクが追加されました');
    }
}

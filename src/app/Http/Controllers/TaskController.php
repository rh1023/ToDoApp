<?php
//11.14メモ
//タスク完了者がデータベースで保存されない
//完了者によってスコアが加算される仕組みにしたい

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    //タスク一覧画面
    public function show()
    {
        // ログインユーザーIDを取得
        $userId = Auth::id();

        // ログインユーザーの個人タスク、他者の共有タスク、任意タスクを取得
        $tasks = Task::where(function ($query) use ($userId) {
            $query->where('user_id', $userId) // 自分の個人タスク
                ->orWhere('type', '共有') // 共有タスクは全員に表示
                ->orWhere(function ($q) use ($userId) {
                    $q->where('type', '任意')
                        ->where(function ($subQuery) use ($userId) {
                            $subQuery->whereNull('completed_by') // 完了していない任意タスク
                                ->orWhere('completed_by', $userId); // 自分が完了した任意タスク
                        });
                });
        })->sortable()->get();

        //デバッグ（ここで取得したタスクの内容を確認する）
        //dd($tasks);

        // 日付フォーマットの設定
        foreach ($tasks as $task) {
            $task->formatted_deadline = Carbon::parse($task->deadline)->format('Y年n月j日');
        }

        // tasklistビューにタスクを渡す
        return view('tasklist', compact('tasks'));
    }

    //----------------------------------------------------------------------------------------------------

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

        //リダイレクト
        return redirect()->route('tasklist.show')->with('success', 'タスクが追加されました');
    }


    //タスク詳細
    // public function detail($id){
    //     $task = Task::findOrFail($id);
    //     return view('taskdetail', compact('task'));
    // }


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

        //タスクのスコア更新
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

    // タスク完了処理
    public function complete($id)
{
    $task = Task::findOrFail($id);
    $userId = Auth::id();

    // タスクがすでに完了しているかチェック
    if ($task->status === '完了') {
        return redirect()->route('tasklist.show')->withErrors("このタスクはすでに完了しています。");
    }

    // 完了者を記録
    $task->completed_by = $userId;
    Log::info("Setting completed_by to: " . $userId); // デバッグログ

    // ステータスを完了に設定
    $task->status = '完了';

    // スコア計算
    $score = $task->calculateScore();
    $task->score += $score;

    // タスクを保存
    if (!$task->save()) {
        Log::error("Failed to save task with ID: {$task->id}");
    } else {
        Log::info("Task saved successfully with completed_by: " . $task->completed_by);
    }

    return redirect()->route('tasklist.show')->with('success', "タスク '{$task->title}' を完了しました。");
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 今日の日付を取得
        $today = Carbon::now()->format('Y年 m月 d日');

        // 本日のスコア（完了タスクの合計）
        $todayScore = Task::where('user_id', Auth::id())
            ->whereDate('updated_at', Carbon::today())
            ->where('status', '完了')
            ->sum('score');

        // 各ステータスごとのタスクを取得
        $inProgressTasks = Task::where('user_id', Auth::id())
            ->where('status', '進行中')
            // ->whereDate('deadline', Carbon::today())
            // ->select('title', 'detail') // 取り出すカラムを指定
            ->get();
        $notStartedTasks = Task::where('user_id', Auth::id())
            ->where('status', '未着手')
            // ->whereDate('deadline', Carbon::today())
            ->get();
        $completedTasks = Task::where('user_id', Auth::id())
            ->where('status', '完了')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        // ユーザーの情報の取得
        $users = User::select('name')->get();

        // 各ユーザーごとに達成タスクのスコアを計算
        foreach ($users as $user) {
            $user->todayScore = Task::where('user_id', $user->id)
                ->whereDate('updated_at', Carbon::today())
                ->where('status', '完了')
                ->sum('score');

            // 進行中タスクを取得
            $user->inProgressTasks = Task::where('user_id', $user->id)
                ->where('status', '進行中')
                ->get();
        }

        return view('dashboard', compact(
            'today',
            'todayScore',
            'inProgressTasks',
            'notStartedTasks',
            'completedTasks',
            'users'
        ));
    }
}

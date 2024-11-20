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
        $userId = Auth::id();

        // 今日の日付を取得
        $today = Carbon::now()->format('Y年m月d日');

        // 本日のスコア（個人、任意、共有タスクの合計）
        $todayScore = Task::where(function ($query) use ($userId) {
            $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId) // 個人タスク
                    ->whereNotNull('completed_by') // 完了済み
                    ->where('completed_by', $userId);
            })->orWhereHas('users', function ($q) use ($userId) {
                $q->where('user_id', $userId) // 任意・共有タスク
                    ->where('status', '完了')
                    ->whereNotNull('task_user.completed_by');
            });
        })->whereDate('updated_at', Carbon::today())
            ->sum('score');

        // ステータスごとのタスクを取得
        $inProgressTasks = Task::with('users')
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhereHas('users', function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    });
            })
            ->where('status', '進行中')
            ->get();

        $notStartedTasks = Task::with('users')
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhereHas('users', function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    });
            })
            ->where('status', '未着手')
            ->get();

        $completedTasks = Task::with('users')
            ->where(function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orWhereHas('users', function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    });
            })
            ->where('status', '完了')
            ->whereDate('updated_at', Carbon::today())
            ->get();

        return view('dashboard', compact(
            'today',
            'todayScore',
            'inProgressTasks',
            'notStartedTasks',
            'completedTasks'
        ));
    }
}

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
                    ->where('type', '個人')
                    ->whereNotNull('completed_by') // 完了済み
                    ->where('completed_by', $userId);
            })->orWhere(function ($q) use ($userId) {
                $q->where('type', '任意') // 任意タスク
                    ->where('completed_by', $userId); // 自分が完了した任意タスク
            })->orWhereHas('users', function ($q) use ($userId) {
                $q->where('user_id', $userId) // 共有タスク
                    ->where('status', '完了')
                    ->whereNotNull('task_user.completed_by');
            });
        })->whereDate('updated_at', Carbon::today())
            ->sum('score');


        // 未着手タスク（個人および任意）
        $notStartedTasks = Task::where(function ($query) use ($userId) {
            $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)
                    ->where('type', '個人')
                    ->where('status', '未着手');
            })->orWhere(function ($q) use ($userId) {
                $q->where('type', '任意')
                    ->whereNull('progress_by')
                    ->where('status', '未着手');
            });
        })->get();

        // 未着手タスク（共有）
        $notStartedSharedTasks = Task::whereHas('users', function ($q) use ($userId) {
            $q->where('user_id', $userId)
                ->where('task_user.status', '未着手');
        })->get();

        // 全ての未着手タスクを結合
        $allNotStartedTasks = $notStartedTasks->merge($notStartedSharedTasks);


        // 進行中タスク（個人および任意）
        $inProgressTasks = Task::where(function ($query) use ($userId) {
            $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)
                    ->where('type', '個人')
                    ->where('status', '進行中');
            })->orWhere(function ($q) use ($userId) {
                $q->where('type', '任意')
                    ->where('progress_by', $userId)
                    ->where('status', '進行中');
            });
        })->get();

        // 進行中タスク（共有）
        $inProgressSharedTasks = Task::whereHas('users', function ($q) use ($userId) {
            $q->where('user_id', $userId)
                ->where('task_user.status', '進行中');
        })->get();

        // 全ての進行中タスクを結合
        $allInProgressTasks = $inProgressTasks->merge($inProgressSharedTasks);


        // 完了タスク（個人および任意）
        $completedTasks = Task::where(function ($query) use ($userId) {
            $query->where(function ($q) use ($userId) {
                $q->where('user_id', $userId)
                    ->where('type', '個人')
                    ->where('completed_by', $userId)
                    ->where('status', '完了');
            })->orWhere(function ($q) use ($userId) {
                $q->where('type', '任意')
                    ->where('completed_by', $userId)
                    ->where('status', '完了');
            });
        })->get();

        // 完了タスク（共有）
        $completedSharedTasks = Task::whereHas('users', function ($q) use ($userId) {
            $q->where('user_id', $userId)
                ->where('task_user.status', '完了');
        })->get();

        // 全ての完了タスクを結合
        $allCompletedTasks = $completedTasks->merge($completedSharedTasks);

        return view('dashboard', compact(
            'today',
            'todayScore',
            'allNotStartedTasks',
            'allInProgressTasks',
            'allCompletedTasks'
        ));
    }
}

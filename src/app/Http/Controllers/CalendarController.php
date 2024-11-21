<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 月間スコアを取得
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // 個人タスクの完了を取得（`updated_at`を完了日時として扱う）
        $personalTasks = Task::where('user_id', $userId)
            ->where('type', '個人')
            ->where('status', '完了')
            ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
            ->get();

        // 任意タスクの完了を取得（`updated_at`を完了日時として扱う）
        $optionalTasks = Task::where('type', '任意')
            ->where('completed_by', $userId)
            ->where('status', '完了')
            ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
            ->get();

        // 共有タスクの完了を取得
        $sharedTasks = Task::where('type', '共有')
            ->whereHas('users', function ($query) use ($userId, $startOfMonth, $endOfMonth) {
                $query->where('user_id', $userId)
                    ->where('status', '完了')
                    ->whereBetween('task_user.completed_at', [$startOfMonth, $endOfMonth]);
            })
            ->with(['users' => function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('status', '完了');
            }])
            ->get();

        // 全タスクを統合
        $tasks = $personalTasks->merge($optionalTasks)->merge($sharedTasks);

        // FullCalendar用のイベントデータを準備
        $events = [];
        foreach ($tasks as $task) {
            $completedAt = $task->updated_at; // 個人・任意タスクの完了日時

            // 共有タスクの場合は中間テーブルの`completed_at`
            if ($task->type === '共有') {
                $completedAt = $task->users->firstWhere('id', $userId)?->pivot->completed_at;
            }

            if ($completedAt) {
                $date = Carbon::parse($completedAt)->format('Y-m-d');
                $events[] = [
                    'title' => $task->title . ' ( スコア：' . $task->score . ')',
                    'start' => $date,
                    // 'url'   => route('historycalendar.show', $date),
                ];
            }
        }

        return view('historycalendar', compact('events'));
    }

    public function show($date)
    {
        $userId = Auth::id();

        // 個人タスクの完了を取得
        $personalTasks = Task::where('user_id', $userId)
            ->where('type', '個人')
            ->where('status', '完了')
            ->whereDate('updated_at', $date)
            ->get();

        // 任意タスクの完了を取得
        $optionalTasks = Task::where('type', '任意')
            ->where('completed_by', $userId)
            ->where('status', '完了')
            ->whereDate('updated_at', $date)
            ->get();

        // 共有タスクの完了を取得
        $sharedTasks = Task::where('type', '共有')
            ->whereHas('users', function ($query) use ($userId, $date) {
                $query->where('user_id', $userId)
                    ->where('status', '完了')
                    ->whereDate('task_user.completed_at', $date);
            })
            ->with(['users' => function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('status', '完了');
            }])
            ->get();

        // 全タスクを統合
        $tasks = $personalTasks->merge($optionalTasks)->merge($sharedTasks);

        return view('calendardetail', compact('tasks', 'date'));
    }
}

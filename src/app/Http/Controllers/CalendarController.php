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

        $tasks = Task::with(['users' => function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('status', '完了');
        }])
            ->whereHas('users', function ($query) use ($userId, $startOfMonth, $endOfMonth) {
                $query->where('user_id', $userId)
                    ->whereBetween('completed_at', [$startOfMonth, $endOfMonth]);
            })
            ->get();

        // FullCalendar用のイベントデータを準備
        $events = [];
        foreach ($tasks as $task) {
            $completedAt = $task->users->first()->pivot->completed_at ?? null;

            if ($completedAt) {
                $date = Carbon::parse($completedAt)->format('Y-m-d');
                $events[] = [
                    'title' => $task->title . ' (スコア: ' . $task->score . ')',
                    'start' => $date,
                    'url'   => route('historycalendar.show', $date)
                ];
            }
        }

        return view('historycalendar', compact('events'));
    }


    // 特定日のタスク詳細
    public function show($date)
    {
        $userId = Auth::id();

        // 完了したタスクを取得
        $tasks = Task::with(['users' => function ($query) use ($userId, $date) {
            $query->where('user_id', $userId)
                ->where('status', '完了')
                ->whereDate('completed_at', $date);
        }])
            ->whereHas('users', function ($query) use ($userId, $date) {
                $query->where('user_id', $userId)
                    ->where('status', '完了')
                    ->whereDate('completed_at', $date);
            })
            ->get();

        return view('calendardetail', compact('tasks', 'date'));
    }
}

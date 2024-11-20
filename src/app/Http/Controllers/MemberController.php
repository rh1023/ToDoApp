<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function show()
    {
        $members = User::all();

        foreach ($members as $member) {
            $memberId = $member->id;

            // 各メンバーのスコア計算（個人、任意、共有タスク）
            $member->todayScore = Task::where(function ($query) use ($memberId) {
                $query->where(function ($q) use ($memberId) {
                    $q->where('user_id', $memberId) // 個人タスク
                        ->whereNotNull('completed_by') // 完了済み
                        ->where('completed_by', $memberId);
                })->orWhereHas('users', function ($q) use ($memberId) {
                    $q->where('user_id', $memberId) // 任意・共有タスク
                        ->where('status', '完了')
                        ->whereNotNull('task_user.completed_by');
                });
            })
                ->whereDate('updated_at', Carbon::today())
                ->sum('score');

            // 進行中タスク
            $member->inProgressTasks = Task::with('users')
                ->where(function ($query) use ($memberId) {
                    $query->where('user_id', $memberId)
                        ->orWhereHas('users', function ($q) use ($memberId) {
                            $q->where('user_id', $memberId);
                        });
                })
                ->where('status', '進行中')
                ->get();

            // 未着手タスク
            $member->notStartedTasks = Task::with('users')
                ->where(function ($query) use ($memberId) {
                    $query->where('user_id', $memberId)
                        ->orWhereHas('users', function ($q) use ($memberId) {
                            $q->where('user_id', $memberId);
                        });
                })
                ->where('status', '未着手')
                ->get();

            // 完了タスク
            $member->completedTasks = Task::with('users')
                ->where(function ($query) use ($memberId) {
                    $query->where('user_id', $memberId)
                        ->orWhereHas('users', function ($q) use ($memberId) {
                            $q->where('user_id', $memberId);
                        });
                })
                ->where('status', '完了')
                ->whereDate('updated_at', Carbon::today())
                ->get();
        }

        return view('memberlist', compact('members'));
    }
}

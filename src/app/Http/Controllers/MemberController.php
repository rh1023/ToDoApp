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

            $member->todayScore = Task::where(function ($query) use ($memberId) {
                $query->where(function ($q) use ($memberId) {
                    $q->where('user_id', $memberId) // 個人タスク
                        ->whereNotNull('completed_by') // 完了済み
                        ->where('completed_by', $memberId);
                })->orWhere(function ($q) use ($memberId) {
                    $q->where('type', '任意') // 任意タスク
                        ->where('completed_by', $memberId); // 自分が完了した任意タスク
                })->orWhereHas('users', function ($q) use ($memberId) {
                    $q->where('user_id', $memberId) // 共有タスク
                        ->where('status', '完了')
                        ->whereNotNull('task_user.completed_by');
                });
            })->whereDate('updated_at', Carbon::today())
                ->sum('score');


            // 未着手タスク（個人および任意）
            $notStartedPersonalAndOptional = Task::where(function ($query) use ($memberId) {
                $query->where('user_id', $memberId)
                    ->orWhere(function ($q) use ($memberId) {
                        $q->where('type', '任意')
                            ->whereNull('progress_by');
                    });
            })->where('status', '未着手')->get();

            // 未着手タスク（共有）
            $notStartedShared = Task::whereHas('users', function ($q) use ($memberId) {
                $q->where('user_id', $memberId)
                    ->where('task_user.status', '未着手');
            })->get();

            $member->notStartedTasks = $notStartedPersonalAndOptional->merge($notStartedShared);


            // 進行中タスク（個人および任意）
            $inProgressPersonalAndOptional = Task::where(function ($query) use ($memberId) {
                $query->where('user_id', $memberId)
                    ->orWhere(function ($q) use ($memberId) {
                        $q->where('type', '任意')
                            ->where('progress_by', $memberId);
                    });
            })->where('status', '進行中')->get();

            // 進行中タスク（共有）
            $inProgressShared = Task::whereHas('users', function ($q) use ($memberId) {
                $q->where('user_id', $memberId)
                    ->where('task_user.status', '進行中');
            })->get();

            $member->inProgressTasks = $inProgressPersonalAndOptional->merge($inProgressShared);


            // 完了タスク（個人および任意）
            $completedPersonalAndOptional = Task::where(function ($query) use ($memberId) {
                $query->where(function ($q) use ($memberId) {
                    $q->where('user_id', $memberId)
                        ->where('type', '個人')
                        ->where('completed_by', $memberId);
                })->orWhere(function ($q) use ($memberId) {
                    $q->where('type', '任意')
                        ->where('completed_by', $memberId);
                });
            })->where('status', '完了')
                ->whereDate('updated_at', Carbon::today())
                ->get();

            // 完了タスク（共有）
            $completedShared = Task::whereHas('users', function ($q) use ($memberId) {
                $q->where('user_id', $memberId)
                    ->where('task_user.status', '完了');
            })->whereDate('updated_at', Carbon::today())
                ->get();

            $member->completedTasks = $completedPersonalAndOptional->merge($completedShared);
        }

        return view('memberlist', compact('members'));
    }
}

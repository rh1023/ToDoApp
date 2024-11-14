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
        // dd($members);
        foreach ($members as $member) {
            // 各メンバーの本日のスコア計算
            $member->todayScore = Task::where('user_id', $member->id)
                ->whereDate('updated_at', Carbon::today())
                ->where('status', '完了')
                ->sum('score'); // sum()メソッドを使用してスコアを合計

            // 各メンバーの進行中タスクを取得
            $member->inProgressTasks = Task::where('user_id', $member->id)
                ->where('status', '進行中')
                ->get();

            // 各メンバーの未着手タスクを取得
            $member->notStartedTasks = Task::where('user_id', $member->id)
                ->where('status', '未着手')
                ->get();

            // 各メンバーの完了タスクを取得（本日のみ）
            $member->completedTasks = Task::where('user_id', $member->id)
                ->where('status', '完了')
                ->whereDate('updated_at', Carbon::today())
                ->get();
        }

        return view('memberlist', compact('members'));
    }
}

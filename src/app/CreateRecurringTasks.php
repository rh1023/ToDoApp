<?php
//24.11.12
//繰り返し設定のために繰り返しタスク作成ジョブを用意

namespace App;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CreateRecurringTasks implements ShouldQueue
{
    public function __invoke()
    {
        $tasks = Task::whereNotNull('repeat')->get();

        foreach ($tasks as $task) {
            if ($task->shouldRepeat() && $task->deadline <= Carbon::now()) {
                $newTask = $task->createNextTask();
                Log::info("Created new recurring task: {$newTask->title}");
            }
        }

        Log::info('Recurring tasks have been processed.');
    }
}

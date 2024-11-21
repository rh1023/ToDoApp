<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        //個人タスク1
        Task::create([
            'user_id' => 1,
            'title' => "椎間板ヘルニア対策ストレッチ",
            'category' => '健康',
            'type' => '個人',
            'important' => 3,
            'status' => '未着手',
            'deadline' => now()->addDays(-1),
            'repeat' => null,
            'score' => 28,
            'detail' => "足を組んでお尻の筋肉を伸ばす",
        ]);

        Task::create([
            'user_id' => 1,
            'title' => "椎間板ヘルニア対策ストレッチ",
            'category' => '健康',
            'type' => '個人',
            'important' => 3,
            'status' => '未着手',
            'deadline' => now(),
            'repeat' => null,
            'score' => 30,
            'detail' => "足を組んでお尻の筋肉を伸ばす",
        ]);

        Task::create([
            'user_id' => 1,
            'title' => "朝ご飯にプロテインの摂取",
            'category' => '健康',
            'type' => '個人',
            'important' => 3,
            'status' => '完了',
            'deadline' => now(),
            'repeat' => null,
            'score' => 30,
            'detail' => "水と豆乳で飲む",
            'completed_by' => 1
        ]);

        //個人タスク2
        Task::create([
            'user_id' => 2,
            'title' => "ウォーキング：3000歩",
            'category' => '健康',
            'type' => '個人',
            'important' => 3,
            'status' => '未着手',
            'deadline' => now(),
            'repeat' => null,
            'score' => 30,
            'detail' => "職場から自宅まで徒歩で帰宅",
        ]);

        Task::create([
            'user_id' => 2,
            'title' => "次の日のお弁当を用意する",
            'category' => '家事',
            'type' => '個人',
            'important' => 2,
            'status' => '未着手',
            'deadline' => now(),
            'repeat' => null,
            'score' => 16,
            'detail' => "雨の日は、自重トレーニング",
        ]);

        Task::create([
            'user_id' => 2,
            'title' => "ポケポケパック開封",
            'category' => '趣味',
            'type' => '個人',
            'important' => 1,
            'status' => '完了',
            'deadline' => now(),
            'repeat' => null,
            'score' => 4,
            'detail' => "雨の日は、自重トレーニング",
            'completed_by' => 2
        ]);

        //----------

        // 共有タスク
        for ($i = 1; $i <= 1; $i++) {
            $task = Task::create([
                'user_id' => 1,
                'title' => "自作ToDoアプリ成果発表会",
                'category' => '仕事',
                'type' => '共有',
                'important' => 5,
                'status' => '未着手',
                'deadline' => now(),
                'repeat' => null,
                'score' => 30,
                'detail' => "発表時間は、10分間",
            ]);

            // 共有タスクの場合は全ユーザーを関連付ける
            $allUserIds = User::pluck('id')->toArray();
            foreach ($allUserIds as $otherUserId) {
                $task->users()->attach($otherUserId, ['status' => '未着手']);
            }
        }

        //----------

        // 任意タスク
        Task::create([
            'user_id' => 1,
            'title' => "プレゼン資料作成：テスト様",
            'category' => '仕事',
            'type' => '任意',
            'important' => 5,
            'status' => '未着手',
            'deadline' => now()->addDays(rand(1, 30)),
            'repeat' => null,
            'score' => 45,
            'detail' => "",
        ]);

        Task::create([
            'user_id' => 1,
            'title' => "エアコンのフィルター掃除",
            'category' => '家事',
            'type' => '任意',
            'important' => 3,
            'status' => '未着手',
            'deadline' => now()->addDays(rand(1, 30)),
            'repeat' => null,
            'score' => 36,
            'detail' => "",
        ]);
    }
}

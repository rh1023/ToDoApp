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

        // 個人タスク1
        Task::create([
            'user_id' => 1,
            'title' => "健康診断",
            'category' => '健康',
            'type' => '個人',
            'important' => 5,
            'status' => '未着手',
            'deadline' => now()->addDays(rand(1, 30)),
            'repeat' => null,
            'score' => 50,
            'detail' => "○○名古屋院：10:00～",
        ]);


        Task::create([
            'user_id' => 1,
            'title' => "腰痛対策ストレッチ",
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
            'title' => "腰痛対策ストレッチ",
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

        // 個人タスク2
        Task::create([
            'user_id' => 2,
            'title' => "夜更かしせず、早寝をする",
            'category' => '健康',
            'type' => '個人',
            'important' => 3,
            'status' => '未着手',
            'deadline' => now(),
            'repeat' => null,
            'score' => 30,
            'detail' => "日付変わる前には就寝",
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
            'title' => "カードゲームパック開封",
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

        // 個人タスク3
        Task::create([
            'user_id' => 3,
            'title' => "祖母への編み物",
            'category' => '趣味',
            'type' => '個人',
            'important' => 3,
            'status' => '未着手',
            'deadline' => now(),
            'repeat' => null,
            'score' => 12,
            'detail' => "マフラー制作",
        ]);

        Task::create([
            'user_id' => 3,
            'title' => "ビールを５杯以内に抑える",
            'category' => '健康',
            'type' => '個人',
            'important' => 5,
            'status' => '完了',
            'deadline' => now(),
            'repeat' => null,
            'score' => 50,
            'detail' => "名古屋駅周辺での飲み会",
            'completed_by' => 3
        ]);

        // 個人タスク4
        Task::create([
            'user_id' => 4,
            'title' => "ジムで筋トレ",
            'category' => '健康',
            'type' => '個人',
            'important' => 3,
            'status' => '未着手',
            'deadline' => now(),
            'repeat' => null,
            'score' => 30,
            'detail' => "体幹トレーニング4セット",
        ]);

        Task::create([
            'user_id' => 4,
            'title' => "ジムで筋トレ",
            'category' => '健康',
            'type' => '個人',
            'important' => 3,
            'status' => '完了',
            'deadline' => now(),
            'repeat' => null,
            'score' => 30,
            'detail' => "胸筋を中心に行う",
            'completed_by' => 4
        ]);

        // 個人タスク5
        Task::create([
            'user_id' => 5,
            'title' => "引っ越しをする",
            'category' => 'その他',
            'type' => '個人',
            'important' => 5,
            'status' => '未着手',
            'deadline' => now(),
            'repeat' => null,
            'score' => 20,
            'detail' => "名古屋市内に引っ越す",
        ]);

        Task::create([
            'user_id' => 5,
            'title' => "不動産に相談しにいく",
            'category' => 'その他',
            'type' => '個人',
            'important' => 5,
            'status' => '完了',
            'deadline' => now(),
            'repeat' => null,
            'score' => 20,
            'detail' => "胸筋を中心に行う",
            'completed_by' => 5
        ]);

        //----------

        // 共有タスク
        for ($i = 1; $i <= 1; $i++) {
            $task = Task::create([
                'user_id' => 1,
                'title' => "アンケートの回答依頼",
                'category' => '仕事',
                'type' => '共有',
                'important' => 5,
                'status' => '未着手',
                'deadline' => now(),
                'repeat' => null,
                'score' => 30,
                'detail' => "仕事後の飲み会の日程について",
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
            'title' => "プレゼンテーション資料作成",
            'category' => '仕事',
            'type' => '任意',
            'important' => 5,
            'status' => '未着手',
            'deadline' => now()->addDays(rand(1, 30)),
            'repeat' => null,
            'score' => 45,
            'detail' => "",
        ]);
    }
}

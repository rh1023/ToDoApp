<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Task extends Model
{
    //複数代入の脆弱性に対応
    protected $fillable = ['user_id', 'title', 'category', 'type', 'important', 'status', 'deadline', 'repeat', 'score', 'detail'];

    //ソフトデリート、ソート
    use SoftDeletes, Sortable;

    //ソート使う項目
    public $sortable = ['status', 'title', 'deadline', 'category', 'type', 'important', 'score'];

    //TaskモデルとUserモデルに多対多のリレーションシップ定義
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user')->withPivot('status', 'completed_at');
    }

    //スコア計算
    public function calculateScore()
    {
        $score = 0;

        // カテゴリによるスコア加算
        switch ($this->category) {
            case '家事':
                $score += 4;
                break;
            case '仕事':
                $score += 3;
                break;
            case '健康':
                $score += 5;
                break;
            case '自己研鑽':
                $score += 5;
                break;
            case '趣味':
                $score += 2;
                break;
            default:
                $score += 2;
                break;
        }

        // 重要度の倍率
        $score *= $this->important;

        // タスク種類の倍率
        switch ($this->type) {
            case '個人':
                $score *= 2;
                break;
            case '共有':
                $score *= 2;
                break;
            case '任意':
                $score *= 3;
                break;
        }

        // ペナルティの計算
        if ($this->deadline) {
            $deadline = Carbon::parse($this->deadline);

            if (now()->isAfter($deadline)) { // 締め切りを過ぎている場合
                $daysOverdue = now()->diffInDays($deadline, false); // 負の値も許容

                if ($daysOverdue < 0) {
                    $penaltyDays = abs(floor($daysOverdue)); // 小数を切り捨てて絶対値を取得
                    $score -= ($penaltyDays - 1) * 2; // 超過日数×2のペナルティ(当日もカウントされるので日数を-1)
                }
            }
        }

        return max(round($score), 0); // スコアは最低0
    }


    //中間テーブルの情報を簡単に扱えるようにスコープやリレーションを拡張
    public function userStatus()
    {
        return $this->belongsToMany(User::class, 'task_user')
            ->withPivot('status', 'completed_at', 'completed_by');
    }
}

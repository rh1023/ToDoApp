<?php
//24.11.12
//繰り返し設定、繰り返しタスクを新規で自動追加を実装

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;

class Task extends Model
{
    //複数代入の脆弱性に対応
    protected $fillable = ['user_id', 'title', 'category', 'type', 'important', 'status', 'deadline', 'repeat', 'score', 'detail'];

    //ソフトデリート、ソート
    use SoftDeletes, Sortable;

    //ソート使う項目
    public $sortable = ['status', 'title', 'deadline', 'category', 'type', 'important', 'score'];

    //スコア計算
    public function calculateScore()
    {
        $score = 0;

        //カテゴリ
        switch ($this->category) {
            case '家事':
                $score += 3;
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
                $score += 1;
                break;

            default:
                $score += 1;
                break;
        }
        //重要度
        $score += $this->important;

        //タスク種類
        switch ($this->type) {
            case '個人':
                $score += 1;
                break;
            case '共有':
                $score += 1;
                break;
            case '任意':
                $score += 3;
                break;
        }

        return round($score);
    }

    //繰り返し設定
    public function shouldRepeat()
    {
        if (!$this->repeat) {
            return false;
        }

        $today = Carbon::now();

        switch ($this->repeat['type']) {
            case 'daily':
                return true;
            case 'weekly':
                return $today->dayOfWeek == $this->repeat['day'];
            case 'monthly':
                if (isset($this->repeat['date'])) {
                    return $today->day == $this->repeat['date'];
                } elseif (isset($this->repeat['week']) && isset($this->repeat['weekday'])) {
                    return $today->weekOfMonth == $this->repeat['week'] && $today->dayOfWeek == $this->repeat['weekday'];
                }
        }

        return false;
    }

    //繰り返し追加タスク
    public function createNextTask()
    {
        $nextTask = $this->replicate();
        $nextTask->status = '未着手';
        $nextTask->deadline = $this->calculateNextDeadline();
        $nextTask->save();

        return $nextTask;
    }

    private function calculateNextDeadline()
    {
        $current = Carbon::parse($this->deadline);

        switch ($this->repeat['type']) {
            case 'daily':
                return $current->addDay();
            case 'weekly':
                return $current->addWeek();
            case 'monthly':
                if (isset($this->repeat['date'])) {
                    return $current->addMonth()->setDay($this->repeat['date']);
                } elseif (isset($this->repeat['week']) && isset($this->repeat['weekday'])) {
                    return $current->addMonth()->nthOfMonth($this->repeat['week'], $this->repeat['weekday']);
                }
        }

        return $current;
    }

}

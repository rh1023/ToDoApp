<?php
//24.11.12
//繰り返し設定、繰り返しタスクを新規で自動追加を実装？
//24/11/13
//繰り返し処理なし（除外）→ 控えのメモに移動

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


}

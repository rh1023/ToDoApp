<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //複数代入の脆弱性に対応
    protected $fillable =[ 'user_id', 'title', 'category', 'type', 'important', 'status', 'deadline', 'repeat', 'score', 'detail'];
}

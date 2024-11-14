<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            //カラム追加
            $table->id();
            $table->string('user_id');
            $table->string('title'); //タスク名
            $table->string('category'); //カテゴリ
            $table->string('type'); //タスク区分
            $table->integer('important')->default(1); //重要度
            $table->string('status')->default('未着手'); //進捗ステータス
            $table->date('deadline')->nullable(); //期日
            $table->string('repeat')->nullable(); //繰り返し登録
            $table->integer('score')->default(0); //スコア
            $table->text('detail')->nullable(); //詳細
            $table->integer('completed_by')->nullable(); //完了者
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

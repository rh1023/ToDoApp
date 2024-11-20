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
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 作成者
            $table->string('title', 20); // タスク名
            $table->string('category'); // カテゴリ
            $table->string('type'); // タスク区分
            $table->integer('important')->default(1); // 重要度
            $table->string('status')->default('未着手'); // 進捗ステータス
            $table->date('deadline')->nullable(); // 期日
            $table->string('repeat')->nullable(); // 繰り返し登録
            $table->integer('score')->default(0); // スコア
            $table->text('detail')->nullable(); // 詳細
            $table->integer('completed_by')->nullable(); // 完了者
            $table->timestamps();
            $table->softDeletes();

            // 進行中のユーザー（進捗管理）
            $table->unsignedBigInteger('progress_by')->nullable(); // 進行中
            $table->foreign('progress_by')->references('id')->on('users')->onDelete('set null'); // 外部キー制約
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

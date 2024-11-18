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
        Schema::create('task_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('未着手');
            $table->timestamp('completed_at')->nullable(); // 完了日時
            $table->timestamps();
            $table->softDeletes();

            // 進行中のユーザー（進捗管理）
            $table->unsignedBigInteger('progress_by')->nullable(); // 進行中
            $table->foreign('progress_by')->references('id')->on('users')->onDelete('set null'); // 外部キー制約

            // 完了したユーザー（unsignedBigIntegerに変更）
            $table->unsignedBigInteger('completed_by')->nullable(); // unsignedBigIntegerに変更
            $table->foreign('completed_by')->references('id')->on('users')->onDelete('set null'); // 外部キー制約
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_user');
    }
};

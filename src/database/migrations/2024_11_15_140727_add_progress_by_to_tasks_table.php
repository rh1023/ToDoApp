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
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('progress_by')->nullable()->after('completed_by'); // 進行中
            $table->foreign('progress_by')->references('id')->on('users')->onDelete('set null'); // 外部キー制約
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['progress_by']); // 外部キー制約の削除
            $table->dropColumn('progress_by'); // カラム削除
        });
    }
};

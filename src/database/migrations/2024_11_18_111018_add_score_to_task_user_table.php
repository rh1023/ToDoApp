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
        Schema::table('task_user', function (Blueprint $table) {
            //
            $table->integer('score')->default(0)->after('completed_by'); // デフォルト値は0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('task_user', function (Blueprint $table) {
            //
            $table->dropColumn('score');
        });
    }
};

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
            $table->string('title');
            $table->string('category');
            $table->string('type');
            $table->integer('important')->default(1);
            $table->string('status')->default('未着手');
            $table->date('deadline')->nullable();
            $table->string('repeat')->nullable();
            $table->integer('score')->default(0);
            $table->text('detail')->nullable();
            $table->integer('completed_by')->nullable();
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

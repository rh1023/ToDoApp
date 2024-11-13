<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\DashboardController;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//ダッシュボード画面
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//タスク一覧画面
Route::get('/tasklist', [TaskController::class, 'taskshow'])->name('tasklist.taskshow');

//タスク追加
Route::get('/taskadd', [TaskController::class, 'create'])->name('taskadd.create');
Route::post('/taskadd', [TaskController::class, 'store'])->name('taskadd.store');

//タスク編集
// Route::get('/taskedit', [TaskController::class, 'edit'])->name('taskedit.edit');
// Route::get('/taskedit/{task}', [TaskController::class, 'edit'])->name('taskedit.edit');
Route::get('/taskedit/{id}', [TaskController::class, 'edit'])->name('taskedit.edit');
Route::put('/taskedit/{task}', [TaskController::class, 'update'])->name('taskedit.update');


//タスク削除
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');


//メンバー状況
Route::get('/memberlist', [MemberController::class, 'mem_show'])->name('memberlist.mem_show');

//カレンダー
Route::get('/historycalendar', [CalendarController::class, 'history'])->name('historycalendar.history');

//追加機能：グループ
Route::get('/groupmanagement', [GroupController::class, 'use_group'])->name('groupmanagement.use_group');

require __DIR__ . '/auth.php';

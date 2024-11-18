<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\DashboardController;

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
Route::get('/tasklist', [TaskController::class, 'show'])->name('tasklist.show');

//タスク追加
Route::get('/taskadd', [TaskController::class, 'create'])->name('taskadd.create');
Route::post('/taskadd', [TaskController::class, 'store'])->name('taskadd.store');

//タスク編集
Route::get('/taskedit/{id}', [TaskController::class, 'edit'])->name('taskedit.edit');
Route::put('/taskedit/{task}', [TaskController::class, 'update'])->name('taskedit.update');

//タスク削除
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

//タスク詳細画面
Route::get('/taskdetail/{id}', [TaskController::class, 'detail'])->name('taskdetail.detail');
Route::put('/taskdetail/{task}', [TaskController::class, 'update'])->name('taskdetail.update');

// タスク完了（タスクを完了したユーザーにスコアが加算される）
Route::post('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('tasks.complete');

//メンバー状況
Route::get('/memberlist', [MemberController::class, 'show'])->name('memberlist.show');

//カレンダー
Route::get('/historycalendar', [CalendarController::class, 'history'])->name('historycalendar.history');
Route::get('/calendar/history', [CalendarController::class, 'history']);
// カレンダー履歴一覧
Route::get('/historycalendar', [CalendarController::class, 'index'])->name('historycalendar.index');

// 特定日の詳細
Route::get('/historycalendar/{date}', [CalendarController::class, 'show'])->name('historycalendar.show');

require __DIR__ . '/auth.php';

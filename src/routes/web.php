<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GroupController;
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

//タスク一覧
Route::get('/tasklist', [TaskController::class, 'taskshow'])->name('tasklist.taskshow');

//タスク追加編集
Route::get('/taskadd', [TaskController::class, 'create'])->name('taskadd.create');

//メンバー状況
Route::get('/memberlist', [MemberController::class, 'mem_show'])->name('memberlist.mem_show');

//カレンダー
Route::get('/historycalendar', [CalendarController::class, 'history'])->name('historycalendar.history');

//追加機能：グループ
Route::get('/groupmanagement', [GroupController::class, 'use_group'])->name('groupmanagement.use_group');

require __DIR__ . '/auth.php';

<?php
//24.11.12
//繰り返し設定を毎日の午前0時に設定

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\CreateRecurringTasks;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    //繰り返し設定 daily()は毎日午前0時
    ->withSchedule(function ($schedule) {
        $schedule->job(CreateRecurringTasks::class)->daily();
    })
    ->create();

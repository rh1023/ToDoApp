<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BoostUpアプリ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css\welcome.css') }}">
    {{-- アイコン(ファビコン) --}}
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
</head>

<body>
    <div class="hero-section">
        <img src="{{ asset('img/logo.png') }}" alt="アプリロゴ" class="hero-logo">
        <h1 class="hero-heading">自己啓発タスク管理アプリ：BoostUp</h1>
        <p class="hero-subtext">
            『 Boost（向上させる）』と『 Up（上昇）』の２つを組み合わせた、ユーザーの成長やモチベーションを高めるアプリです。
            <br>
            日常生活での健康習慣や家事、仕事などのタスクを簡単に管理
        </p>

        <div class="features">
            <h3>BoostUpとは？</h3>
            <p><strong>簡単操作:</strong> シンプルでわかりやすいインターフェース。</p>
            <p><strong>豊富な機能:</strong> タスク管理、進捗追跡、仲間と簡単にタスクを共有。</p>
            <p><strong>モチベーションの向上:</strong> 各タスクにスコア静を導入し競争心を高める。</p>
        </div>

        @if (Route::has('login'))
            <div class="btn-container">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg me-2">ダッシュボード</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">ログイン</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-2">新規登録</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <footer>
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) &copy; 2024 ToDoアプリ .
        BoostUP.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

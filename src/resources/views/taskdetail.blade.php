@extends('layouts.app')

@section('title', 'タスクの詳細')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h3>タスクの詳細確認</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="title" class="form-label">タスク名</label>
                    <p class="form-control">{{ $task->title }}</p>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="category" class="form-label">カテゴリ</label>
                        <p class="form-control">{{ $task->category }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="important" class="form-label">重要度</label>
                        <p class="form-control">{{ $task->important }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="type" class="form-label">区分</label>
                        <p class="form-control">{{ $task->type }}</p>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deadline" class="form-label">期日</label>
                    <p class="form-control">
                        {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y年m月d日') : '未設定' }}</p>
                </div>

                <div class="mb-3">
                    <label for="score" class="form-label">スコア</label>
                    <p class="form-control">{{ $task->score }}</p>
                </div>

                <div class="mb-3">
                    <label for="detail" class="form-label">詳細</label>
                    <p class="form-control">{{ $task->detail }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

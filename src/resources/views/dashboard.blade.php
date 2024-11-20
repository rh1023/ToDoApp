@extends('layouts.app')

@section('title', 'ダッシュボード')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <!-- 本日の日付 -->
            <div class="col-md-6">
                <div class="card text-white bg-primary shadow-lg h-100">
                    <div class="card-header text-center">
                        <h5 class="m-0">📅 本日の日付</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h1 class="card-title display-3 font-weight-bold">{{ $today }}</h1>
                    </div>
                </div>
            </div>
            <!-- 本日のスコア -->
            <div class="col-md-6">
                <div class="card text-dark bg-warning shadow-lg h-100">
                    <div class="card-header text-center">
                        <h5 class="m-0">🏆 本日のスコア</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h1 class="card-title display-3 font-weight-bold" style="color: #343a40;">{{ $todayScore }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- タスク一覧 -->
        <div class="row">
            <!-- 進行中タスク -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white">進行中タスク</div>
                    <div class="card-body">
                        @if ($inProgressTasks->isNotEmpty())
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>タスク</th>
                                        <th>締め切り</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inProgressTasks as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y年m月d日') : '未設定' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">進行中のタスクはありません。</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 未着手タスク -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white">未着手タスク</div>
                    <div class="card-body">
                        @if ($notStartedTasks->isNotEmpty())
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>タスク</th>
                                        <th>締め切り</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notStartedTasks as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y年m月d日') : '未設定' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">未着手のタスクはありません。</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 完了タスク -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">完了タスク</div>
                    <div class="card-body">
                        @if ($completedTasks->isNotEmpty())
                            <ul class="list-group">
                                @foreach ($completedTasks as $task)
                                    <li class="list-group-item">{{ $task->title }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">完了したタスクはありません。</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

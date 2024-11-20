@extends('layouts.app')

@section('title', 'タスク管理')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form action="{{ route('taskadd.create') }}" method="GET">
                <button type="submit" class="btn btn-success">タスクの新規追加</button>
            </form>
        </div>

        <!-- タスクテーブル -->
        <div class="accordion" id="taskAccordion">
            <!-- 個人タスク -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="personalTasksHeader">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#personalTasks" aria-expanded="true" aria-controls="personalTasks">
                        個人タスク
                    </button>
                </h2>
                <div id="personalTasks" class="accordion-collapse collapse show" aria-labelledby="personalTasksHeader">
                    <div class="accordion-body">
                        @if ($tasks->where('type', '個人')->isNotEmpty())
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>@sortablelink('status', 'ステータス')</th>
                                        <th>@sortablelink('title', 'タスク名')</th>
                                        <th>@sortablelink('deadline', '期日')</th>
                                        <th>@sortablelink('category', 'カテゴリ')</th>
                                        <th>@sortablelink('important', '重要度')</th>
                                        <th>@sortablelink('score', 'スコア')</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks->where('type', '個人') as $task)
                                        <tr>
                                            <td>{{ $task->status }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->formatted_deadline }}</td>
                                            <td>{{ $task->category }}</td>
                                            <td>{{ $task->important }}</td>
                                            <td>{{ $task->score }}</td>
                                            <td>
                                                <a href="{{ route('taskdetail.detail', ['id' => $task->id]) }}"
                                                    class="btn btn-primary btn-sm">詳細</a>
                                                <a href="{{ route('taskedit.edit', ['id' => $task->id]) }}"
                                                    class="btn btn-warning btn-sm">編集</a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('本当に削除しますか？')">削除</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">個人タスクはありません。</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 共有タスク -->
            <div class="accordion-item">

                <h2 class="accordion-header" id="sharedTasksHeader">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#sharedTasks"
                        aria-expanded="false" aria-controls="sharedTasks">
                        共有タスク
                    </button>
                </h2>
                <div id="sharedTasks" class="accordion-collapse collapse show" aria-labelledby="sharedTasksHeader">
                    <div class="accordion-body">
                        @if ($tasks->where('type', '共有')->isNotEmpty())
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ステータス</th>
                                        <th>タスク名</th>
                                        <th>期日</th>
                                        <th>カテゴリ</th>
                                        <th>重要度</th>
                                        <th>スコア</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks->where('type', '共有') as $task)
                                        <tr>
                                            <td>{{ $task->userStatus->firstWhere('id', Auth::id())?->pivot?->status ?? '未着手' }}
                                            </td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->formatted_deadline }}</td>
                                            <td>{{ $task->category }}</td>
                                            <td>{{ $task->important }}</td>
                                            <td>{{ $task->score }}</td>
                                            <td>
                                                <a href="{{ route('taskdetail.detail', ['id' => $task->id]) }}"
                                                    class="btn btn-primary btn-sm">詳細</a>
                                                <a href="{{ route('taskedit.edit', ['id' => $task->id]) }}"
                                                    class="btn btn-warning btn-sm">編集</a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('本当に削除しますか？')">削除</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">共有タスクはありません。</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 任意タスク -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="optionalTasksHeader">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#optionalTasks" aria-expanded="false" aria-controls="optionalTasks">
                        任意タスク
                    </button>
                </h2>
                <div id="optionalTasks" class="accordion-collapse collapse show" aria-labelledby="optionalTasksHeader">
                    <div class="accordion-body">
                        @if ($tasks->where('type', '任意')->isNotEmpty())
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ステータス</th>
                                        <th>タスク名</th>
                                        <th>期日</th>
                                        <th>カテゴリ</th>
                                        <th>重要度</th>
                                        <th>スコア</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks->where('type', '任意') as $task)
                                        <tr>
                                            <td>{{ $task->status }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->formatted_deadline }}</td>
                                            <td>{{ $task->category }}</td>
                                            <td>{{ $task->important }}</td>
                                            <td>{{ $task->score }}</td>
                                            <td>
                                                <a href="{{ route('taskdetail.detail', ['id' => $task->id]) }}"
                                                    class="btn btn-primary btn-sm">詳細</a>
                                                <a href="{{ route('taskedit.edit', ['id' => $task->id]) }}"
                                                    class="btn btn-warning btn-sm">編集</a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('本当に削除しますか？')">削除</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">任意タスクはありません。</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
@endsection

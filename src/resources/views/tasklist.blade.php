<head>
    <title>タスク一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タスク一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('taskadd.create') }}" method="GET">
                        <input type="submit" value="タスクの新規追加" class="btn btn-primary mb-3">
                    </form>

                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@sortablelink('status', 'ステータス⇅')</th>
                                    <th>@sortablelink('title', 'タスク名⇅')</th>
                                    <th>@sortablelink('deadline', '期日⇅')</th>
                                    <th>@sortablelink('category', 'カテゴリ⇅')</th>
                                    <th>@sortablelink('type', '種類⇅')</th>
                                    <th>@sortablelink('important', '重要度⇅')</th>
                                    <th>@sortablelink('score', 'スコア⇅')</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            {{-- <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->status }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->formatted_deadline }}</td>
                                        <td>{{ $task->category }}</td>
                                        <td>{{ $task->type }}</td>
                                        <td>{{ $task->important }}</td>
                                        <td>{{ $task->score }}</td>
                                        <td>
                                            <a href="{{ route('taskdetail.detail', ['id' => $task->id]) }}"
                                                class="btn btn-primary btn-sm">詳細</a>

                                            <a href="{{ route('taskedit.edit', ['id' => $task->id]) }}"
                                                class="btn btn-primary btn-sm">編集</a>

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
                            </tbody> --}}

                            <tbody>
                                {{-- 個人タスク --}}
                                <tr>
                                    <th colspan="8">個人タスク</th>
                                </tr>
                                @foreach ($tasks->where('type', '個人') as $task)
                                    <tr>
                                        <td>{{ $task->status }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->formatted_deadline }}</td>
                                        <td>{{ $task->category }}</td>
                                        <td>{{ $task->type }}</td>
                                        <td>{{ $task->important }}</td>
                                        <td>{{ $task->score }}</td>
                                        <td>
                                            <a href="{{ route('taskdetail.detail', ['id' => $task->id]) }}"
                                                class="btn btn-primary btn-sm">詳細</a>
                                            <a href="{{ route('taskedit.edit', ['id' => $task->id]) }}"
                                                class="btn btn-primary btn-sm">編集</a>
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

                                {{-- 共有タスク --}}
                                <tr>
                                    <th colspan="8">共有タスク</th>
                                </tr>
                                @foreach ($tasks->where('type', '共有') as $task)
                                    @php
                                        // 現在ログインしているユーザーのステータスとスコアを取得
                                        $userStatus = $task->userStatus->firstWhere('id', Auth::id()); // ログインユーザーの中間テーブルデータ
                                        $status = $userStatus ? $userStatus->pivot->status : '未着手'; // ステータス（未着手がデフォルト）
                                    @endphp
                                    <tr>
                                        <td>{{ $status }}</td> {{-- ログインユーザーのステータスを表示 --}}
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->formatted_deadline }}</td>
                                        <td>{{ $task->category }}</td>
                                        <td>{{ $task->type }}</td>
                                        <td>{{ $task->important }}</td>
                                        <td>{{ $task->score }}</td>
                                        <td>
                                            <a href="{{ route('taskdetail.detail', ['id' => $task->id]) }}"
                                                class="btn btn-primary btn-sm">詳細</a>
                                            <a href="{{ route('taskedit.edit', ['id' => $task->id]) }}"
                                                class="btn btn-primary btn-sm">編集</a>
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



                                {{-- 任意タスク --}}
                                <tr>
                                    <th colspan="8">任意タスク</th>
                                </tr>
                                @foreach ($tasks->where('type', '任意') as $task)
                                    <tr>
                                        <td>{{ $task->status }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->formatted_deadline }}</td>
                                        <td>{{ $task->category }}</td>
                                        <td>{{ $task->type }}</td>
                                        <td>{{ $task->important }}</td>
                                        <td>{{ $task->score }}</td>
                                        <td>
                                            <a href="{{ route('taskdetail.detail', ['id' => $task->id]) }}"
                                                class="btn btn-primary btn-sm">詳細</a>
                                            <a href="{{ route('taskedit.edit', ['id' => $task->id]) }}"
                                                class="btn btn-primary btn-sm">編集</a>
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
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

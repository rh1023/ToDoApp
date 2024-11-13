{{--
2024.11.07  13時半  Bootstrapを導入
--}}

<head>
    <title>ダッシュボード</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ダッシュボード') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container container-m">
                        <div class="card-deck">

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">本日の日付</h5>
                                            <p class="card-text">{{ $today }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-2">

                                </div>

                                <div class="col-sm-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">本日のスコア</h5>
                                            <p class="card-text">{{ $todayScore }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">進行中タスク</h5>
                                            @foreach ($inProgressTasks as $task)
                                                <p class="card-text">◎ {{ $task->title }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">未着手タスク</h5>
                                            @foreach ($notStartedTasks as $task)
                                                <p class="card-text">〇 {{ $task->title }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">完了タスク</h5>
                                            @foreach ($completedTasks as $task)
                                                <p class="card-text">● {{ $task->title }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">メンバー状況</h5>
                                    <div class="container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>名前</th>
                                                    <th>合計スコア</th>
                                                    <th>進行中タスク</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->todayScore }}</td>
                                                        <td>@foreach ($user->inProgressTasks as $task)
                                                                {{ $task->title }}<br>
                                                            @endforeach
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
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

<head>
    <title>メンバー状況</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メンバー状況') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row">
                            @foreach ($members as $member)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $member->name }}</h5>
                                            <p class="card-text">スコア：{{ $member->todayScore }}</p>
                                            <br>
                                            <div class="container">
                                                <h6>進行中タスク</h6>
                                                <ul class="list-group">
                                                    @foreach ($member->inProgressTasks as $task)
                                                        <li class="list-group-item">{{ $task->title }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="container mt-3">
                                                <h6>未着手タスク</h6>
                                                <ul class="list-group">
                                                    @foreach ($member->notStartedTasks as $task)
                                                        <li class="list-group-item">{{ $task->title }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="container mt-3">
                                                <h6>完了タスク</h6>
                                                <ul class="list-group">
                                                    @foreach ($member->completedTasks as $task)
                                                        <li class="list-group-item">{{ $task->title }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

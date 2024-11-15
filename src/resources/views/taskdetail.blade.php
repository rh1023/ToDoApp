<head>
    <title>タスク詳細</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タスク詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">



                    <div class="form-group">
                        <label for="title">タスク名</label>
                        <p class="form-control">{{ $task->title }}</p>
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="score">スコア</label>
                        <p class="form-control">{{ $task->score }}</p>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class ="form-group">
                                        <label for="category">カテゴリ</label>
                                        <p class="form-control">{{ $task->category }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class = "form-group">
                                        <label for="important" class="">重要度</label>
                                        <p class="form-control">{{ $task->important }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class = "form-group">
                                        <label for="type" class="">区分</label>
                                        <p class="form-control">{{ $task->type }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="deadline">期日</label>
                        <p class="form-control">{{ $task->deadline }}</p>
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="detail">詳細</label>
                        <p class="form-control">{{ $task->detail }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

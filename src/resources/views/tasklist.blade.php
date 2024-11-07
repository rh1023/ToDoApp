{{--
2024.11.07  14時半  Bootstrapを導入
--}}

<head>
    <title>ダッシュボード</title>
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
                        <input type="submit" value="タスクの新規追加" class="btn btn-primary">
                    </form>

                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            並べ替え
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">ステータス昇順</a>
                            <a class="dropdown-item" href="#">ステータス降順</a>
                            <a class="dropdown-item" href="#">日付昇順</a>
                            <a class="dropdown-item" href="#">日付降順</a>
                        </div>
                    </div>

                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ステータス</th>
                                    <th>タスク名</th>
                                    <th>カテゴリ</th>
                                    <th>重要度</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>進行中</td>
                                    <td>めっちゃやる</td>
                                    <td>仕事</td>
                                    <td>5</td>
                                    <td>
                                        <button type="submit">編集</button>
                                        <button type="submit">削除</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>未着手</td>
                                    <td>むっちゃやる</td>
                                    <td>趣味</td>
                                    <td>3</td>
                                    <td>
                                        <button type="submit">編集</button>
                                        <button type="submit">削除</button>
                                        </form>
                                    </td>
                                </tr>
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

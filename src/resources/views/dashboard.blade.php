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
                                            <p class="card-text">2024年 10月 23日 水曜日</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-2">

                                </div>

                                <div class="col-sm-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">本日のスコア</h5>
                                            <p class="card-text">100</p>
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
                                            <p class="card-text">ウルトラタスクABC</p>
                                            <p class="card-text">ウルトラタスクDEF</p>
                                            <p class="card-text">ウルトラタスクGHI</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">未着手タスク</h5>
                                            <p class="card-text">ウルトラタスクABC</p>
                                            <p class="card-text">ウルトラタスクDEF</p>
                                            <p class="card-text">ウルトラタスクGHI</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">完了タスク</h5>
                                            <p class="card-text">ウルトラタスクABC</p>
                                            <p class="card-text">ウルトラタスクDEF</p>
                                            <p class="card-text">ウルトラタスクGHI</p>
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
                                                    <th>スコア</th>
                                                    <th>タスク名</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>ツボイシ</td>
                                                    <td>100</td>
                                                    <td>めっちゃやる</td>
                                                </tr>
                                                <tr>
                                                    <td>フタムラ</td>
                                                    <td>30</td>
                                                    <td>すんごいやる</td>
                                                </tr>
                                                <tr>
                                                    <td>ヤマダ</td>
                                                    <td>10</td>
                                                    <td>すんごいやる</td>
                                                </tr>
                                                <tr>
                                                    <td>フルカワ</td>
                                                    <td>0</td>
                                                    <td>すんごいやる</td>
                                                </tr>
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

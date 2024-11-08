{{--
2024.11.08  13時半  Bootstrapを導入
--}}

<head>
    <title>ダッシュボード</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メンバー一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="container container-m">
                        <div class="card-deck">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">自分の名前</h5>
                                            <p class="card-text">スコア：100</p>

                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>進行中</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>めっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>未着手</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>むっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>完了</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>けっこうやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">ツボイシ</h5>
                                            <p class="card-text">スコア：100</p>

                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>進行中</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>めっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>未着手</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>むっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>完了</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>けっこうやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">フタムラ</h5>
                                            <p class="card-text">スコア：30</p>

                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>進行中</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>めっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>未着手</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>むっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>完了</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>けっこうやる</td>
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

                    <br>
                    {{-- ２行目? --}}
                    <div class="container container-m">
                        <div class="card-deck">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">ヤマダ</h5>
                                            <p class="card-text">スコア：10</p>

                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>進行中</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>めっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>未着手</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>むっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>完了</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>けっこうやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">フルカワ</h5>
                                            <p class="card-text">スコア：0</p>

                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>進行中</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>めっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>未着手</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>むっちゃやる</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="container">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>完了</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>けっこうやる</td>
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
        </div>
    </div>











</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

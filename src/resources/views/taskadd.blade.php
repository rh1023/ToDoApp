{{--
2024.11.07  15時半  Bootstrapを導入
24.11.11
タスク追加機能を実装
入力フォームの属性をメソッドで利用するフィールドにそろえる
フォームactionを指定する
24.11.12
繰り返し処理の設定を追加
--}}

<head>
    <title>タスク追加入力画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タスク追加入力') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('taskadd.store') }}" method = "POST">
                        @csrf


                        <div class="form-group">
                            <label for="title">タスク名</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class ="form-group">
                                            <label for="category">カテゴリ</label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="">選択してください</option>
                                                <option value="家事">家事</option>
                                                <option value="仕事">仕事</option>
                                                <option value="健康">健康</option>
                                                <option value="自己研鑽">自己研鑽</option>
                                                <option value="趣味">趣味</option>
                                                <option value="その他">その他</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class = "form-group">
                                            <label for="important" class="">重要度</label>
                                            <select class="form-control" id="important" name="important" required>
                                                <option value="">選択してください</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class = "form-group">
                                            <label for="type" class="">タスクタイプ</label>
                                            <select class="form-control" id="type" name="type" required>
                                                <option value="">選択してください</option>
                                                <option value="個人">個人</option>
                                                <option value="共有">共有</option>
                                                <option value="任意">任意</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="deadline">期日</label>
                            <input type="date" class="form-control" id="deadline" name="deadline">
                        </div>

                        <br>

                        <div class = "form-group">
                            <label for = "repeat">繰り返し設定</label>
                            <select class="form-control" id="repeat" name="repeat">
                                <option value="">繰り返しなし</option>
                                <option value="daily">毎日</option>
                                <option value="weekly:1">毎週月曜日</option>
                                <option value="weekly:2">毎週火曜日</option>
                                <option value="weekly:3">毎週水曜日</option>
                                <option value="weekly:4">毎週木曜日</option>
                                <option value="weekly:5">毎週金曜日</option>
                                <option value="weekly:6">毎週土曜日</option>
                                <option value="weekly:0">毎週日曜日</option>
                                <option value="monthly:1week-1">毎月第1月曜日</option>
                                <option value="monthly:2week-1">毎月第2月曜日</option>
                                <option value="monthly:3week-1">毎月第3月曜日</option>
                                <option value="monthly:4week-1">毎月第4月曜日</option>
                                <option value="monthly:1">毎月1日</option>
                                <option value="monthly:15">毎月15日</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3"></textarea>
                        </div>

                        <br>

                        <button type="submit" class = "btn btn-primary">保存</button>

                    </form>


                    <br>

                    <form action="{{ route('tasklist.taskshow') }}">
                        <input type="submit" class="btn btn-primary" value="戻る">
                    </form>



                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

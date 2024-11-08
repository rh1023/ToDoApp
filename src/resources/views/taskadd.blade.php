{{--
2024.11.07  15時半  Bootstrapを導入
--}}

<head>
    <title>タスク入力</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タスクの入力') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="">
                        <label for="text_input" class="">タスク名入力</label>
                        <input type="text" class="form-control" id="text_input" name="text_input" required>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <label for="text_input" class="">カテゴリ</label>
                                    <select class="dropdown" id="dropdown" name="dropdown" required>
                                        <option value="">選択してください</option>
                                        <option value="option1">家事</option>
                                        <option value="option2">仕事</option>
                                        <option value="option3">健康</option>
                                        <option value="option4">自己研鑽</option>
                                        <option value="option5">趣味</option>
                                        <option value="option6">その他</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <label for="text_input" class="">重要度</label>
                                    <select class="dropdown" id="dropdown" name="dropdown" required>
                                        <option value="">選択してください</option>
                                        <option value="option1">1</option>
                                        <option value="option2">2</option>
                                        <option value="option3">3</option>
                                        <option value="option4">4</option>
                                        <option value="option5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="">
                        <label for="text_input" class="">期日入力</label>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">本日</h5>
                                        <input type="date" class="form-control" id="date_input" name="date_input"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">日付選択</h5>
                                        <input type="date" class="form-control" id="date_input" name="date_input"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">期間選択</h5>
                                        <label for="start_date">開始日：</label>
                                        <input type="date" id="start_date" name="start_date">
                                        <br>
                                        <label for="end_date">終了日：</label>
                                        <input type="date" id="end_date" name="end_date">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="">
                        <label for="text_area" class="form-label">テキスト詳細入力</label>
                        <textarea class="form-control" id="text_area" name="text_area" rows="3" required></textarea>
                    </div>

                    <br>

                    <form action="{{ route('tasklist.taskshow') }}">
                        <input type="submit" class="btn btn-primary" value="戻る">
                    </form>

                    <br>

                    <form action="{{ route('tasklist.taskshow') }}">
                        <input type="submit" class="btn btn-primary" value="保存">
                    </form>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>

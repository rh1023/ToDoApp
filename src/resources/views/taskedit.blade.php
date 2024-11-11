{{--
2024.11.11  11:40  taskaddを複製し編集
タスクの修正機能実装（編集前の値の保持）
--}}

<head>
    <title>タスク編集入力画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タスク編集入力') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    ここ
                    <form action="{{ route('taskedit.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label">ステータス</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="未着手" {{ $task->status == '未着手' ? 'selected' : '' }}>未着手</option>
                                <option value="進行中" {{ $task->status == '進行中' ? 'selected' : '' }}>進行中</option>
                                <option value="完了" {{ $task->status == '完了' ? 'selected' : '' }}>完了</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="title">タスク名</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $task->title }}" required>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class ="form-group">
                                            <label for="category">カテゴリ</label>
                                            {{-- <select class="form-control" id="category" name="category" required>
                                                <option value="">選択してください</option>
                                                <option value="家事">家事</option>
                                                <option value="仕事">仕事</option>
                                                <option value="健康">健康</option>
                                                <option value="自己研鑽">自己研鑽</option>
                                                <option value="趣味">趣味</option>
                                                <option value="その他">その他</option>
                                            </select> --}}
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="">選択してください</option>
                                                <option value="家事" {{ $task->category == '家事' ? 'selected' : '' }}>
                                                    家事</option>
                                                <option value="仕事" {{ $task->category == '仕事' ? 'selected' : '' }}>
                                                    仕事</option>
                                                <option value="健康" {{ $task->category == '健康' ? 'selected' : '' }}>
                                                    健康</option>
                                                <option value="自己研鑽"
                                                    {{ $task->category == '自己研鑽' ? 'selected' : '' }}>自己研鑽</option>
                                                <option value="趣味" {{ $task->category == '趣味' ? 'selected' : '' }}>
                                                    趣味</option>
                                                <option value="その他"
                                                    {{ $task->category == 'その他' ? 'selected' : '' }}>その他</option>
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
                                                <option value="1" {{ $task->important == '1' ? 'selected' : '' }}>
                                                    1</option>
                                                <option value="2" {{ $task->important == '2' ? 'selected' : '' }}>
                                                    2</option>
                                                <option value="3" {{ $task->important == '3' ? 'selected' : '' }}>
                                                    3</option>
                                                <option value="4" {{ $task->important == '4' ? 'selected' : '' }}>
                                                    4</option>
                                                <option value="5" {{ $task->important == '5' ? 'selected' : '' }}>
                                                    5</option>
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
                                                <option value="個人" {{ $task->type == '個人' ? 'selected' : '' }}>個人
                                                </option>
                                                <option value="共有" {{ $task->type == '共有' ? 'selected' : '' }}>共有
                                                </option>
                                                <option value="任意" {{ $task->type == '任意' ? 'selected' : '' }}>任意
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-group">
                            <label for="deadline">期日</label>
                            <input type="date" class="form-control" id="deadline" name="deadline"
                                value="{{ $task->deadline }}" required>
                        </div>

                        <br>

                        <div class = "form-group">
                            <label for = "repeat">繰り返し設定</label>
                            <input type = "text" class= "form-control" id="repeat" name="repeat"
                                value="{{ $task->repeat }}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3">{{ $task->detail }}</textarea>
                        </div>

                        <br>

                        <button type="submit" class="btn btn-primary">更新</button>

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

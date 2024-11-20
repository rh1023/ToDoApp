@extends('layouts.app')

@section('title', 'タスクの追加')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3>タスクの内容を入力してください</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('taskadd.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="status" class="form-label">ステータス</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="未着手">未着手</option>
                            <option value="進行中">進行中</option>
                            <option value="完了">完了</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">タスク名</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="20文字以内でタスク名を入力してください"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">カテゴリ</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">選択してください</option>
                                <option value="家事">家事</option>
                                <option value="仕事">仕事</option>
                                <option value="健康">健康</option>
                                <option value="自己研鑽">自己研鑽</option>
                                <option value="趣味">趣味</option>
                                <option value="その他">その他</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="important" class="form-label">重要度</label>
                            <select class="form-select" id="important" name="important" required>
                                <option value="">選択してください</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label">区分</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">選択してください</option>
                                <option value="個人">個人</option>
                                <option value="共有">共有</option>
                                <option value="任意">任意</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">期日</label>
                        <input type="date" class="form-control" id="deadline" name="deadline">
                    </div>

                    <div class="mb-3">
                        <label for="detail" class="form-label">詳細</label>
                        <textarea class="form-control" id="detail" name="detail" rows="4" placeholder="詳細を入力してください"></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

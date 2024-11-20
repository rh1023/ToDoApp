@extends('layouts.app')

@section('title', 'タスクの編集')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-warning text-white">
                <h3>タスクの内容を編集してください</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('taskedit.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status" class="form-label">ステータス</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="未着手" {{ $userStatus->status == '未着手' ? 'selected' : '' }}>未着手</option>
                            <option value="進行中" {{ $userStatus->status == '進行中' ? 'selected' : '' }}>進行中</option>
                            <option value="完了" {{ $userStatus->status == '完了' ? 'selected' : '' }}>完了</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">タスク名</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}"
                            required>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="category" class="form-label">カテゴリ</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">選択してください</option>
                                <option value="家事" {{ $task->category == '家事' ? 'selected' : '' }}>家事</option>
                                <option value="仕事" {{ $task->category == '仕事' ? 'selected' : '' }}>仕事</option>
                                <option value="健康" {{ $task->category == '健康' ? 'selected' : '' }}>健康</option>
                                <option value="自己研鑽" {{ $task->category == '自己研鑽' ? 'selected' : '' }}>自己研鑽</option>
                                <option value="趣味" {{ $task->category == '趣味' ? 'selected' : '' }}>趣味</option>
                                <option value="その他" {{ $task->category == 'その他' ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="important" class="form-label">重要度</label>
                            <select class="form-select" id="important" name="important" required>
                                <option value="">選択してください</option>
                                <option value="1" {{ $task->important == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $task->important == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $task->important == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $task->important == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $task->important == '5' ? 'selected' : '' }}>5</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="type" class="form-label">区分</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="">選択してください</option>
                                <option value="個人" {{ $task->type == '個人' ? 'selected' : '' }}>個人</option>
                                <option value="共有" {{ $task->type == '共有' ? 'selected' : '' }}>共有</option>
                                <option value="任意" {{ $task->type == '任意' ? 'selected' : '' }}>任意</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deadline" class="form-label">期日</label>
                        <input type="date" class="form-control" id="deadline" name="deadline"
                            value="{{ $task->deadline }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="detail" class="form-label">詳細</label>
                        <textarea class="form-control" id="detail" name="detail" rows="4">{{ $task->detail }}</textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">更新</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

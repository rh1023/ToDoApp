@extends('layouts.app')

@section('title', 'メンバー状況')

@section('content')
    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($members as $member)
                <div class="col">
                    <div class="card h-100 shadow">
                        <div class="card-header text-white bg-primary d-flex flex-column align-items-center">
                            <h5 class="card-title mb-2">{{ $member->name }}</h5>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-light text-dark">スコア</span>
                                &nbsp;&nbsp;
                                <span class="fs-2 fw-bold me-2">{{ $member->todayScore }}</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <ul class="nav nav-tabs mb-3" id="taskTabs-{{ $member->id }}" role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active" id="in-progress-tab-{{ $member->id }}"
                                        data-bs-toggle="tab" data-bs-target="#in-progress-{{ $member->id }}"
                                        type="button" role="tab">進行中</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="not-started-tab-{{ $member->id }}" data-bs-toggle="tab"
                                        data-bs-target="#not-started-{{ $member->id }}" type="button"
                                        role="tab">未着手</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="completed-tab-{{ $member->id }}" data-bs-toggle="tab"
                                        data-bs-target="#completed-{{ $member->id }}" type="button"
                                        role="tab">完了</button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <!-- 進行中タスク -->
                                <div class="tab-pane fade show active" id="in-progress-{{ $member->id }}" role="tabpanel">
                                    <ul class="list-group">
                                        @forelse ($member->inProgressTasks as $task)
                                            <li class="list-group-item">
                                                <span class="badge bg-warning text-dark">進行中</span> {{ $task->title }}
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted">進行中タスクはありません。</li>
                                        @endforelse
                                    </ul>
                                </div>

                                <!-- 未着手タスク -->
                                <div class="tab-pane fade" id="not-started-{{ $member->id }}" role="tabpanel">
                                    <ul class="list-group">
                                        @forelse ($member->notStartedTasks as $task)
                                            <li class="list-group-item">
                                                <span class="badge bg-danger">未着手</span> {{ $task->title }}
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted">未着手タスクはありません。</li>
                                        @endforelse
                                    </ul>
                                </div>

                                <!-- 完了タスク -->
                                <div class="tab-pane fade" id="completed-{{ $member->id }}" role="tabpanel">
                                    <ul class="list-group">
                                        @forelse ($member->completedTasks as $task)
                                            <li class="list-group-item">
                                                <span class="badge bg-success">完了</span> {{ $task->title }}
                                            </li>
                                        @empty
                                            <li class="list-group-item text-muted">完了タスクはありません。</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-muted">
                            最終更新: {{ $member->updated_at ? $member->updated_at->format('Y年m月d日') : '未設定' }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

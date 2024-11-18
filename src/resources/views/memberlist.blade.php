<head>
    <title>メンバー状況</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('メンバー状況') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach ($members as $member)
                                <div class="col">
                                    <div class="card h-100">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="card-title">{{ $member->name }}</h5>
                                            <span class="badge bg-light text-dark">スコア: {{ $member->todayScore }}</span>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" id="taskTabs-{{ $member->id }}" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active"
                                                        id="in-progress-tab-{{ $member->id }}" data-bs-toggle="tab"
                                                        data-bs-target="#in-progress-{{ $member->id }}" type="button"
                                                        role="tab" aria-controls="in-progress"
                                                        aria-selected="true">進行中</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="not-started-tab-{{ $member->id }}"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#not-started-{{ $member->id }}" type="button"
                                                        role="tab" aria-controls="not-started"
                                                        aria-selected="false">未着手</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="completed-tab-{{ $member->id }}"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#completed-{{ $member->id }}" type="button"
                                                        role="tab" aria-controls="completed"
                                                        aria-selected="false">完了</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="taskTabsContent-{{ $member->id }}">
                                                <div class="tab-pane fade show active"
                                                    id="in-progress-{{ $member->id }}" role="tabpanel"
                                                    aria-labelledby="in-progress-tab-{{ $member->id }}">
                                                    <ul class="list-group list-group-flush">
                                                        @forelse ($member->inProgressTasks as $task)
                                                            <li class="list-group-item">
                                                                <span class="text-warning">進行中:</span>
                                                                {{ $task->title }}
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item text-muted">進行中タスクはありません。</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="not-started-{{ $member->id }}"
                                                    role="tabpanel"
                                                    aria-labelledby="not-started-tab-{{ $member->id }}">
                                                    <ul class="list-group list-group-flush">
                                                        @forelse ($member->notStartedTasks as $task)
                                                            <li class="list-group-item">
                                                                <span class="text-danger">未着手:</span>
                                                                {{ $task->title }}
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item text-muted">未着手タスクはありません。</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="completed-{{ $member->id }}"
                                                    role="tabpanel"
                                                    aria-labelledby="completed-tab-{{ $member->id }}">
                                                    <ul class="list-group list-group-flush">
                                                        @forelse ($member->completedTasks as $task)
                                                            <li class="list-group-item">
                                                                <span class="text-success">完了:</span>
                                                                {{ $task->title }}
                                                            </li>
                                                        @empty
                                                            <li class="list-group-item text-muted">完了タスクはありません。</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted">
                                            最終更新: {{ $member->updated_at->format('Y年m月d日') ?? '未設定' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

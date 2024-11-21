<head>
    <title>カレンダー</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
</head>

@extends('layouts.app')

@section('title', 'カレンダー')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4>月間カレンダー</h4>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // 月間カレンダー表示
                locale: 'ja', // 日本語設定
                events: @json($events), // PHPから渡されたデータ
                headerToolbar: {
                    left: 'prev,next today', // 前後の月移動、今日に移動
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek' // 月・週表示の変更
                }
            });
            calendar.render();
        });
    </script>
@endsection

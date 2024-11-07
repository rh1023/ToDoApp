<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('タスク一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>タスク一覧</h1>

                    <form action="{{ route('taskadd.create') }}" method="GET">
                        <button type="submit">タスクの新規追加</button>
                    </form>



                    <form action="">
                        <select name="example">
                            <option>並べ替え</option>
                            <option>昇順</option>
                            <option>降順</option>
                        </select>
                    </form>

                    <table>
                        <thead>
                            <tr>
                                <th>ステータス</th>
                                <th>タスク名</th>
                                <th>カテゴリ</th>
                                <th>重要度</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>進行中</td>
                                <td>めっちゃやる</td>
                                <td>仕事</td>
                                <td>5</td>
                                <td>
                                    <button type="submit">編集</button>
                                    <button type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





</x-app-layout>

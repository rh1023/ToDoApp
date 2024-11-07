<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('グループ管理') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1>グループ名</h1>
                    <button>脱退</button>

                    <h1>参加申請者</h1>
                    <button>承認</button>
                    <button>拒否</button>
                    <h1>メッセージ</h1>

                    <input type="text">
                    <button>検索</button>
                    <h1>メッセージ</h1>
                    <h1>グループの表示</h1>
                    <button>申請</button>

                    <br>
                    <input type="text">
                    <input type="text">
                    <button>作成</button>
                    <h1>メッセージ</h1>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

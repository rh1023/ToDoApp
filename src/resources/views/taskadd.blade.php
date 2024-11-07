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

                    <h1>タスク入力フォーム</h1>

                    <div class="">
                        <label for="text_input" class="">タスク名入力</label>
                        <input type="text" class="form-control" id="text_input" name="text_input" required>
                    </div>

                    <div class="">
                        <label for="dropdown" class="">カテゴリ</label>
                        <select class="" id="dropdown" name="dropdown" required>
                            <option value="">選択してください</option>
                            <option value="option1">家事</option>
                            <option value="option2">仕事</option>
                            <option value="option3">健康</option>
                            <option value="option4">自己研鑽</option>
                            <option value="option5">趣味</option>
                            <option value="option6">その他</option>
                        </select>
                    </div>

                    <div class="">
                        <label for="text_input" class="">期日入力</label>
                        <div class="">
                            <label for="date_input" class="form-label">本日</label>
                            <input type="date" class="form-control" id="date_input" name="date_input" required>
                        </div>

                        <div class="">
                            <label for="date_input" class="form-label">日付選択</label>
                            <input type="date" class="form-control" id="date_input" name="date_input" required>
                        </div>

                        <div>
                            <label for="start_date">開始日：</label>
                            <input type="date" id="start_date" name="start_date">

                            <label for="end_date">終了日：</label>
                            <input type="date" id="end_date" name="end_date">
                        </div>
                    </div>

                    <div class="">
                        <label for="text_area" class="form-label">テキスト詳細入力</label>
                        <textarea class="form-control" id="text_area" name="text_area" rows="3" required></textarea>
                    </div>

                    <div class="">
                        <button type="button" class="" onclick="history.back()">戻る</button>
                        <button type="submit" class="">保存</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>

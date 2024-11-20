<section>
    <form method="post" action="{{ route('profile.destroy') }}" class="mb-3">
        @csrf
        @method('delete')

        <h4 class="text-danger">本当にアカウントを削除しますか？</h4>
        <p>削除する前に必要なデータを保存してください。</p>

        <div class="mb-3">
            <label for="password" class="form-label">パスワードを入力してください</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger">アカウント削除</button>
    </form>
</section>

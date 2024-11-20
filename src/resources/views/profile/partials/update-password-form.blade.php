<section>
    <form method="post" action="{{ route('password.update') }}" class="mb-3">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">現在のパスワード</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">新しいパスワード</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">確認用パスワード</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                required>
            @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">保存</button>
    </form>
</section>

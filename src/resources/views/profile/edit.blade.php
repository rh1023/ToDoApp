@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
    <div class="container py-4">

        <div class="row">
            <!-- プロフィール情報の更新 -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        プロフィール情報の更新
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- パスワードの更新 -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        パスワードの更新
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- アカウント削除 -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-danger text-white">
                        アカウント削除
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

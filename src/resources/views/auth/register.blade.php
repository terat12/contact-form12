@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('title','Register')

@section('content')
<div class="auth-page">
    <div class="auth-hero">
        <h2 class="auth-title">Register</h2>
    </div>

    <div class="auth-center">
        <div class="auth-card">
            <form method="post" action="{{ route('register') }}">
                @csrf

                <label class="field">
                    <span>お名前</span>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="例：山田　太郎">
                    @error('name') <div class="error">{{ $message }}</div> @enderror
                </label>

                <label class="field">
                    <span>メールアドレス</span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                </label>

                <label class="field">
                    <span>パスワード</span>
                    <input type="password" name="password" placeholder="例：coachtech1106">
                    @error('password') <div class="error">{{ $message }}</div> @enderror
                </label>

                <div class="actions">
                    <button type="submit" class="btn">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
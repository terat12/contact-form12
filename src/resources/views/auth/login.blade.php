@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('title','Login')

@section('content')
<div class="auth-page">
    <div class="auth-hero">
        <h2 class="auth-title">Login</h2>
    </div>

    <div class="auth-center">
        <div class="auth-card">
            <form method="post" action="{{ route('login') }}">
                @csrf

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
                    <button type="submit" class="btn">ログイン</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
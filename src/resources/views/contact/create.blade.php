@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}"> @endpush
@section('title','Contact')

@section('content')
<h2 class="title">Contact</h2>

<form method="post" action="{{ route('contact.confirm') }}">
    @csrf

    <div class="form-grid">
        <div>お名前 <span class="required">※</span></div>
        <div class="form-row">
            <div>
                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
                @error('last_name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div>
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
                @error('first_name')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="form-grid">
        <div>性別 <span class="required">※</span></div>
        <div>
            <label><input type="radio" name="gender" value="1" @checked(old('gender')=='1' )> 男性</label>
            <label><input type="radio" name="gender" value="2" @checked(old('gender')=='2' )> 女性</label>
            <label><input type="radio" name="gender" value="3" @checked(old('gender')=='3' )> その他</label>
            @error('gender')<div class="error">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="form-grid">
        <div>メールアドレス <span class="required">※</span></div>
        <div>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')<div class="error">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="form-grid">
        <div>電話番号 <span class="required">※</span></div>
        <div>
            <input type="text" name="tel" value="{{ old('tel') }}" placeholder="例: 080-1234-5678">
            @error('tel')<div class="error">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="form-grid">
        <div>住所 <span class="required">※</span></div>
        <div>
            <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
            @error('address')<div class="error">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="form-grid">
        <div>建物名</div>
        <div>
            <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
            @error('building')<div class="error">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="form-grid">
        <div>お問い合わせの種類 <span class="required">※</span></div>
        <div>
            <select name="category_id">
                <option value="">選択してください</option>
                @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id')==$c->id)>{{ $c->content }}</option>
                @endforeach
            </select>
            @error('category_id')<div class="error">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="form-grid">
        <div>お問い合わせ内容 <span class="required">※</span></div>
        <div>
            <textarea name="detail" maxlength="120" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            @error('detail')<div class="error">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="center" style="margin-top:20px">
        <button class="btn" type="submit">確認画面</button>
    </div>
</form>
@endsection
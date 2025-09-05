@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('title','Confirm')

@section('content')
<h2 class="title">Confirm</h2>

<table class="table">
    <tr>
        <th style="width:240px">お名前</th>
        <td>{{ $data['last_name'] }}　{{ $data['first_name'] }}</td>
    </tr>
    <tr>
        <th>性別</th>
        <td>{{ $genderText }}</td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>{{ $data['email'] }}</td>
    </tr>
    <tr>
        <th>電話番号</th>
        <td>{{ $data['tel'] }}</td>
    </tr>
    <tr>
        <th>住所</th>
        <td>{{ $data['address'] }}</td>
    </tr>
    <tr>
        <th>建物名</th>
        <td>{{ $data['building'] ?? '' }}</td>
    </tr>
    <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $category->content }}</td>
    </tr>
    <tr>
        <th>お問い合わせ内容</th>
        <td style="white-space: pre-wrap">{{ $data['detail'] }}</td>
    </tr>
</table>

<div class="center" style="margin-top:16px">
    <form method="post" action="{{ route('contact.store') }}" style="display:inline">
        @csrf
        @foreach ($data as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
        <button class="btn" type="submit">送信</button>
    </form>

    <form method="post" action="{{ route('contact.confirm') }}" style="display:inline; margin-left:8px">
        @csrf
        @foreach ($data as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="back" value="1">
        <button class="btn secondary" type="submit">修正</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('title','Admin')

@section('content')
<h2 class="title">Admin</h2>

@if(session('status'))
<div class="flash">{{ session('status') }}</div>
@endif

<form method="GET" action="{{ route('admin.index') }}" class="search-row">
    <input class="name-input" type="text" name="q"
        value="{{ $filters['q'] ?? '' }}" placeholder="名前やメールアドレスを入力してください">

    <select class="match-select" name="match" title="一致方法">
        <option value="partial" @selected(($filters['match'] ?? 'partial' )==='partial' )>部分一致</option>
        <option value="exact" @selected(($filters['match'] ?? '' )==='exact' )>完全一致</option>
    </select>

    <select class="gender-select" name="gender">
        <option value="">性別</option>
        <option value="1" @selected(($filters['gender'] ?? '' )==='1' )>男性</option>
        <option value="2" @selected(($filters['gender'] ?? '' )==='2' )>女性</option>
        <option value="3" @selected(($filters['gender'] ?? '' )==='3' )>その他</option>
    </select>

    <select class="category-select" name="category_id">
        <option value="">お問い合わせの種類</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" @selected(($filters['category_id'] ?? '' )==$cat->id)>
            {{ $cat->content }}
        </option>
        @endforeach
    </select>

    <input class="date-input" type="date" name="date" value="{{ $filters['date'] ?? '' }}">

    <button type="submit" class="btn search-btn">検索</button>
    <a href="{{ route('admin.index') }}" class="btn secondary reset-btn">リセット</a>
</form>

@php
$current = $contacts->currentPage();
$last = $contacts->lastPage();

$start = max(1, min($current - 2, max(1, $last - 4)));
$end = min($last, $start + 4);
@endphp

<nav class="pager-top">
    <ul class="pagination">
        <li class="{{ $contacts->onFirstPage() ? 'disabled' : '' }}">
            <a href="{{ $contacts->previousPageUrl() ?: '#' }}" rel="prev">&lt;</a>
        </li>

        @for ($i = $start; $i <= $end; $i++)
            @if ($i===$current)
            <li class="active"><span>{{ $i }}</span></li>
            @else
            <li><a href="{{ $contacts->url($i) }}">{{ $i }}</a></li>
            @endif
            @endfor

            <li class="{{ $current === $last ? 'disabled' : '' }}">
                <a href="{{ $contacts->nextPageUrl() ?: '#' }}" rel="next">&gt;</a>
            </li>
    </ul>
</nav>

<table class="table">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th style="width:120px;"></th>
        </tr>
    </thead>
    <tbody>
        @php $genderLabels = [1=>'男性', 2=>'女性', 3=>'その他']; @endphp
        @forelse($contacts as $contact)
        <tr>
            <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
            <td>{{ $genderLabels[$contact->gender] ?? '' }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category?->content }}</td>
            <td><a class="btn small ghost" href="#detail-{{ $contact->id }}">詳細</a></td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="center">該当データがありません</td>
        </tr>
        @endforelse
    </tbody>
</table>

@foreach ($contacts as $contact)
<div id="detail-{{ $contact->id }}" class="modal" aria-hidden="true">
    <a href="#" class="modal__overlay" aria-label="閉じる"></a>
    <div class="modal__content">
        <a href="#" class="modal__close" aria-label="閉じる">×</a>
        <h3 class="title" style="margin-top:0;">詳細</h3>
        <table class="detail-table">
            <tr>
                <th>お名前</th>
                <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
            </tr>
            <tr>
                <th>性別</th>
                <td>{{ $genderLabels[$contact->gender] ?? '' }}</td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>{{ $contact->email }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $contact->tel }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $contact->address }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $contact->building }}</td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>{{ $contact->category?->content }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td class="text-pre">{{ $contact->detail }}</td>
            </tr>
            <tr>
                <th>作成日時</th>
                <td>{{ $contact->created_at }}</td>
            </tr>
        </table>
        <div style="margin-top:12px; display:flex; gap:8px;">
            <a href="#" class="btn secondary">閉じる</a>
            <form method="POST" action="{{ route('admin.destroy', $contact) }}" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn danger">削除</button>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
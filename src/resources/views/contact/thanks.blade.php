@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('title','Thanks')

@section('content')
<div class="thanks-page">
    <p class="thanks-message">お問い合わせありがとうございました</p>
    <a class="btn" href="{{ route('contact.create') }}">HOME</a>
</div>
@endsection
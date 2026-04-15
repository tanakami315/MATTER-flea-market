@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

<form action="/logout" method="post" class="header__logout-form">
    @csrf
    <button class="header__logout-button">logout</button>
</form>

@if (Auth::check())
    <form action="/logout" method="post" class="header__logout-form">
        @csrf
        <button class="header__logout-button">logout</button>
    </form>
@endif

<div class="mypage__link">
    <a href="/mypage">マイページ</a>
</div>

<div class="sell__link">
    <a href="/sell">出品</a>
</div>

商品一覧
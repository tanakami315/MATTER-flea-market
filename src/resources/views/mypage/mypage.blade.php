@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

<form action="/logout" method="post" class="header__logout-form">
    @csrf
    <button class="header__logout-button">logout</button>
</form>

マイページ

<div class="profile__link">
    <a href="/mypage/profile">プロフィールを編集</a>
</div>
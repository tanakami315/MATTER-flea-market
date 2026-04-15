@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

<form action="/logout" method="post" class="header__logout-form">
    @csrf
    <button class="header__logout-button">logout</button>
</form>

出品
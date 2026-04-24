@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <!-- ユーザーアイコンをuser.cssに記載 -->
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/label.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
    <div class="user">
    @csrf
        <div class="user-icon">
            @if(Auth::user()->icon)
                <img
                    class="user-icon__image"
                    src="{{ asset('storage/' . Auth::user()->icon) }}"
                    alt=""
                />
            @else
                <div class="user-icon__default"></div>
            @endif
        </div>
        <div class="user-name">{{ Auth::user()->name }}</div>
        <div class="profile">
            <a class="profile-link" href="/mypage/profile">プロフィールを編集</a>
        </div>
    </div>

    <div class="label">
        <div class="label__page">
            <a
                href="{{ url('/mypage') }}"
                class="label__page--link {{ request('tab')!='buy'?' active' : '' }}"
            >
                出品した商品
            </a>
            <a
                href="{{ url('mypage/?tab=buy') }}"
                class="label__page--link {{ request('tab')=='buy'? 'active' : '' }}"
            >
                購入した商品
            </a>
        </div>
    </div>

    <!-- 以下index.blade.phpとおなじ -->
    <div class="list">
        @foreach ($items as $item)
            <div class="item">
                <div class="item__image">
                    <a href="{{ url('/item/' . $item->id) }}">
                    @if (Str::startsWith($item->image, ['http://', 'https://']))
                        <img class="item__image--view" src="{{ $item->image }}" alt="商品画像">
                    @else
                        <img class="item__image--view" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
                    @endif
                    </a>
                    @if ($item->sold)
                        <span class="item__image--text">SOLD</span>
                    @endif
                </div>
                <div class="item__name">
                    {{ $item->name }}
                </div>
            </div>
        @endforeach
    </div>
@endsection


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
        <div class="user__icon">
            @if(Auth::user()->icon)
                <img
                    class="user__icon-image"
                    src="{{ asset('storage/' . Auth::user()->icon) }}"
                    alt=""
                />
            @else
                <div class="user__icon-default"></div>
            @endif
        </div>
        <div class="user__name">{{ Auth::user()->name }}</div>
        <div class="user__profile">
            <a class="user__profile-link" href="/mypage/profile">プロフィールを編集</a>
        </div>
    </div>

    <nav class="label">
        <div class="label__inner">
            <a
                href="{{ url('/mypage/?tab=sell') }}"
                class="label__link {{ request('tab')=='sell'?' label__link--active' : '' }}"
            >
                出品した商品
            </a>
            <a
                href="{{ url('mypage/?tab=buy') }}"
                class="label__link {{ request('tab')=='buy'? 'label__link--active' : '' }}"
            >
                購入した商品
            </a>
        </div>
    </nav>

    <!-- 以下index.blade.phpとおなじ -->
    <div class="list">
        @foreach ($items as $item)
            <div class="item">
                <div class="item__image">
                    <a href="{{ url('/item/' . $item->id) }}">
                    @if (Str::startsWith($item->image, ['http://', 'https://']))
                        <img class="item__image-img" src="{{ $item->image }}" alt="商品画像">
                    @else
                        <img class="item__image-img" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
                    @endif
                    </a>
                    @if ($item->sold)
                        <span class="item__sold-label">SOLD</span>
                    @endif
                </div>
                <div class="item__name">
                    {{ $item->name }}
                </div>
            </div>
        @endforeach
    </div>
@endsection


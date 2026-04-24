@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/label.css') }}">
    <link rel="stylesheet" href="{{ asset('css/list.css') }}">
@endsection

@section('content')
<div class="label">
    <div class="label__page">
        <a
            href="{{ url('/?keyword=' . request('keyword')) }}"
            class="label__page--link {{ request('tab')!='mylist'? 'active' : '' }}"
        >
            おすすめ
        </a>
        <a
            href="{{ url('/?tab=mylist&keyword=' . request('keyword')) }}"
            class="label__page--link {{ request('tab')=='mylist'? 'active' : '' }}"
        >
            マイリスト
        </a>
    </div>
</div>

<!-- 以下mypage.blade.phpとおなじ -->
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
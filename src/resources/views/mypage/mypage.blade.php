@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

@csrf
<img class="user-icon" src="{{ asset('storage/' . Auth::user()->icon) }}" alt="">
<div class="user_name">{{ Auth::user()->name }}</div>

<div class="profile__link">
    <a href="/mypage/profile">プロフィールを編集</a>
</div>

<div class="page_link">
    <a href="{{ url('/mypage') }}">出品した商品</a>
</div>
    <a href="{{ url('/mypage/?tab=buy') }}">購入した商品</a>
<div class="page_link">
</div>
<!-- 以下index.blade.phpとおなじ -->
@foreach ($items as $item)
        <tr class="result__content">
            <td>
                <a href="{{ url('/item/' . $item->id) }}">  
                @if (Str::startsWith($item->image, ['http://', 'https://']))
                    <img class="item-image" src="{{ $item->image }}" alt="">
                @else
                    <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="">
                @endif
                </a>
            </td>
            <td>{{ $item->name }}
                @if ($item->sold)
                    <span class="sold-out">SOLD OUT</span>
                @endif
            </td>
        </tr>
@endforeach

@endsection


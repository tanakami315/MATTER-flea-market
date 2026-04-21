@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="item-detail">
    @csrf
        <div class="item-detail__image">
            @if (Str::startsWith($item->image, ['http://', 'https://']))
                <img class="item-image" src="{{ $item->image }}" alt="">
            @else
                <img class="item-image" src="{{ asset('storage/' . $item->image) }}" alt="">
            @endif
        </div>
        @if ($item->sold)
        <div class="sold-out-overlay">
            <span class="sold-out-text">SOLD OUT</span>
        </div>
        @endif

        <div class="item-detail__content">
            <h2>{{ $item->name }}</h2>
            <p>ブランド：{{ $item->brand }}</p>
            <p>価格：¥{{ number_format($item->price) }}</p>
        </div>

        <form action="/item/{{ $item->id }}/like" method="post">
        @csrf
        @if (!$item->sold)
        <div class="button-section">
            <button type="submit" class="buy-button">いいね</button>
        </div>
        @endif
        </form>

        <form class="delete-form" action="/item/{{ $item->id }}/like" method="post">
            @method('delete')
            @csrf
            <button class="delete-form__button" type="submit">いいねを解除</button>
        </form>
        
        <form action="/purchase/{{ $item->id }}" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        @if (!$item->sold)
        <div class="button-section">
            <button type="submit" class="buy-button">購入手続きへ</button>
        </div>
        @endif
        </form>

        <div class="item-detail__{{ $item->id }}additional">
            <p>説明：{{ $item->description }}</p>
            <p>カテゴリー：{{ $item->category->content }}</p>
            <p>商品の状態：
                {{ $item->condition == 1 ? '良好' :
                    ($item->condition == 2 ? '目立った傷や汚れなし' :
                    ($item->condition == 3 ? 'やや傷や汚れあり' :
                    '状態が悪い')) }}
            </p>
        </div>
    </div>

<form action="/item/{{ $item->id }}/comment" method="post" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="item-comments">
        <h3>コメント</h3>
            @foreach ($comments as $comment)
                <div class="comment">
                    <p>{{ $comment->user->name }}: {{ $comment->comment }}</p>
                </div>
            @endforeach
        <h4>商品へのコメント</h4>
        <textarea rows="4" cols="50" name="comment"></textarea>
        @if (!$item->sold)
        <div class="button-section">
            <button type="submit" class="send-button">コメントを送信する</button>
        </div>
        @endif
    </div>
</form>

@endsection
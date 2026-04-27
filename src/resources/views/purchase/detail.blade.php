@extends('layouts.app')

@php
    $liked = $item->likes->where('user_id', auth()->id())->count();
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="item">
    @csrf
        <div class="item-group">
            <div class="item__image">
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
        </div>

        <div class="item-group">
            <div class="item__content">
                <h1 class="item__name">{{ $item->name }}</h1>
                <p class="item__brand">{{ $item->brand }}</p>
                <p class="item__price">
                    ￥
                    <span class="item__price--large">
                        {{ number_format($item->price) }}
                    </span>
                    (税込)
                </p>

                <div class="reaction">
                    <div class="reaction-info">
                        @if($liked)
                            <form
                                action="/item/{{ $item->id }}/like"
                                method="post"
                            >
                                @method('delete')
                                @csrf
                                <button
                                    class="reaction-image"
                                    type="submit"
                                >
                                    <img
                                        src="{{ asset('image/heart_pink.png' ) }}"
                                        alt="いいね解除"
                                        >
                                </button>
                            </form>
                        @else
                            <form
                                action="/item/{{ $item->id }}/like"
                                method="post"
                            >
                                @csrf
                                <button type="submit" class="reaction-image">
                                    <img
                                        src="{{ asset('image/heart.png' ) }}"
                                        alt="いいね"
                                    >
                                </button>
                            </form>
                        @endif
                        <span class="reaction-count--like">{{ $item->likes->count() }}</span>
                    </div>
                    <div class="reaction-info">
                        <div class="reaction-image">
                            <img
                                src="{{ asset('image/comment.png' ) }}"
                                alt="コメント"
                            >
                        </div>
                        <span class="reaction-count--comment">{{ $item->comments->count() }}</span>
                    </div>
                </div>

                <form action="/purchase/{{ $item->id }}" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    @if (!$item->sold)
                    <div class="button-section">
                        <button type="submit" class="submit-button">購入手続きへ</button>
                    </div>
                    @endif
                </form>

                <div class="item__detail">
                    <h2 class="item__subtitle">商品説明</h2>
                    <div class="item__description">{{ $item->description }}</div>
                </div>

                <div class="item__detail">
                    <h2 class="item__subtitle">商品の情報</h2>
                    <div class="item__classification">
                        <h3 class="item__classification-label">
                            カテゴリー
                        </h3>
                        <div class="item__classification-content">
                            <span class="item__classification-content--grey">
                                {{ $item->category->content }}
                            </span>
                        </div>
                    </div>
                    <div class="item__classification">
                        <h3 class="item__classification-label">
                            商品の状態
                        </h3>
                        <div class="item__classification-content">
                            {{ $item->condition == 1 ? '良好' :
                                ($item->condition == 2 ? '目立った傷や汚れなし' :
                                ($item->condition == 3 ? 'やや傷や汚れあり' :
                                '状態が悪い')) }}
                        </div>
                    </div>
                </div>
                <div class="item__detail">
                    <h2 class="item__subtitle">
                        <span class="change-color">コメント({{ $item->comments->count() }})</span>
                    </h2>
                        <form
                            action="/item/{{ $item->id }}/comment"
                            method="post"
                            enctype="multipart/form-data"
                            novalidate
                        >
                            @csrf
                            <div class="item-comments">
                            @foreach ($comments as $comment)
                                <div class="comment__show">
                                    <div class="comment-user">
                                        @if ($comment->user->icon)
                                            <img
                                                class="user-icon__image"
                                                src="{{ asset('storage/' . $comment->user->icon) }}"
                                                alt="アイコン"
                                            >
                                        @else
                                            <img
                                                class="user-icon__default"
                                                alt="デフォルト"
                                            >
                                        @endif

                                        <span class="comment-user__name">
                                            {{ $comment->user->name }}
                                        </span>
                                    </div>
                                    <p class="comment-user__text">
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                            @endforeach
                                @if (!$item->sold)
                                    <h4 class="comment__title">商品へのコメント</h4>
                                    <textarea class="comment__input" name="comment"></textarea>
                                    <div class="button-section">
                                        <button type="submit" class="submit-button">コメントを送信する</button>
                                    </div>
                                @endif
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
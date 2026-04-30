@extends('layouts.app')

@php
    $liked = $item->likes->where('user_id', auth()->id())->count();
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="item">
        <div class="item__group">
            <div class="item__image">
                @if (Str::startsWith($item->image, ['http://', 'https://']))
                    <img class="item__image-img" src="{{ $item->image }}" alt="商品画像">
                @else
                    <img class="item__image-img" src="{{ asset('storage/' . $item->image) }}" alt="商品画像">
                @endif
                @if ($item->sold)
                    <span class="item__sold-label">SOLD</span>
                @endif
            </div>
        </div>

        <div class="item__group">
            <div class="item__content">
                <h1 class="item__name">{{ $item->name }}</h1>
                <p class="item__brand">{{ $item->brand }}</p>
                <p class="item__price">
                    ￥
                    <span class="item__price-emphasis">
                        {{ number_format($item->price) }}
                    </span>
                    (税込)
                </p>

                <div class="reaction">
                    <div class="reaction__item">
                        @if($liked)
                            <form
                                action="/item/{{ $item->id }}/like"
                                method="post"
                            >
                                @method('delete')
                                @csrf
                                <button
                                    class="reaction__button"
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
                                <button
                                    class="reaction__button"
                                    type="submit"
                                >
                                    <img
                                        src="{{ asset('image/heart.png' ) }}"
                                        alt="いいね"
                                    >
                                </button>
                            </form>
                        @endif
                        <span
                            class="reaction__count
                                reaction__count--like"
                        >
                            {{ $item->likes->count() }}
                        </span>
                    </div>
                    <div class="reaction__item">
                        <div class="reaction__button">
                            <img
                                src="{{ asset('image/comment.png' ) }}"
                                alt="コメント"
                            >
                        </div>
                        <span
                            class="reaction__count
                                reaction__count--comment"
                        >
                            {{ $item->comments->count() }}
                        </span>
                    </div>
                </div>

                <form
                    action="/purchase/{{ $item->id }}"
                    method="post"
                    enctype="multipart/form-data"
                    novalidate
                >
                    @csrf
                    @if (
                        !$item->sold &&
                        ($item->user_id !== auth()->id())
                    )
                        <div class="button-wrapper">
                            <button
                                class="submit-button"
                                type="submit"
                            >
                                購入手続きへ
                            </button>
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
                            @foreach ($item->categories as $category)
                                <span class="item__classification-category">
                                    {{ $category->content }}
                                </span>
                            @endforeach
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
                    <h2 class="item__subtitle item__subtitle--grey">
                        コメント({{ $item->comments->count() }})
                    </h2>
                        <form
                            action="/item/{{ $item->id }}/comment"
                            method="post"
                            enctype="multipart/form-data"
                            novalidate
                        >
                            @csrf
                            <div class="item__comments">
                                @foreach ($item->comments as $comment)
                                    <div class="comment">
                                        <div class="comment__user">
                                            @if ($comment->user->icon)
                                                <img
                                                    class="user__icon-image"
                                                    src="{{ asset('storage/' . $comment->user->icon) }}"
                                                    alt=""
                                                >
                                            @else
                                                <img
                                                    class="user__icon-default"
                                                    alt=""
                                                >
                                            @endif

                                            <span class="user__name">
                                                {{ $comment->user->name }}
                                            </span>
                                        </div>
                                        <p class="comment__text">
                                            {{ $comment->comment }}
                                        </p>
                                    </div>
                                @endforeach
                                @if (!$item->sold)
                                    <h4 class="comment__title">商品へのコメント</h4>
                                    <textarea class="comment__input" name="comment"></textarea>
                                    <span class="input-form__error">
                                        @error('comment')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="button-wrapper">
                                        <button type="submit" class="submit-button">コメントを送信する</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
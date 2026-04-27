@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
    <div class="sell-form">
        <h1 class="sell-form__title">商品の出品</h1>
        <form
            class="sell-form__content"
            action="/sell"
            method="post"
            enctype="multipart/form-data"
            novalidate
        >
            @csrf
            <div class="sell-form__group">
                <div class="sell-form__item">
                    <label class="sell-form__label" for="image">商品画像</label>
                    <div class="sell-form__input--image">
                        <label class="image-box">
                            <input type="file" class="image-box__input" id="image" name="image" required>
                            <span class="image-box__text" for="image" name="image" >
                                画像を選択する
                            </span>
                        </label>
                    </div>
                </div>
                <h2 class="sell-form__subtitle">商品の詳細</h2>
                <div class="sell-form__item">
                    <label class="sell-form__label" for="category">カテゴリー</label>
                    <div class="sell-form__input--category" name="category_id">
                        @foreach($categories as $category)
                            <label class="category__item">
                                <input
                                    class="category__input"
                                    type="checkbox"
                                    name="category_id"
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'checked' : '' }}
                                />
                                <span class="category__content">
                                    {{ $category->content }}
                                </span>
                            </label>
                        @endforeach
                        <span class="category__empty"></span>
                    </div>
                </div>
                <div class="sell-form__item">
                    <label class="sell-form__label" for="condition">コンディション</label>
                    <select class="sell-form__input--common condition" name="condition" required>
                        <option
                            value=""
                            disabled
                            hidden
                            {{ old('condition') ? '' : 'selected' }}
                        >
                            選択してください
                        </option>
                        <option value="1" {{ old('condition') == '1' ? 'selected' : '' }}>
                            良好
                        </option>
                        <option value="2" {{ old('condition') == '2' ? 'selected' : '' }}>
                            目立った傷や汚れなし
                        </option>
                        <option value="3" {{ old('condition') == '3' ? 'selected' : '' }}>
                            やや傷や汚れあり
                        </option>
                        <option value="4" {{ old('condition') == '4' ? 'selected' : '' }}>
                            状態が悪い
                        </option>
                    </select>
                </div>
                <div class="sell-form__item">
                    <label class="sell-form__label" for="name">商品名</label>
                    <input type="text" class="sell-form__input--common others" id="name" name="name" required>
                </div>
                <div class="sell-form__item">
                    <label class="sell-form__label" for="brand">ブランド</label>
                    <input type="text" class="sell-form__input--common  others" id="brand" name="brand" required>
                </div>
                <div class="sell-form__item">
                    <label class="sell-form__label" for="description">商品の説明</label>
                    <textarea class="sell-form__input--common description" id="description" name="description" ></textarea>
                </div>
                <div class="sell-form__item">
                    <label class="sell-form__label" for="price">販売価格</label>
                    <div class="sell-form__price">
                        <span class="sell-form__price-mark">￥</span>
                        <input type="text" class="sell-form__input--common price" id="price" name="price" required>
                    </div>
                </div>
                <div class="sell-form__item">
                    <input
                        type="hidden"
                        id="user_id"
                        name="user_id"
                        value="{{ Auth::id() }}"
                    >
                </div>
            </div>
            <div class="sell-form__button">
                <button class="sell-form__button--submit" type="submit" class="btn btn-primary">出品する</button>
            </div>
        </form>
    </div>
@endsection
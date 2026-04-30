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
                    <div class="sell-form__image-input">
                        <label
                            class="sell-form__image-box"
                            for="image"
                        >
                            <input
                                type="file"
                                class="image-box__input"
                                id="image"
                                name="image"
                                value="{{ old('image') }}"
                            >
                            <span
                                class="image-box__text"
                                for="image"
                                name="image"
                            >
                                画像を選択する
                            </span>
                        </label>
                    </div>
                    <div class="input-form__error">
                        @error('image')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <h2 class="sell-form__subtitle">商品の詳細</h2>
                <div class="sell-form__item">
                    <label class="sell-form__label" for="category">カテゴリー</label>
                    <div class="sell-form__category-input" name="category_id">
                        @foreach($categories as $category)
                            <label class="category__item">
                                <input
                                    class="category__input"
                                    type="checkbox"
                                    name="category_id[]"
                                    value="{{ $category->id }}"
                                    {{ in_array($category->id, old('category_id', [])) ? 'checked' : '' }}
                                />
                                <span class="category__content">
                                    {{ $category->content }}
                                </span>
                            </label>
                        @endforeach
                        <span class="category__empty"></span>
                    </div>
                    <div class="input-form__error">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="sell-form__item">
                    <label class="sell-form__label" for="condition">商品の状態</label>
                    <select
                        class="sell-form__input
                            sell-form__input--condition"
                        name="condition"
                    >
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
                    <div class="input-form__error">
                        @error('condition')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="sell-form__item">
                    <label
                        class="sell-form__label"
                        for="name"
                    >
                        商品名
                    </label>
                    <input
                        type="text"
                        class="sell-form__input
                            sell-form__input--others"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                    />
                    <div class="input-form__error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="sell-form__item">
                    <label
                        class="sell-form__label"
                        for="brand"
                    >
                        ブランド
                    </label>
                    <input
                        type="text"
                        class="sell-form__input
                            sell-form__input--others"
                        id="brand"
                        name="brand"
                        value="{{ old('brand') }}"
                    />
                </div>
                <div class="sell-form__item">
                    <label
                        class="sell-form__label"
                        for="description"
                    >
                        商品の説明
                    </label>
                    <textarea
                        class="sell-form__input
                            sell-form__input--description"
                        id="description"
                        name="description"
                    >{{ old('description') }}</textarea>
                    <div class="input-form__error">
                        @error('description')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="sell-form__item">
                    <label
                        class="sell-form__label"
                        for="price"
                    >
                        販売価格
                    </label>
                    <div class="sell-form__price">
                        <span class="sell-form__price-mark">￥</span>
                        <input
                            type="text"
                            class="sell-form__input
                                sell-form__input--price"
                            id="price"
                            name="price"
                            value="{{ old('price') }}"
                        >
                    </div>
                    <div class="input-form__error">
                        @error('price')
                            {{ $message }}
                        @enderror
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
            <div class="button-wrapper">
                <button class="submit-button" type="submit">
                    出品する
                </button>
            </div>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>商品の出品</h1>
    <form action="/sell" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group">
            <label for="image">画像</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <h2>商品の詳細</h2>
         <div class="contact-form__content">
                    <select class="contact-form__input--middle" name="category_id">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                            選択してください
                        </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
        <div class="contact-form__radio-choice">
                            <input class="contact-form__input--radio" type="radio" name="condition" value="1"
                                {{ old('condition') == '1' ? 'checked' : '' }}/>
                            <span class="contact-form__input">良好</span>
                        </div>
                        <div class="contact-form__radio-choice">
                            <input class="contact-form__input--radio" type="radio" name="condition" value="2"
                                {{ old('condition') == '2' ? 'checked' : '' }}/>
                            <span class="contact-form__input">目立った傷や汚れなし</span>
                        </div>
                        <div class="contact-form__radio-choices">
                            <input class="contact-form__input--radio" type="radio" name="condition" value="3"
                                {{ old('condition') == '3' ? 'checked' : '' }}/>
                            <span class="contact-form__input">やや傷や汚れあり</span>
                        </div>
                        <div class="contact-form__radio-choices">
                            <input class="contact-form__input--radio" type="radio" name="condition" value="3"
                                {{ old('condition') == '4' ? 'checked' : '' }}/>
                            <span class="contact-form__input">状態が悪い</span>
                        </div>
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="brand">ブランド</label>
            <input type="text" class="form-control" id="brand" name="brand" required>
        </div>
        <div class="form-group">
            <label for="description">商品の説明</label>
            <textarea class="form-control" id="description" name="description" ></textarea>
        </div>
        <div class="form-group">
            <label for="price">販売価格</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary">出品</button>
    </form>
</div>
@endsection
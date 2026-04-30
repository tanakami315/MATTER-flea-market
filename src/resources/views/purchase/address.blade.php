@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
    <div class="user-form">
        <h1 class="user-form__title">住所の変更</h1>
    
        <form
            class="user-form__content"
            action="/purchase/address/{{ $item->id }}"
            method="post"
            enctype="multipart/form-data"
            novalidate
        >
            @csrf
            <div class="user-form__group">
                <div class="user-form__item">
                    <label
                        class="user-form__label"
                        for="postal_code"
                    >
                        郵便番号
                    </label>
                    <input
                        class="user-form__input"
                        type="text"
                        name="postal_code"
                        value="{{  $purchaseAddress['postal_code'] }}"
                    />
                    <span class="input-form__error">
                        @error('postal_code')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                    
                <div class="user-form__item">
                    <label
                        class="user-form__label"
                        for="address"
                    >
                        住所
                    </label>
                    <input
                        class="user-form__input"
                        type="text"
                        name="address"
                        value="{{  $purchaseAddress['address'] }}"
                    />
                    <span class="input-form__error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="user-form__item">
                    <label
                        class="user-form__label"
                        for="building_name"
                    >
                        建物名
                    </label>
                    <input
                        class="user-form__input"
                        type="text"
                        name="building_name"
                        value="{{  $purchaseAddress['building_name'] }}"
                    />
                    <span class="input-form__error">
                        @error('building_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="button-wrapper">
                <button class="submit-button" type="submit">更新する</button>
            </div>
        </form>
    </div>
@endsection

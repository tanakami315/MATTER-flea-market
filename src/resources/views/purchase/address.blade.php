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
                    <label class="user-form__label">郵便番号</label>
                    <input
                        class="user-form__input"
                        type="text"
                        name="postal_code"
                        value="{{ old('postal_code', auth()->user()->postal_code) }}"
                    />
                    <span class="user-form__error">
                        @error('postal_code')
                            <span>{{ $message }}</span>
                        @enderror
                    </span>
                </div>
                    
                <div class="user-form__item">
                    <label class="user-form__label">住所</label>
                    <input
                        class="user-form__input"
                        type="text"
                        name="address"
                        value="{{ old('address',  auth()->user()->address) }}"
                    />
                    <span class="user-form__error">
                        @error('address')
                            <span>{{ $message }}</span>
                        @enderror
                    </span>
                </div>

                <div class="user-form__item">
                    <label class="user-form__label">建物名</label>
                    <input
                        class="user-form__input"
                        type="text"
                        name="building_name"
                        value="{{ old('building_name', auth()->user()->building_name) }}"
                    />
                    <span class="user-form__error">
                        @error('building_name')
                            <span>{{ $message }}</span>
                        @enderror
                    </span>
                </div>
            </div>
            <div class="user-form__button">
                <button class="user-form__button--submit" type="submit">更新する</button>
            </div>
        </form>
    </div>
@endsection

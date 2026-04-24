@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
    <div class="user-form">
        <h1 class="user-form__title">プロフィール設定</h1>

        <form
            class="user-form__content"
            action="/mypage/update"
            method="post"
            enctype="multipart/form-data"
            novalidate
        >
            @csrf
            <div class="user-form__group">
                <div class="user-form__item--icon">
                    @if(Auth::user()->icon)
                        <img
                            class="user-icon__image"
                            src="{{ asset('storage/' . Auth::user()->icon) }}"
                            alt=""
                        />
                    @else
                        <div class="user-icon__default"></div>
                    @endif
                    <label class="user-icon__label" for="icon" >画像を選択する</label>
                    <input type="file" class="user-icon__input" id="icon" name="icon" />
                </div>
                <div class="user-form__item">
                    <label class="user-form__label">ユーザー名</label>
                    <input class="user-form__input" type="text" name="name"
                        value="{{ old('name', auth()->user()->name) }}" />
                    <span class="user-form__error">
                        @error('name')
                            <span>{{ $message }}</span>
                        @enderror
                    </span>
                </div>

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

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('button')
<div class="login__link">
    <a href="/login">login</a>
</div>
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>Register</h2>
    </div>
  
    <div class="register-form__group">
        <form class="register-form" action="/register" method="post" novalidate>
            @csrf
            <div class="register-form__item">
                <div class="register-form__label">お名前</div>
                <input class="register-form__input" type="text" name="name" placeholder="例：山田　太郎" value="{{ old('name') }}" />
                <div class="register-form__error">
                    @error('name')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="register-form__item">
                <div class="register-form__label">メールアドレス</div>
                <input class="register-form__input" type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
                <div class="register-form__error">
                    @error('email')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="register-form__item">
                <div class="register-form__label">パスワード</div>
                <input class="register-form__input" type="password" name="password" placeholder="例：coachtech06" value="{{ old('password') }}" />
                <div class="register-form__error">
                    @error('password')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="register-form__item">
                <div class="register-form__label">確認用パスワード</div>
                <input class="register-form__input" type="password" name="password_confirmation" placeholder="例：coachtech06" value="{{ old('password_confirmation') }}" />
                <div class="register-form__error">
                    @error('password_confirmation')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="register-form__button">
                <button class="register-form__button-submit" type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection


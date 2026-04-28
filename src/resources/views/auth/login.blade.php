@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
<div class="user-form">
	<h1 class="user-form__title">ログイン</h1>
	
	<form class="user-form__content" action="/login" method="post" novalidate>
		@csrf
		<div class="user-form__group">
			<div class="user-form__item">
				<label class="user-form__label">メールアドレス</label>
				<input class="user-form__input" type="email" name="email" value="{{ old('email') }}" />
				<span class="user-form__error">
					@error('email')
					<span>{{ $message }}</span>
					@enderror
				</span>
			</div>

			<div class="user-form__item">
				<label class="user-form__label">パスワード</label>
				<input class="user-form__input" type="password" name="password" value="{{ old('password') }}" />
				<span class="user-form__error">
					@error('password')
					<span>{{ $message }}</span>
					@enderror
				</span>
			</div>
		</div>

		<div class="user-form__button">
			<button class="user-form__button--submit" type="submit">ログインする</button>
		</div>
	</form>
	<div class="auth__link">
		<a class="auth__link--submit" href="/register">会員登録はこちら</a>
	</div>
</div>
@endsection

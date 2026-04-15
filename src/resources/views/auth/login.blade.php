@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('button')
<div class="register__link">
	<a href="/register">register</a>
</div>
@endsection

@section('content')
<div class="login-form__content">
	<div class="login-form__heading">
		<h2>Login</h2>
	</div>
	
	<div class="login-form__group">
		<form class="login-form" action="/login" method="post" novalidate>
			@csrf
			<div class="login-form__item">
				<div class="login-form__label">メールアドレス</div>
				<input class="login-form__input" type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
				<div class="login-form__error">
					@error('email')
					<span>{{ $message }}</span>
					@enderror
				</div>
			</div>


			<div class="login-form__item">
				<div class="login-form__label">パスワード</div>
				<input class="login-form__input" type="password" name="password" placeholder="例：coachtech06" value="{{ old('password') }}" />
				<div class="login-form__error">
					@error('password')
					<span>{{ $message }}</span>
					@enderror
				</div>
			</div>

			<div class="login-form__button">
				<button class="login-form__button-submit" type="submit">ログイン</button>
			</div>
		</form>
	</div>
</div>
@endsection

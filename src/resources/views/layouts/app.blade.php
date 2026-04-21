@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet"> -->
    @yield('css')
    <!-- @livewireStyles
    <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body>
    <!-- @hasSection('no-header')
    @else -->
        <header class="header">
            <div class="header__inner">
                <span class="header__logo">FashionablyLate</span>
                    @if (Auth::check())
                        <form action="/logout" method="post" class="header__logout-form">
                            @csrf
                            <button class="header__logout-button">ログアウト</button>
                        </form>
                    @else
                        <a href="/login" class="header__login-link">ログイン</a>
                    @endif
                        <a href="/mypage" class="header__mypage-link">マイページ</a>
                        <a href="/sell" class="header__sell-link">出品</a>
                    
                @yield('button')
            </div>
        </header>
    <!-- @endif -->

    <main>
        @yield('content')
    </main>
    <!-- @livewireScripts -->
</body>

</html>

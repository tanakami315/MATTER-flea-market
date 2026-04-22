@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH FMA</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet"> -->
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                <img src="{{ asset('image/COACHTECH.png') }}" alt="COACHTECH">
            </a>
            <div class="header__search">
                <form class="search-form"action="{{ url('/search') }}" method="get">
                    @csrf
                    <input
                        class="search-form__content"
                        type="text"
                        name="keyword"
                        placeholder="なにをお探しですか？"
                        value="{{request('keyword') }}"
                    />
                    <button class="search-form__button" type="submit">検索</button>
                </form>
            </div>
            <div class="header__action">
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
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>

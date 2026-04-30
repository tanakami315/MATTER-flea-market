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
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                <img src="{{ asset('image/COACHTECH.png') }}" alt="COACHTECH">
            </a>
            <div class="header__search">
                <form
                    class="search-form"
                    action="{{ url('/search') }}"
                    method="get"
                >
                    <input type="hidden" name="tab" value="{{ request('tab') }}">
                    <input
                        class="search-form__input"
                        type="text"
                        name="keyword"
                        placeholder="なにをお探しですか？"
                        value="{{request('keyword') }}"
                    />
                    <button class="search-form__button" type="submit">検索</button>
                </form>
            </div>
            <nav class="header__nav">
                @if (Auth::check())
                    <form action="/logout"
                        method="post"
                    >
                        @csrf
                        <button
                            class="header__nav-link
                                header__nav-link--logout"
                            type="submit"
                        >
                            ログアウト
                        </button>
                    </form>
                @else
                    <a
                        href="/login"
                        class="header__nav-link
                            header__nav-link--common"
                    >
                        ログイン
                    </a>
                @endif
                    <a
                        href="/mypage"
                        class="header__nav-link
                            header__nav-link--common"
                    >
                        マイページ
                    </a>
                    <a
                        href="/sell"
                        class="header__nav-link
                            header__nav-link--sell"
                    >
                        出品
                    </a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>

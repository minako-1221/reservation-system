<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @yield('css')
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="header__left">
                <div class="menu-toggle" id="menu-toggle">
                    <span class="bar medium"></span>
                    <span class="bar long"></span>
                    <span class="bar short"></span>
                </div>
                <div class="header__logo">
                    <a href="/">Rese</a>
                </div>
            </div>
            <div class="header__right">
                @yield('header-right')
            </div>
        </nav>
    </header>
    <div class="modal" id="modal">
        <ul class="modal-menu" id="modal-menu">
            @guest
                <li><a href="/">Home</a></li>
                <li><a href="/register">Registration</a></li>
                <li><a href="/login">Login</a></li>
            @endguest
            @auth
                <li><a href="/">Home</a></li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="logout-button">Logout</button>
                    </form>
                </li>
                <li><a href="/mypage">Mypage</a></li>
            @endauth
        </ul>
    </div>
    <main>
        @yield('content')
    </main>
    <script src="{{ asset('js/modal.js') }}"></script>
    @yield('js')
</body>

</html>
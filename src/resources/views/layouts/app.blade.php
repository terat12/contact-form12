<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','FashionablyLate')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>

<body>
    <header class="site-header">
        <div class="wrap">
            <h1 class="brand">
                <a href="{{ route('contact.create') }}">FashionablyLate</a>
            </h1>

            <nav class="nav">
                @if (View::hasSection('header_right'))
                @yield('header_right')
                @else
                @auth
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="linklike">logout</button>
                </form>
                @endauth
                @guest
                <a href="{{ route('register') }}">register</a>
                <a href="{{ route('login') }}">login</a>
                @endguest
                @endif
            </nav>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>
</body>

</html>
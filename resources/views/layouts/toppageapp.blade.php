<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('head')
    <title>@yield('title')</title>
    @vite(['resources/css/toppageapp.css'])
</head>
<body>
    <header>@yield('header')</header>
    <main>@yield('main')</main>
    <footer>@yield('footer')</footer>
</body>
</html>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('head')
    <title>@yield('title')</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com
    /bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
</head>
<body>
    <h1>@yield('title')</h1>
    <header>@yield('header')</header>
    <main>@yield('main')</main>
    <footer>@yield('footer')</footer>
</body>
</html>
@extends('layouts.todoapp')

@yield('title','ホーム画面')

@section('header')
ヘッダー
@endsection

@section('main')
@if(Auth::check())
<p>USER: {{ Auth::user()->name }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>
@else
<p><a href="/register">登録はこちら</a>|<a href="/login">ログインはこちら</a></p>
@endif
@endsection

@section('footer')
copyright 2024 watanabe
@endsection
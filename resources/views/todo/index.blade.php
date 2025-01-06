@extends('layouts.toppageapp')
@section('title')
todoアプリ
@endsection

@section('main')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">todoアプリ</h1>
        
        @if(Auth::check())
        <p class="text-center text-lg text-gray-700 mb-4">USER: {{ Auth::user()->name }}</p>
        <form method="POST" action="{{ route('logout') }}" class="flex justify-center">
            @csrf
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                ログアウト
            </button>
        </form>
        @else
        <div class="flex justify-center space-x-4 mt-4">
            <a href="/register" class="text-blue-600 hover:underline">登録</a>
            <span>|</span>
            <a href="/login" class="text-blue-600 hover:underline">ログイン</a>
            <span>|</span>
            <a href="/guestlogin" class="text-blue-600 hover:underline">ゲストログイン</a>
        </div>
        @endif
    </div>
</div>
@endsection

@section('footer')
<div class="text-center py-4 bg-gray-800 text-white mt-6">
    copyright 2024 watanabe
</div>
@endsection
@extends('layouts.todoapp')

<style>
    body {
        position:relative;
        z-index:1;
    }

    .menu-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        display:flex;
        flex-direction: column;
        height:60px;
    }
    .menu-header__list--info {
        display:flex;
        justify-content: space-between;
        width:100%;
        padding:30px;
        background-color:white;
    }

    main {
        padding-top:100px;
    }

    .hidden-taskadd {
        margin:0 auto;
    }
    .list-area__content {
        width:50%;
        text-align:center;
        border-radius:20px;
        margin:10px auto;
    }
    
    
    .menu-footer {
        display:flex;
        justify-content: space-between;
        width:100%;
        position: fixed;
        bottom:0;
    }
    .menu-footer__btn--delete,.menu-footer__btn--taskadd {
        padding: 0 30px 40px 30px;
    }

</style>

@section('title')
Todoリスト
@endsection


@section('header')
    <div class="header-top">
        <div class="settings-menu__container">
            <button class="settings-menu__btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path fill="#888888" d="m19.588 15.492l-1.814-1.29a6.483 6.483 0 0 0-.005-3.421l1.82-1.274l-1.453-2.514l-2.024.926a6.484 6.484 0 0 0-2.966-1.706L12.953 4h-2.906l-.193 2.213A6.483 6.483 0 0 0 6.889 7.92l-2.025-.926l-1.452 2.514l1.82 1.274a6.483 6.483 0 0 0-.006 3.42l-1.814 1.29l1.452 2.502l2.025-.927a6.483 6.483 0 0 0 2.965 1.706l.193 2.213h2.906l.193-2.213a6.484 6.484 0 0 0 2.965-1.706l2.025.927l1.453-2.501ZM13.505 2.985a.5.5 0 0 1 .5.477l.178 2.035a7.45 7.45 0 0 1 2.043 1.178l1.85-.863a.5.5 0 0 1 .662.195l2.005 3.47a.5.5 0 0 1-.162.671l-1.674 1.172c.128.798.124 1.593.001 2.359l1.673 1.17a.5.5 0 0 1 .162.672l-2.005 3.457a.5.5 0 0 1-.662.195l-1.85-.863c-.602.49-1.288.89-2.043 1.179l-.178 2.035a.5.5 0 0 1-.5.476h-4.01a.5.5 0 0 1-.5-.476l-.178-2.035a7.453 7.453 0 0 1-2.043-1.179l-1.85.863a.5.5 0 0 1-.663-.194L2.257 15.52a.5.5 0 0 1 .162-.671l1.673-1.171a7.45 7.45 0 0 1 0-2.359L2.42 10.148a.5.5 0 0 1-.162-.67L4.26 6.007a.5.5 0 0 1 .663-.195l1.85.863a7.45 7.45 0 0 1 2.043-1.178l.178-2.035a.5.5 0 0 1 .5-.477h4.01ZM11.5 9a3.5 3.5 0 1 1 0 7a3.5 3.5 0 0 1 0-7Zm0 1a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5Z"/>
                </svg>
            </button>
        </div>

        <div class="main-menu__container">
            <button class="main-menu__btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path fill="#888888" d="M3 8V7h17v1zm17 4v1H3v-1zM3 17h17v1H3z"/>
                </svg>
            </button>
        </div>
    </div>
    
    <div class="date-tabs">
        <button id="tasks-today_btn" class="date-tabs__btn date-tabs__btn--today">今日</button>
        <button id="tasks-tomorrow_btn" class="date-tabs__btn date-tabs__btn--tommorow">明日</button>
        <button id="tasks-thisWeek_btn" class="date-tabs__btn date-tabs__btn--thisweek">今週</button>
    </div>
@endsection

@section('main')
<form action="{{ route('todo.index') }}" method="post">
        @csrf
        @method('DELETE')
<ul id="tasks-today" class="tasks-list">
    @foreach ($todayPosts as $post)
        <li class="tasks-list__item" style="background-color: {{ $post->color }}">
            <input type="checkbox" id="todoPosts{{ $post->id }}" value="{{ $post->message }}">
            <label for="todoPosts">{{ $post->message }}</label>
        </li>
    @endforeach
</ul>

<ul id="tasks-tomorrow" class="tasks-list hidden">
    @foreach ($tomorrowPosts as $post)
        <li class="tasks-list__item" style="background-color: {{ $post->color }}">
            <input type="checkbox" id="todoPosts{{ $post->id }}" value="{{ $post->message }}">
            <label for="todoPosts">{{ $post->message }}</label>
        </li>
    @endforeach
</ul>

<ul id="tasks-thisWeek" class="tasks-list hidden">
    @foreach ($thisWeekPosts as $post)
        <li class="tasks-list__item" style="background-color: {{ $post->color }}">
            <input type="checkbox" id="todoPosts{{ $post->id }}" value="{{ $post->message }}">
            <label for="todoPosts">{{ $post->message }}</label>
        </li>
    @endforeach
</ul>

<button type="submit" id="hiddenDeleteButton" style="display: none;">削除</button>
</form>

<div class="tasks-delete__container">
    <button class="tasks-delete__btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
        <path fill="#888888" d="M18 19a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V7H4V4h4.5l1-1h4l1 1H19v3h-1zM6 7v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V7zm12-1V5h-4l-1-1h-3L9 5H5v1zM8 9h1v10H8zm6 0h1v10h-1z"/>
        </svg>
    </button>
</div>

<div class="tasks-add__container">
    <button id="toggleFormBtn" class="tasks-add__btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
    <path fill="#888888" d="M7 12h4V8h1v4h4v1h-4v4h-1v-4H7zm4.5-9a9.5 9.5 0 0 1 9.5 9.5a9.5 9.5 0 0 1-9.5 9.5A9.5 9.5 0 0 1 2 12.5A9.5 9.5 0 0 1 11.5 3m0 1A8.5 8.5 0 0 0 3 12.5a8.5 8.5 0 0 0 8.5 8.5a8.5 8.5 0 0 0 8.5-8.5A8.5 8.5 0 0 0 11.5 4"/>
    </svg>
    </button>
    
    <div id="inputFormContainer" class="tasks-add-form__container">
    @include('todo.create')
    </div>
</div>

@endsection
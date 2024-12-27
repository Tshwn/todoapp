@extends('layouts.todoapp')

@section('title')
過去のタスク
@endsection


@section('header')
    <div class="header-top">
        <div class="settings-menu__container">
            <button id="settingsMenuBtn" class="settings-menu__btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                <path fill="#888888" d="m19.588 15.492l-1.814-1.29a6.483 6.483 0 0 0-.005-3.421l1.82-1.274l-1.453-2.514l-2.024.926a6.484 6.484 0 0 0-2.966-1.706L12.953 4h-2.906l-.193 2.213A6.483 6.483 0 0 0 6.889 7.92l-2.025-.926l-1.452 2.514l1.82 1.274a6.483 6.483 0 0 0-.006 3.42l-1.814 1.29l1.452 2.502l2.025-.927a6.483 6.483 0 0 0 2.965 1.706l.193 2.213h2.906l.193-2.213a6.484 6.484 0 0 0 2.965-1.706l2.025.927l1.453-2.501ZM13.505 2.985a.5.5 0 0 1 .5.477l.178 2.035a7.45 7.45 0 0 1 2.043 1.178l1.85-.863a.5.5 0 0 1 .662.195l2.005 3.47a.5.5 0 0 1-.162.671l-1.674 1.172c.128.798.124 1.593.001 2.359l1.673 1.17a.5.5 0 0 1 .162.672l-2.005 3.457a.5.5 0 0 1-.662.195l-1.85-.863c-.602.49-1.288.89-2.043 1.179l-.178 2.035a.5.5 0 0 1-.5.476h-4.01a.5.5 0 0 1-.5-.476l-.178-2.035a7.453 7.453 0 0 1-2.043-1.179l-1.85.863a.5.5 0 0 1-.663-.194L2.257 15.52a.5.5 0 0 1 .162-.671l1.673-1.171a7.45 7.45 0 0 1 0-2.359L2.42 10.148a.5.5 0 0 1-.162-.67L4.26 6.007a.5.5 0 0 1 .663-.195l1.85.863a7.45 7.45 0 0 1 2.043-1.178l.178-2.035a.5.5 0 0 1 .5-.477h4.01ZM11.5 9a3.5 3.5 0 1 1 0 7a3.5 3.5 0 0 1 0-7Zm0 1a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5Z"/>
                </svg>
            </button>
            <ul id="settingsMenu" class="settings-menu">
                <br></br>
                @if(Auth::check())
                <li>user name:{{ Auth::user()->name }}</li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="settings-menu__logout" type="submit">ログアウト</button>
                    </form>
                </li>
                @else
                <li><a href="/login">ログイン</a></li>
                <li><a href="/register">登録</a></li>
                @endif
            </ul>
        </div>

        <div class="search-menu_container">
            <button id="searchMenuBtn" class="search-menu__btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 16 16">
            <path fill="currentColor" d="m11.271 11.978l3.872 3.873a.5.5 0 0 0 .708 0a.5.5 0 0 0 0-.708l-3.565-3.564c2.38-2.747 2.267-6.923-.342-9.532c-2.73-2.73-7.17-2.73-9.898 0s-2.728 7.17 0 9.9a6.96 6.96 0 0 0 4.949 2.05a.5.5 0 0 0 0-1a5.96 5.96 0 0 1-4.242-1.757a6.01 6.01 0 0 1 0-8.486a6.004 6.004 0 0 1 8.484 0a6.01 6.01 0 0 1 0 8.486a.5.5 0 0 0 .034.738"/>
            </svg>
            </button>
            <form id="searchForm" action="{{ route('todo.search') }}" class="search-menu__form hidden" method="post">
                @csrf
                <input id="searchFormText" class="search-menu__text" type="text" name="text" value="{{ old('text') }}" placeholder="タスクを検索">
                <input type="submit" class="search-menu__submit" value="検索する">
            </form>
        </div>
            
            <div class="main-menu__container">
                <button id="mainMenuBtn" class="main-menu__btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="#888888" d="M3 8V7h17v1zm17 4v1H3v-1zM3 17h17v1H3z"/>
                    </svg>
                </button>
                <ul id="mainMenu" class="main-menu">
                    <br></br>
                    <li><a href="{{ route('todo.index') }}">メインページ</a></li>
                    <li><a href="{{ route('todo.upcomingTasks') }}">タスク一覧</a></li>
                    <li><a href="{{ route('todo.pastTasks') }}">終了したタスク</a></li>
                    <li><a href="">カレンダー</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="date-tabs">
        <div>終了した過去のタスク一覧</div>
    </div>
@endsection

@section('main')
    <div id="inputFormContainer" class="tasks-add-form__container">
    @include('todo.create')
    </div>


    <div class="main-top__space">

        <div class="show-error">
            @if ($errors->any())
                    <div class="text-red-500">{{ $errors->first() }}</div>
            @endif
        </div>

        <form method="GET" action="{{ route('todo.pastTasks') }}" class="tasks-sort-form">
        @csrf
            <select name="sort_by" id="sortBy">
                <option value="dateAsc">日付(昇順)</option>
                <option value="dateDesc">日付(降順)</option>

                <option value="createdAsc">作成順(昇順)</option>
                <option value="createdDesc">作成順(降順)</option>
                
                <option value="colorAsc">色(赤上)</option>
                <option value="colorDesc">色(白上)</option>  
            </select>
            <input class="tasks-sort-form__submit" type="submit" value="ソートする">
        </form>
    </div>

<form action="{{ route('todo.deleteMultiple') }}" method="post">
        @csrf
        @method('DELETE')
    @foreach ($posts as $post)
        <div class="tasks-list__item" style="background-color: {{ $post->color }}">
            <input type="checkbox" name="items[]" id="itemToday_{{ $post->id }}" class="tasks-list__item--checkbox" value="{{ $post->id }}">
            <span class="tasks-list__item--content">{{ $post->message }}  {{ $post->formatedDate }}</span>
            <a href="{{ route('todo.edit', $post->id) }}" class="tasks-list__item--edit">編集</a>
        </div>
    @endforeach

<button type="submit" id="hiddenDeleteButton" style="display:none">削除</button>
</form>

<div class="tasks__btn">
    <button id="DeleteBtn" class="tasks-delete__btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
        <path fill="#888888" d="M18 19a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V7H4V4h4.5l1-1h4l1 1H19v3h-1zM6 7v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V7zm12-1V5h-4l-1-1h-3L9 5H5v1zM8 9h1v10H8zm6 0h1v10h-1z"/>
        </svg>
    </button>

    <button id="toggleFormBtn" class="tasks-add__btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
    <path fill="#888888" d="M7 12h4V8h1v4h4v1h-4v4h-1v-4H7zm4.5-9a9.5 9.5 0 0 1 9.5 9.5a9.5 9.5 0 0 1-9.5 9.5A9.5 9.5 0 0 1 2 12.5A9.5 9.5 0 0 1 11.5 3m0 1A8.5 8.5 0 0 0 3 12.5a8.5 8.5 0 0 0 8.5 8.5a8.5 8.5 0 0 0 8.5-8.5A8.5 8.5 0 0 0 11.5 4"/>
    </svg>
    </button>
</div>

@endsection
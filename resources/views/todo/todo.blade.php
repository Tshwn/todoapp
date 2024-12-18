@extends('layouts.todoapp')

<style>
    .c-header {
        display:flex;
        justify-content: space-between;
        width:100%;
    }
    .settings,.menubar {
        padding:30px;
    }

    .c-footer {
        display:flex;
        justify-content: space-between;
        width:100%;
        position: fixed;
        bottom:0;
    }
    .delete,.taskadd {
        padding: 0 30px 40px 30px;
    }

    .c-list-area__content {
        width:50%;
        text-align:center;
        border-radius:20px;
        margin:10px auto;
    }
</style>

@section('title')
Todoリスト
@endsection


@section('header')
<div class="c-header">
<p class="settings">@include('components.settings-logo')</p>
<p class="menubar">@include('components.menubar-logo')</p>
</div>
@include('components.taskview')
@endsection

@section('main')
@foreach ($posts as $post)
    <ul class="c-list-area__content" style="background-color: {{ $post->color }}">
        <li class="checkbox"><input type="checkbox" id="todoPosts" value="{{ $post->message }}">
        <label for="todoPosts">{{ $post->message }}</label>
        </li>
    </ul>
@endforeach

@section('footer')
<div class="c-footer">
<p class="delete">@include('components.delete-logo')</p>
<p class="taskadd">@include('components.taskadd-logo')</p>
</div>
@endsection

@endsection
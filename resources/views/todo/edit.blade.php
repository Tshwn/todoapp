@extends('layouts.todoapp')
<button class="tasks-edit-back__button" onclick="window.history.back();">
  戻る
</button>
<form action="{{ route('todo.update', $post->id) }}" id="editForm" class="tasks-edit-form" method="post">
  @csrf
  @method('PUT')
  <input type="text" class="tasks-edit-form__text tasks-edit-form__item" name="message" value="{{ $post->message }}">

  <div class="tasks-edit-form__color tasks-edit-form__item">
    <label>
      <input type="radio" name="colors_id" value="1" class="color-radio tasks-edit-form__item" checked/>
      <span class="color-circle"></span>
    </label>
    
    <label>
      <input type="radio" name="colors_id" value="2" class="color-radio tasks-edit-form__item" />
      <span class="color-circle"></span>
    </label>
 
    <label>
      <input type="radio" name="colors_id" value="3" class="color-radio tasks-edit-form__item" />
      <span class="color-circle"></span>
    </label>
  </div>

  <input type="date" class="tasks-edit-form__date tasks-edit-form__item" name="due_date" value="{{ $post->due_date }}">
  <button class="tasks-edit-form__submit">
    タスクを変更する
  </button>
</form>
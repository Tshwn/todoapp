@extends('layouts.todoapp')
<a href="{{ route('todo.index') }}">戻る</a>
<form action="{{ route('todo.update', $form->id) }}" id="editForm" class="tasks-edit-form" method="post">
  @csrf
  @method('PUT')
  <input type="text" class="tasks-edit-form__text tasks-edit-form__item" name="message" value="{{ $form->message }}">

  <div class="tasks-edit-form__color tasks-edit-form__item">
    <label>
      <input type="radio" name="color" value="#FF0000" class="color-radio" checked/>
      <span class="color-circle"></span>
    </label>
    
    <label>
      <input type="radio" name="color" value="#00FF00" class="color-radio tasks-edit-form__item" />
      <span class="color-circle"></span>
    </label>
    
    <label>
      <input type="radio" name="color" value="#D3D3D3" class="color-radio tasks-edit-form__item" />
      <span class="color-circle"></span>
    </label>
  </div>

  <input type="date" class="tasks-edit-form__date tasks-edit-form__item" name="due_date" value="{{ $form->due_date }}">
  <button class="tasks-edit-form__submit">
    タスクを変更する
  </button>
</form>
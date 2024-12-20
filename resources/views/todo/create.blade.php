<form action="{{ route('todo.index') }}" id="inputForm" class="tasks-add-form" method="post">
<div>
  @csrf
  <input type="text" class="tasks-add-form__text" name="message" value="{{ old('message') }}">

  <div class="tasks-add-form__color">
    <label>
      <input type="radio" name="color" value="#FF0000" class="color-radio" checked/>
      <span class="color-circle"></span>
    </label>
    
    <label>
      <input type="radio" name="color" value="#00FF00" class="color-radio" />
      <span class="color-circle"></span>
    </label>
    
    <label>
      <input type="radio" name="color" value="#D3D3D3" class="color-radio" />
      <span class="color-circle"></span>
    </label>
  </div>

  <input type="date" class="tasks-add-form__date" name="due_date" value="{{ old('due_date') }}">
  <button class="tasks-add-form__submit">
    タスクを追加する
  </button>
</div>
</form>
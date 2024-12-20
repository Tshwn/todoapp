<form action="{{ route('todo.index') }}" id="inputForm" class="tasks-add-form" method="post">
  @csrf
  <input type="text" class="tasks-add-form__text tasks-add-form__item" name="message" value="{{ old('message') }}">

  <div class="tasks-add-form__color tasks-add-form__item">
    <label>
      <input type="radio" name="color" value="#FF0000" class="color-radio" checked/>
      <span class="color-circle"></span>
    </label>
    
    <label>
      <input type="radio" name="color" value="#00FF00" class="color-radio tasks-add-form__item" />
      <span class="color-circle"></span>
    </label>
    
    <label>
      <input type="radio" name="color" value="#D3D3D3" class="color-radio tasks-add-form__item" />
      <span class="color-circle"></span>
    </label>
  </div>

  <input type="date" class="tasks-add-form__date tasks-add-form__item" name="due_date" value="{{ $today }}">
  <button class="tasks-add-form__submit">
    タスクを追加する
  </button>
</form>
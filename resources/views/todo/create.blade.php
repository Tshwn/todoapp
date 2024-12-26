<form action="{{ route('todo.index') }}" id="inputForm" class="tasks-add-form" method="post">
  @csrf
  <input type="text" class="tasks-add-form__text tasks-add-form__item" name="message" value="{{ old('message') }}">

  <div class="tasks-add-form__color tasks-add-form__item">
    <label>
      <input type="radio" name="colors_id" value="1" class="color-radio tasks-add-form__item" checked/>
      <span class="color-circle"></span>
    </label>
    
    <label>
      <input type="radio" name="colors_id" value="2" class="color-radio tasks-add-form__item" />
      <span class="color-circle"></span>
    </label>
 
    <label>
      <input type="radio" name="colors_id" value="3" class="color-radio tasks-add-form__item" />
      <span class="color-circle"></span>
    </label>
  </div>

  <input type="date" class="tasks-add-form__date tasks-add-form__item" name="due_date" value="{{ $today }}">
  <button class="tasks-add-form__submit">
    タスクを追加する
  </button>
</form>
@extends('layouts.todoapp')
<style>
input[type="radio"]{
    display: none;
}

.color-circle {
    display: inline-block;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid #ccc;
    cursor: pointer;
    transition: border-color 0.3s, transform 0.3s;
}

/* ラジオボタンが選択されていないときの色を表示 */
.color-radio[value="1"] + .color-circle {
    background-color: #ff6347;
}
.color-radio[value="2"] + .color-circle {
    background-color: #00ff7f;
}
.color-radio[value="3"] + .color-circle {
    background-color: #d3d3d3;
}

/* ラジオボタンが選択されたときの枠線を太く */
.color-radio:checked + .color-circle {
    border-color: #333;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    transform: scale(1.1); /* 少し拡大することで、選択された感覚を強調 */
}

.tasks-edit-back__button {
    height: 40px;
    background-color: gray; /* ボタンの背景色 */
    color: white; /* 文字色 */
    padding: 0 40px; /* 上下の余白を0にして横幅のみ調整 */
    margin: 30px;
    border: none; /* ボタンの枠線をなしに */
    border-radius: 5px; /* 角を丸く */
    font-size: 20px; /* 文字の大きさ */
    cursor: pointer; /* ポインタがボタンの上に来たときにカーソルが指に変わる */
    transition: background-color 0.3s ease; /* 背景色が変わるアニメーション */
    line-height: 30px; /* 文字を縦方向に中央揃え */
}
.tasks-edit-form__container {
    border:1px solid black;
    width: 100%;
}

.tasks-edit-form {
    height:70vh;
    display: flex;
    flex-direction: column;
    background-color: #b0c4de; /* 追加した */
    border: solid 1px #121212;
}

.tasks-edit-form__item {
    margin: 5px auto;
    text-align: center;
}

.tasks-edit-form__text {
    margin-top: 20px;
    height: 30px;
}

.tasks-edit-form__date {
    height: 30px;
}

.tasks-edit-form__submit {
    width: 200px;
    font-size: 20px;
    margin: 20px auto;
    padding: 10px 0;
    border: solid 2px #121212;
}
</style>
<button class="tasks-edit-back__button" onclick="window.history.back();">
  戻る
</button>
<div class="tasks-edit-form__container">
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
      <input type="radio" name="colors_id" value="3" class="color-radio tasks-edit-form__item"/>
      <span class="color-circle"></span>
    </label>
  </div>

  <input type="date" class="tasks-edit-form__date tasks-edit-form__item" name="due_date" value="{{ $post->due_date }}">
  <button class="tasks-edit-form__submit">
    タスクを変更する
  </button>
</form>
</div>
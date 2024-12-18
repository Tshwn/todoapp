<style>
    .color-radio {
    display: none;
  }

  /* 色付き丸のスタイル */
  .color-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-block;
    margin: 5px;
    cursor: pointer;
    border: 2px solid transparent; /* ボーダーを透明にして、選択された時にのみ変化をつける */
    transition: transform 0.3s ease, border 0.2s ease;
  }

  /* ラジオボタンが選択されたときに円に変化をつける */
  .color-radio:checked + .color-circle {
    transform: scale(1.2);  /* クリック時に丸が少し大きくなる */
    border: 2px solid #000; /* 選択された時に周りに境界線をつける */
  }

  /* ラベルにホバーしたときのエフェクト */
  .color-circle:hover {
    transform: scale(1.1);
  }
</style>

<form action="{{ route('todo.update',$form->id) }}" method="post">
    @csrf
    @method('put')
    <p>{{ $form->id }}</p>
    <input type="hidden" name="id" value="{{ $form->id }}">
    <p>やること:<input type="text" name="message" value="{{ $form->message }}"></p>
    <li>
          <!-- Red -->
  <label>
    <input type="radio" name="color" value="#FF0000" class="color-radio" />
    <span class="color-circle" style="background-color: #FF0000;"></span>
  </label>
  
  <!-- Green -->
  <label>
    <input type="radio" name="color" value="#00FF00" class="color-radio" />
    <span class="color-circle" style="background-color: #00FF00;"></span>
  </label>
  
  <!-- Blue -->
  <label>
    <input type="radio" name="color" value="#D3D3D3" class="color-radio" />
    <span class="color-circle" style="background-color: #D3D3D3;"></span>
  </label>
    </li>
    <p>やる日:<input type="date" name="due_date" value="{{ $form->due_date }}"></p>
    <input type="submit" value="更新する">
</form>
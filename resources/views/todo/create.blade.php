<div class="input_div">
<form action="{{ route('todo.index') }}" method="post">
<ul class="input_ul">
    @csrf
    
    <li>
        やること:<input type="text" name="message" value="{{ old('message') }}">
    </li>

    <li>
          <!-- Red -->
  <label>
    <input type="radio" name="color" value="#FF0000" class="color-radio" checked/>
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
    
    <li>
        やる日:<input type="date" name="due_date" value="{{ old('due_date') }}">
    </li>

    <li>
        <button>
        追加する
        </button>
    </li>
</ul>
</form>
</div>
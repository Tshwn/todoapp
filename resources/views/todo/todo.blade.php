@extends('layouts.todoapp')

<style>
    .c-list-area {
        .c-list-area__hedding {
            list-style:none;
            padding-left:0;
            display:flex;
            
            li {
                flex:1;
            }
        }

        .c-list-area__content {
            list-style:none;
            padding-left:0;
            display:flex;
            
            li {
                flex:1;
            }
    }
}

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

@section('title')
Todoリスト
@endsection


@section('header')
<h2>今日やること</h2>
@endsection

@section('main')


<div class="c-list-area">
    <ul class="c-list-area__hedding">
        <li>やること</li>
        <li>変更</li>
        <li>削除</li>
        
    </ul>
    @foreach ($posts as $post)
    <ul class="c-list-area__content" style="background-color: {{ $post->color }}">
            <li class="checkbox"><input type="checkbox" id="todoPosts" value="{{ $post->message }}">
            <label for="todoPosts">{{ $post->message }}</label>
            </li>

            <li>
                <form action="{{ route('todo.edit',$post->id) }}" method="get">
                @csrf
                <button>
                Edit
                </button>
                </form>
            </li>

            <li>
                <form action="{{ route('todo.delete',$post->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button>
                    Delete
                    </button>
                </form>
            </li>
</ul>
        @endforeach
</div>

<div class="input-area">
    @include('todo.create')
</div>

@endsection
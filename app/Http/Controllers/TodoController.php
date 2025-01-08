<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $query = Board::UserPosts($user);
        $sortBy = $request->input('sort_by','colorAsc');
        $search = $request->session()->get('search', null);
        if(isset($search)) {
            $query->where('message','like','%' . $search . '%');
        }
        if($sortBy === 'dateAsc'):
            $query->orderBy('due_date','asc');
        elseif($sortBy === 'dateDesc'):
            $query->orderBy('due_date','desc');
        elseif($sortBy === 'createdAsc'):
            $query->orderBy('created_at','asc');
        elseif($sortBy === 'createdDesc'):
            $query->orderBy('created_at','desc');
        elseif($sortBy === 'colorAsc'):
            $query->orderBy('colors_id','asc');
        elseif($sortBy === 'colorDesc'):
            $query->orderBy('colors_id','desc');
        endif;
        
        $todayPosts = $query->clone()->TodayPosts()->get();
        $tomorrowPosts = $query->clone()->TomorrowPosts()->get();
        $thisWeekPosts = $query->clone()->ThisWeekPosts()->get();
        //get()で呼び出すと$queryの中身が取得した結果になるので、clone()を使って$queryに直接変化を加えないようにする

        return view('todo.todo',compact('today','todayPosts','tomorrowPosts','thisWeekPosts','user'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    use AuthorizesRequests;
    public function store(TaskCreateRequest $request)
    {
        if($request->input('colors_id') === '1') {
            $color = "#ff6347";
        } elseif($request->input('colors_id') === '2') {
            $color = "#00ff7f";
        } elseif($request->input('colors_id') === '3') {
            $color = "#D3D3D3";
        }

        $this->authorize('create', Todo::class);
        $param = [
            'user_id' => auth()->id(),
            'message' => $request->input('message'),
            'due_date' => $request->input('due_date'),
            'colors_id' => $request->input('colors_id'),
            'color' => $color,
        ];
        Board::create($param);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Board::findOrFail($id);
        return view('todo.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id)
    {
        if($request->input('colors_id') === '1') {
            $color = "#ff6347";
        } elseif($request->input('colors_id') === '2') {
            $color = "#00ff7f";
        } elseif($request->input('colors_id') === '3') {
            $color = "#D3D3D3";
        }
        $post = Board::findOrFail($id);
        $post->update([
            'user_id' => auth()->id(),
            'message' => $request->input('message'),
            'due_date' => $request->input('due_date'),
            'colors_id' => $request->input('colors_id'),
            'color' => $color,
        ]);
        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $post = Board::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return redirect()->route('todo.index');
        }

        $post->delete();
        return redirect()->route('todo.index');
    }

    public function deleteMultiple(Request $request)
    {
        $itemIds = $request->input('items', []);
        if (empty($itemIds)) {
            return redirect()->back();
        }
        Board::whereIn('id', $itemIds)->delete();
        return redirect()->back();
    }

    public function upcomingTasks(Request $request)
    {
        $search = $request->session()->get('search', null);
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $query = Board::UserPosts($user);
        $sortBy = $request->input('sort_by','colorAsc');

        $search = $request->session()->get('search', null);
        if(isset($search)) {
            $query->where('message','like','%' . $search . '%');
        }

        if($sortBy === 'dateAsc'):
            $query->orderBy('due_date','asc');
        elseif($sortBy === 'dateDesc'):
            $query->orderBy('due_date','desc');
        elseif($sortBy === 'createdAsc'):
            $query->orderBy('created_at','asc');
        elseif($sortBy === 'createdDesc'):
            $query->orderBy('created_at','desc');
        elseif($sortBy === 'colorAsc'):
            $query->orderBy('colors_id','asc');
        elseif($sortBy === 'colorDesc'):
            $query->orderBy('colors_id','desc');
        endif;

        $posts = $query->where('due_date','>=',$today)->get();

        return view('todo.upcomingTasks',compact('posts','user','today'));
    }

    public function pastTasks(Request $request)
    {
        $search = $request->session()->get('search', null);
        $user = Auth::user();
        $today = Carbon::today()->toDateString();

        $query = Board::UserPosts($user);
        $sortBy = $request->input('sort_by','colorAsc');

        $search = $request->session()->get('search', null);
        if(isset($search)) {
            $query->where('message','like','%' . $search . '%');
        }
        
        if($sortBy === 'dateAsc'):
            $query->orderBy('due_date','asc');
        elseif($sortBy === 'dateDesc'):
            $query->orderBy('due_date','desc');
        elseif($sortBy === 'createdAsc'):
            $query->orderBy('created_at','asc');
        elseif($sortBy === 'createdDesc'):
            $query->orderBy('created_at','desc');
        elseif($sortBy === 'colorAsc'):
            $query->orderBy('colors_id','asc');
        elseif($sortBy === 'colorDesc'):
            $query->orderBy('colors_id','desc');
        endif;

        $posts = $query->where('due_date','<',$today)->get();

        return view('todo.pastTasks',compact('posts','user','today'));
    }

    public function search(Request $request)
    {
        $search = $request->input('text');
        return redirect()->back()->with(compact('search'));
    }
}

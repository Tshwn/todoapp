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
        $search = $request->input('search',null);
        $sort = $request->sort;

        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        if(isset($search))
        {
            $todayPosts = Board::UserPosts($user)->TodayPosts()->where('message','like','%' . $search . '%')->get();
            $tomorrowPosts = Board::UserPosts($user)->TomorrowPosts()->where('message','like','%' . $search . '%')->get();
            $thisWeekPosts = Board::UserPosts($user)->ThisWeekPosts()->where('message','like','%' . $search . '%')->get();
        }
        else
        {
            $todayPosts = Board::UserPosts($user)->TodayPosts()->get();
            $tomorrowPosts = Board::UserPosts($user)->TomorrowPosts()->get();
            $thisWeekPosts = Board::UserPosts($user)->ThisWeekPosts()->get();
        }

        $sortBy = $request->input('sort_by');
        if($sortBy === 'dateAsc'):
            $todayPosts = Board::UserPosts($user)->orderBy('due_date','asc')->TodayPosts()->get();
            $tomorrowPosts = Board::UserPosts($user)->orderBy('due_date','asc')->TomorrowPosts()->get();
            $thisWeekPosts = Board::UserPosts($user)->orderBy('due_date','asc')->ThisWeekPosts()->get();
        elseif($sortBy === 'dateDesc'):
            $todayPosts = Board::UserPosts($user)->orderBy('due_date','desc')->TodayPosts()->get();
            $tomorrowPosts = Board::UserPosts($user)->orderBy('due_date','desc')->TomorrowPosts()->get();
            $thisWeekPosts = Board::UserPosts($user)->orderBy('due_date','desc')->ThisWeekPosts()->get();
        elseif($sortBy === 'createdAsc'):
            $todayPosts = Board::UserPosts($user)->orderBy('created_at','asc')->TodayPosts()->get();
            $tomorrowPosts = Board::UserPosts($user)->orderBy('created_at','asc')->TomorrowPosts()->get();
            $thisWeekPosts = Board::UserPosts($user)->orderBy('created_at','asc')->ThisWeekPosts()->get();
        elseif($sortBy === 'createdDesc'):
            $todayPosts = Board::UserPosts($user)->orderBy('created_at','desc')->TodayPosts()->get();
            $tomorrowPosts = Board::UserPosts($user)->orderBy('created_at','desc')->TomorrowPosts()->get();
            $thisWeekPosts = Board::UserPosts($user)->orderBy('created_at','desc')->ThisWeekPosts()->get();
        elseif($sortBy === 'colorAsc'):
            $todayPosts = Board::UserPosts($user)->orderBy('colors_id','asc')->TodayPosts()->get();
            $tomorrowPosts = Board::UserPosts($user)->orderBy('colors_id','asc')->TomorrowPosts()->get();
            $thisWeekPosts = Board::UserPosts($user)->orderBy('colors_id','asc')->ThisWeekPosts()->get();
        elseif($sortBy === 'colorDesc'):
            $todayPosts = Board::UserPosts($user)->orderBy('colors_id','desc')->TodayPosts()->get();
            $tomorrowPosts = Board::UserPosts($user)->orderBy('colors_id','desc')->TomorrowPosts()->get();
            $thisWeekPosts = Board::UserPosts($user)->orderBy('colors_id','desc')->ThisWeekPosts()->get();
        endif;

        return view('todo.todo',['today' => $today,'todayPosts' => $todayPosts,'tomorrowPosts' => $tomorrowPosts,'thisWeekPosts' => $thisWeekPosts,'user' => $user,'sort' => $sort]);
    }

    public function calendar() {
        return view('todo.calendar');
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
        // $colors = [
        //     '1' => '#ff6347',
        //     '2' => '#00ff7f',
        //     '3' => '#D3D3D3',
        // ];
        $this->authorize('create', Todo::class);
        $param = [
            'user_id' => auth()->id(),
            'message' => $request->input('message'),
            'due_date' => $request->input('due_date'),
            'colors_id' => $request->input('colors_id'),
            'color' => $color,
            // 'color' => $colors[$request->input('colors_id')],
        ];
        Board::create($param);
        $user = Auth::user();
        $posts = Board::UserPosts($user)->get();
        return redirect()->route('todo.index');
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
        $form = Board::findOrFail($id);
        return view('todo.edit',['form' => $form]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $id)
    {
        $post = Board::findOrFail($id);
        $post->update([
            'message' => $request->message,
            'due_date' => $request->due_date,
            'color' => $request->color,
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
        $sort = $request->sort;

        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $posts = Board::UserPosts($user)->where('due_date','>=',$today)->get();

        return view('todo.upcomingTasks',['posts' => $posts,'user' => $user,'sort' => $sort,'today' => $today]);
    }

    public function pastTasks(Request $request)
    {
        $sort = $request->sort;

        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $posts = Board::UserPosts($user)->where('due_date','<',$today)->get();

        return view('todo.pastTasks',['posts' => $posts,'user' => $user,'sort' => $sort,'today' => $today]);
    }

    public function search(Request $request)
    {
        $search = $request->input('text');
        return redirect()->route('todo.index',['search' => $search]);
    }
}

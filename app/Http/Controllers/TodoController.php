<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BoardRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->sort;

        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $todayPosts = Board::UserPosts($user)->TodayPosts()->orderBy($sort,'asc')->get();
        $tomorrowPosts = Board::UserPosts($user)->TomorrowPosts()->get();
        $thisWeekPosts = Board::UserPosts($user)->ThisWeekPosts()->get();
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
    public function store(BoardRequest $request)
    {
        $this->authorize('create', Todo::class);
        $param = [
            'user_id' => auth()->id(),
            'message' => $request->input('message'),
            'due_date' => $request->input('due_date'),
            'color' => $request->input('color'),
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
    public function update(Request $request, string $id)
    {
        $post = Board::findOrFail($id);
        // if ($request->has('progress')) {
        //     $request->progress = $request->progress === '未達成' ? '完了':'未達成';
        //     $post->update([
        //         'progress' => $request->progress,
        //     ]);
        //     return redirect()->route('todo.index');
        // }
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
            return redirect()->back()->with('error', 'アイテムが選択されていません。');
        }
        Board::whereIn('id', $itemIds)->delete();     
        return redirect()->back()->with('success', '選択されたアイテムが削除されました。');
    }
}

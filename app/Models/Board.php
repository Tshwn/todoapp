<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Board extends Model
{
    protected $guarded = ['id'];
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeUserPosts($query,$user)
    {
        return $query->where('user_id',$user->id);
    }
    public function scopeTodayPosts($query) {
        $today = Carbon::today()->toDateString();
        return $query->where('due_date',$today);
    }
    public function scopeTomorrowPosts($query) {
        $tomorrow = Carbon::tomorrow()->toDateString();
        return $query->where('due_date',$tomorrow);
    }

    public function scopeThisWeekPosts($query) {
        $today = Carbon::today()->toDateString();
        // $startOfWeek = $today->startOfWeek();
        // $endOfWeek = $today->endOfWeek();
        $sevenDays = Carbon::today()->addDays(7)->toDateString();
        return $query->where('due_date','>=',$today)->where('due_date','<=',$sevenDays);
    }
}
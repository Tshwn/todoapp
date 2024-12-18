<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Board;
use App\Models\User;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if($user){
            Board::create([
            'user_id' => $user->id,
            'message' => '最初の投稿',
            'due_date' => '2024-12-17',
        ]);
        }
    }
}

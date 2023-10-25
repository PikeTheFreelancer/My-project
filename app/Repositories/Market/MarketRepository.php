<?php

namespace App\Repositories\Market;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class MarketRepository implements MarketRepositoryInterface{
    public function getAllMerchandises()
    {
        $merchandises = DB::table('merchandises')
                        ->join('users', 'merchandises.user_id', '=', 'users.id')
                        ->select('merchandises.*', 'users.avatar', 'users.name as username')->get();
        
        return $merchandises;
    }

    public function getAllComments($merchandiseId)
    {
        $comments = Comment::where('merchandise_id', $merchandiseId)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.avatar', 'users.name as username')                  
            ->get();
        
        return $comments;
    }
}
<?php

namespace App\Repositories\Market;

use App\Models\Comment;
use Carbon\Carbon;
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
                            ->orderBy('comments.id', 'desc')
                            ->get();

        //compare time comment with now
        foreach ($comments as $comment) {
            $comment->timeAgo = Carbon::parse($comment->created_at)->diffForHumans();
        }
        
        return $comments;
    }

    public function getSomeComments($merchandiseId, $amount)
    {
        $comments = Comment::where('merchandise_id', $merchandiseId)
                            ->join('users', 'comments.user_id', '=', 'users.id')
                            ->select('comments.*', 'users.avatar', 'users.name as username')
                            ->orderBy('id', 'desc')
                            ->limit($amount)
                            ->get();

        foreach ($comments as $comment) {
            $comment->timeAgo = Carbon::parse($comment->created_at)->diffForHumans();
        }
        return $comments;
    }

    public function getOnemerchandise($merchandiseId)
    {
        $merchandise = DB::table('merchandises')
        ->where('merchandises.id', $merchandiseId)
        ->join('users', 'merchandises.user_id', '=', 'users.id')
        ->select('merchandises.*', 'users.avatar', 'users.name as username')
        ->first();
        
        return $merchandise;
    }
}
<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    public function index()
    {
        $merchandises = DB::table('merchandises')
                        ->join('users', 'merchandises.user_id', '=', 'users.id')
                        ->select('merchandises.*', 'users.avatar', 'users.name as username')->get();
        foreach ($merchandises as $merchandise) {
            $comments = Comment::where('merchandise_id', $merchandise->id)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('comments.*', 'users.avatar', 'users.name as username')                  
            ->get();
            $merchandise->comments = $comments;
        }
        return view('market', ['merchandises' => $merchandises]);
    }

    public function comment(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $comment = new Comment;
        
        $comment->comment = $request->input('comment');
        $comment->merchandise_id = $request->input('merchandise_id');
        $comment->user_id = $user_id;

        $comment->save();

        //pass data to ajax
        $comment->user_avatar = asset($user->avatar);
        $comment->username = $user->name;

        return response()->json($comment);
    }
}

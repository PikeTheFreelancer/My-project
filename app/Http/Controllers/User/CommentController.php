<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Repositories\Merchandise\MerchandiseRepositoryInterface;

class CommentController extends Controller
{
    protected $merchandiseRepo;

    public function __construct(
        MerchandiseRepositoryInterface $merchandiseRepo
    )
    {
        $this->merchandiseRepo = $merchandiseRepo;
    }

    public function comment(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $comment = new Comment();
        
        $comment->comment = $request->input('comment');
        $comment->merchandise_id = $request->input('merchandise_id');
        $comment->user_id = $user_id;

        $comment->save();

        //pass data to ajax
        $seller_id = $this->merchandiseRepo->find($request->input('merchandise_id'))->user->id;
        $comment->user_avatar = asset($user->avatar);
        $comment->username = $user->name;

        return view('user.components.comment', compact('comment', 'seller_id'));
    }

    public function edit(Request $request, $id)
    {
        $comment = Comment::find($id);

        $comment->comment = $request->input('comment');
        $comment->save();

        return response()->json($comment->comment);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $comment = Comment::find($id);

        $comment->delete();

        return response()->json('comment deleted');
    }
}

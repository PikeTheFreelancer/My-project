<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Repositories\Merchandise\MerchandiseRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class CommentController extends Controller
{
    protected $merchandiseRepo, $postRepo;

    public function __construct(
        MerchandiseRepositoryInterface $merchandiseRepo,
        PostRepositoryInterface $postRepo
    )
    {
        $this->merchandiseRepo = $merchandiseRepo;
        $this->postRepo = $postRepo;
    }

    public function comment(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $comment = new Comment();
        
        $comment->comment = $request->input('comment');
        if ($request->input('merchandise_id')) {
            $comment->merchandise_id = $request->input('merchandise_id');
        } else {
            $comment->post_id = $request->input('post_id');
        }
        
        $comment->user_id = $user_id;

        $comment->save();

        //pass data to ajax
        $comment->user_avatar = $user->avatar;
        $comment->username = $user->name;
        if ($request->input('merchandise_id')){
            $seller_id = $this->merchandiseRepo->find($request->input('merchandise_id'))->user->id;
            return view('user.components.comment', compact('comment', 'seller_id'));
        }else{
            $author_id = $this->postRepo->find($request->input('post_id'))->user->id;
            return view('user.components.comment', compact('comment', 'author_id'));
        }

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

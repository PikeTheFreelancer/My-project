<?php

namespace App\Repositories\Post;

use App\Models\Comment;
use App\Models\Post;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository implements PostRepositoryInterface{
    public function getModel()
    {
        return Post::class;
    }

    public function getAllPosts()
    {
        $posts = DB::table('posts')
                        ->join('users', 'posts.user_id', '=', 'users.id')
                        ->select('posts.*', 'users.avatar', 'users.name as username')->get();
        
        return $posts;
    }

    public function getAllComments($postId)
    {
        $comments = Comment::where('post_id', $postId)
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

    public function getSomeComments($postId, $amount)
    {
        $comments = Comment::where('postId', $postId)
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

    public function getOnePost($postId)
    {
        $post = DB::table('posts')
        ->where('posts.id', $postId)
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->select('posts.*', 'users.avatar', 'users.name as username')
        ->first();
        
        return $post;
    }
}
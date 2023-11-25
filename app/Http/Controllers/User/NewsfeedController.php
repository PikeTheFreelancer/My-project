<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsfeedController extends Controller
{

    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $posts = $this->postRepo->getAllPosts();
        foreach ($posts as $post) {
            $comments = $this->postRepo->getAllComments($post->id)->take(3)->reverse();
            $post->comments = $comments;
            $post->max_size = $this->postRepo->getAllComments($post->id)->count();
            $post->timeAgo = Carbon::parse($post->created_at)->diffForHumans();
        }
        return view('newsfeed', compact('posts'));
    }

    function post($id) {
        $post = $this->postRepo->getOnePost($id);
        $comments = $this->postRepo->getAllComments($post->id)->take(3)->reverse();
        $post->max_size = $this->postRepo->getAllComments($post->id)->count();
        $post->comments = $comments;
        return view('post', ['post' => $post]);
    }
}

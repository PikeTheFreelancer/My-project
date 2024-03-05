<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostCategory\PostCategoryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $postRepo, $cateRepo;

    public function __construct(
        PostRepositoryInterface $postRepo,
        PostCategoryRepositoryInterface $cateRepo
    )
    {
        $this->postRepo = $postRepo;
        $this->cateRepo = $cateRepo;
    }

    public function index()
    {
        $user = Auth::guard('web')->user();
        $posts = $this->postRepo->getAllPosts()->take(6);
        // dd($posts);
        foreach ($posts as $post) {
            $comments = $this->postRepo->getAllComments($post->id)->take(3)->reverse();
            $post->comments = $comments;
            $post->max_size = $this->postRepo->getAllComments($post->id)->count();
            $post->timeAgo = Carbon::parse($post->created_at)->diffForHumans();
        }
        return view('home')->with('user', $user)->with('posts', $posts);
    }

    public function changeLanguage($lang){
        $language = config('app.locale');
        if ($lang == 'en') {
            $language = 'en';
        }elseif ($lang == 'vi') {
            $language = 'vi';
        }
        Session::put('language', $language);
        return redirect()->back();
    }
}
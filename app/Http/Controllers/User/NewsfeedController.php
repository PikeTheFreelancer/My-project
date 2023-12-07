<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostCategory\PostCategoryRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsfeedController extends Controller
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
        $posts = $this->postRepo->getAllPosts();
        $categories = $this->cateRepo->getAll();
        // dd($posts);
        foreach ($posts as $post) {
            $comments = $this->postRepo->getAllComments($post->id)->take(3)->reverse();
            $post->comments = $comments;
            $post->max_size = $this->postRepo->getAllComments($post->id)->count();
            $post->timeAgo = Carbon::parse($post->created_at)->diffForHumans();
        }
        return view('newsfeed')->with('posts', $posts)->with('categories',$categories);
    }

    public function post($id) {
        $post = $this->postRepo->getOnePost($id);
        $comments = $this->postRepo->getAllComments($post->id)->take(3)->reverse();
        $post->max_size = $this->postRepo->getAllComments($post->id)->count();
        $post->comments = $comments;
        return view('post', ['post' => $post]);
    }
    
    public function categoryFilter(){
        $category_name = request('category');
        $category = $this->cateRepo->getByName($category_name);
        $posts = $this->postRepo->getPostsByCategory($category->id);
        $categories = $this->cateRepo->getAll();

        foreach ($posts as $post) {
            $comments = $this->postRepo->getAllComments($post->id)->take(3)->reverse();
            $post->comments = $comments;
            $post->max_size = $this->postRepo->getAllComments($post->id)->count();
            $post->timeAgo = Carbon::parse($post->created_at)->diffForHumans();
        }
        return view('newsfeed', compact('posts'))->with('categories',$categories)->with('category_name',$category_name);
    }

    public function searchPosts(Request $request){

        $text = $request->text;
        $posts = $this->postRepo->searchPosts($text);
        $categories = $this->cateRepo->getAll();

        foreach ($posts as $post) {
            $comments = $this->postRepo->getAllComments($post->id)->take(3)->reverse();
            $post->comments = $comments;
            $post->max_size = $this->postRepo->getAllComments($post->id)->count();
            $post->timeAgo = Carbon::parse($post->created_at)->diffForHumans();
        }
        return view('newsfeed', compact('posts'))->with('categories',$categories)->with('text', $text);
    }
}

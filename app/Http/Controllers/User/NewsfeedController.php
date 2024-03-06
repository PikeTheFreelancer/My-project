<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ReportReason;
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
        $categories = $this->cateRepo->getAll();
        
        $posts = $this->postRepo->getPaginatedPosts();
        foreach ($posts as $post) {
            $comments = $this->postRepo->getAllComments($post->id)->take(3)->reverse();
            $post->comments = $comments;
            $post->max_size = $this->postRepo->getAllComments($post->id)->count();
            $post->timeAgo = Carbon::parse($post->created_at)->diffForHumans();
        }

        $pinned_posts = $this->postRepo->getAllPosts()->where('is_pinned', 1)->all();
        foreach ($pinned_posts as $pinned_post) {
            $comments = $this->postRepo->getAllComments($pinned_post->id)->take(3)->reverse();
            $pinned_post->comments = $comments;
            $pinned_post->max_size = $this->postRepo->getAllComments($pinned_post->id)->count();
            $pinned_post->timeAgo = Carbon::parse($pinned_post->created_at)->diffForHumans();
        }

        $reasons = ReportReason::all();
        return view('newsfeed')->with('posts', $posts)->with('categories',$categories)->with('pinned_posts', $pinned_posts)->with('reasons', $reasons);
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

    public function goToPage(Request $request){
        $pageNumber = $request->input('page_number');
        return redirect()->route('newsfeed', ['page' => $pageNumber]);
    }
}

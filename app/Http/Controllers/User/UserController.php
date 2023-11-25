<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use App\Repositories\PostCategory\PostCategoryRepositoryInterface;

class UserController extends Controller
{
    protected $cateRepo;

    public function __construct(PostCategoryRepositoryInterface $cateRepo)
    {
        $this->cateRepo = $cateRepo;
    }
    public function index()
    {
        $categories = $this->cateRepo->getAll();
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->get();
        $data = [
            'categories' => $categories,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'avatar' => $user->avatar,
            'pro_username' => $user->pro_username,
            'pro_server' => $user->pro_server,
            'posts' => $posts
        ];
        return view('user.my-account', $data);
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        
        //delete old image and load new one to model
        if ($request->avatar) {
            $imageName = $request->avatar->getClientOriginalName();
            $parsedUrl = parse_url($user->avatar);
            $path = public_path($parsedUrl['path']);
            if (File::exists($path)) {
                File::delete($path);
            }
            $user->avatar = asset($this->storeBase64($request->image_base64, $imageName));
        }

        //load infomations to model then save
        $user->name = $request->name;
        $user->email = $request->email;
        $user->pro_username = $request->pro_username;
        $user->pro_server = $request->pro_server;
        $user->save();

        return back()->with('success', 'Image uploaded successfully.');
    }

    private function storeBase64($imageBase64, $imageName)
    {
        list($type, $imageBase64) = explode(';', $imageBase64);
        list(, $imageBase64)      = explode(',', $imageBase64);
        $imageBase64 = base64_decode($imageBase64);
        $imageName= time().'_'.$imageName;
        $directory = public_path('images/avatars');

        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true, true);
        }
        
        $path = public_path() . "/images/avatars/" . $imageName;

        file_put_contents($path, $imageBase64);

        $imageSource = 'images/avatars/' . $imageName;
        return $imageSource;
    }

    public function savePost(Request $request)
    {
        $user_id = Auth::user()->id;

        if (isset($request->post_id)) {
            $post = Post::find($request->post_id);
        } else {
            $post = new Post;
        }
        $post->post_category_id = $request->post_category_id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->content = str_replace('src="images/tinymce/', 'src="/images/tinymce/', $post->content);
        $post->user_id = $user_id;

        $post->save();
        return redirect()->back();
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back();
    }
}

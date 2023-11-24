<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Repositories\PostCategory\PostCategoryRepositoryInterface;
use Illuminate\Http\Request;

class PostCategoriesController extends Controller
{
    protected $cateRepo;

    public function __construct(PostCategoryRepositoryInterface $cateRepo)
    {
        $this->cateRepo = $cateRepo;
    }

    public function index() {
        $categories = $this->cateRepo->getAll();
        return view('admin.categories', compact('categories', $categories));
    }

    public function save(Request $request){
        $name = $request->input('categ_name');
        dd($name);
        $category = new PostCategory;
        $category->name = $name;
        $category->save();
        dd($category);
        // return view('admin.components.category', compact('category', $category));
    }
}

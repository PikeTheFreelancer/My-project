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
        $id = $request->input('id');
        if ($id) {
            $category = $this->cateRepo->find($id);
            $category->name = $name;
            $category->save();
            return response()->json($category->name);
        }else{
            $category = new PostCategory;
            $category->name = $name;
            $category->save();
            return view('admin.components.category', compact('category', $category));
        }
    }
    public function delete($id){
        $category = $this->cateRepo->find($id);
        $category->delete();
        return response()->json('deleted');
    }
    public function edit($id){
        $category = $this->cateRepo->find($id);
        return view('admin.components.category-edit-form', compact('category', $category));
    }
}

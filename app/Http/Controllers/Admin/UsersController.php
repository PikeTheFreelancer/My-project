<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index() {
        $users = $this->userRepo->getAll();
        return view('admin.users')->with('users', $users);
    }

    public function banUser($id){
        $user = $this->userRepo->find($id);
        if ($user->status == 0) {
            $user->status = 1;
        }else{
            $user->status = 0;
        }
        $user->save();
        return response()->json($user->status);
    }

    public function deleteUser($id){
        $user = $this->userRepo->find($id);
        $user->delete();
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // clear phiên đăng nhập trên trình duyệt
        $request->session()->invalidate();

        return redirect('/admin/login');
    }
}
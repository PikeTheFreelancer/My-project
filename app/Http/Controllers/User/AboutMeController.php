<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AboutMeController extends Controller
{
    function index() {
        return view('about-me');
    }
    function aboutUs() {
        $admin = User::where('email', 'piketheadmin@vermilioncenter.com')->first();
        return view('about-us')->with('admin', $admin);
    }
}

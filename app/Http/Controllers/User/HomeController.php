<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();

        return view('home')->with('user', $user);
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
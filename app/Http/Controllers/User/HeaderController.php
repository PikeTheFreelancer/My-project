<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HeaderController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $notifications = DB::table('notifications')->where('data->noti_to', $user_id)->orderBy('created_at', 'desc')->limit(10)->get();
        }else{
            $notifications = [];
        }
        return view('layouts.app', ['notifications' => $notifications]);
    }
}

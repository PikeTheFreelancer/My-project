<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutMeController extends Controller
{
    function index() {
        return view('about-me');
    }
}

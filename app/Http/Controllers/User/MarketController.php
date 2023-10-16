<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $merchandises = Merchandise::all();

        return view('market', ['merchandises' => $merchandises]);
    }
}

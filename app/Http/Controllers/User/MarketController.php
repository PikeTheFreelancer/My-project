<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    public function index()
    {
        $merchandises = DB::table('merchandises')
                        ->join('users', 'merchandises.user_id', '=', 'users.id')
                        ->select('merchandises.*', 'users.avatar', 'users.name as username')->get();

        return view('market', ['merchandises' => $merchandises]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Models\LineUp;
use Illuminate\Http\Request;

class BossController extends Controller
{
    public function index($id){
        $boss = Boss::find($id);
        $boss->line_ups = $boss->lineUp()->get();
        
        return view('bosses.boss')->with('boss', $boss);
    }

    public function getBossesByRegion($region){
        $bosses = Boss::where('region', $region)->get();
        
        return view('bosses.region')->with('bosses', $bosses);
    }
}

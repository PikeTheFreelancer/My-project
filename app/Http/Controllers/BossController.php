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
        // dd($boss->line_ups);
        return view('bosses.boss')->with('boss', $boss);
    }

    public function getBossesByRegion($region){
        $bosses = Boss::where('region', $region)->get();
        
        return view('bosses.region')->with('bosses', $bosses)->with('region', $region);
    }

    public function allBosses(){
        $bosses = Boss::all();

        return view('bosses.all')->with('bosses', $bosses);
    }
}

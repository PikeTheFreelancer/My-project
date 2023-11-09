<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetPokemonController extends Controller
{
    function index($name) {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");
    
        if ($response->successful()) {
            $data = $response->json();
            // dd($data);
            return view('pokemon', compact('data'));
        } else {
            return response()->json(['error' => 'Pokemon not found'], 404);
        }
    }
}

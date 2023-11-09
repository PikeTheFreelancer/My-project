<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class GetPokemonController extends Controller
{
    public function index($name) {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$name}");
    
        if ($response->successful()) {
            $data = $response->json();
            // dd($data);
        } else {
            $data = [];
        }
        return view('pokemon', compact('data'));
    }

    public function getPokemonsByString(Request $request)
    {
        $searchString = $request->input('searchString');

        $response = Http::get("https://pokeapi.co/api/v2/pokemon/?offset=0&limit=1000");

        if ($response->successful()) {

            $data = $response->json();
            $pokemons = [];
            $count = 0;
            foreach ($data['results'] as $result) {
                if (stripos($result['name'], $searchString) !== false) {
                    $pokemons[] = $result;
                    $count++;
                }

                //get 5 results maximum
                if ($count >= 5) {
                    break;
                }
            }
            return view('user.components.search-pokemon-item', compact('pokemons'));
        } else {
            return response()->json(['error' => 'No pokemon matches.'], 500);
        }
    }

    public function searchPokemon(Request $request) {
        return redirect()->route('get-pokemon', $request->searchString);
    }
}

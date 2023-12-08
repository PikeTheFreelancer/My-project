<?php

namespace App\Http\Controllers;

use App\Repositories\PokemonApi\PokemonApiRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class GetPokemonController extends Controller
{
    private $pokemonApiRepo;

    public function __construct(PokemonApiRepositoryInterface $pokemonApiRepo)
    {
        $this->pokemonApiRepo = $pokemonApiRepo;
    }

    public function index($name) {
        
        $response = $this->pokemonApiRepo->getPokemonByName($name);
        if ($response['pokemon']) {
            $data = $response['pokemon'][0];
            $move_pool = [];
            for ($i=1; $i <= 9 ; $i++) { 
                $move_pool['gen_'.$i]['lv'] = collect($data['moves'])->where('version.generation', $i)->where('method.name','level-up')->unique()->sortBy('level')->all();
                $move_pool['gen_'.$i]['tm'] = collect($data['moves'])->where('version.generation', $i)->where('method.name','machine')->unique()->all();
                $move_pool['gen_'.$i]['egg'] = collect($data['moves'])->where('version.generation', $i)->where('method.name','egg')->unique()->all();
            }
            $data['moves'] = $move_pool;
        } else {
            $data = [];
        }
        
        // dd($data['moves']['gen_6']['egg']);
        return view('pokemon', compact('data'));
    }

    public function getPokemonsByString(Request $request)
    {
        $searchString = $request->input('searchString');

        $response = Http::get("https://pokeapi.co/api/v2/pokemon/?offset=0&limit=10100");

        if ($response->successful()) {

            $data = $response->json();
            $pokemons = [];
            $count = 0;
            foreach ($data['results'] as $result) {
                if (stripos($result['name'], $searchString) !== false) {
                    $pokemons[] = $result;
                    $count++;
                }

                //get 10 results maximum
                if ($count >= 10) {
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

    public function getPokemonMoves(Request $request){
        $name = $request->input('name');
        $gen = $request->input('gen');
        $data = $this->pokemonApiRepo->getMovesByGen($name, $gen);
        $result = $data['pokemon'][0]['moves'];

        $move_pool = [];
        $move_pool['lv'] = collect($result)->where('method.name','level-up')->unique()->sortBy('level')->all();
        $move_pool['tm'] = collect($result)->where('method.name','machine')->unique()->all();
        $move_pool['egg'] = collect($result)->where('method.name','egg')->unique()->all();

        return view('user.components.moves', compact('move_pool'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\PokemonApi\PokemonApiRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
        $evolution_chain_id = $data['specy']['evolution_chain_id'];
        $evolution_chain = $this->pokemonApiRepo->getEvolutionChainById($evolution_chain_id);
        
        // dd($evolution_chain['evolutionchain'][0]['species']);
        return view('pokemon', compact('data'))->with('evolution_chain', $evolution_chain['evolutionchain'][0]);
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

    public function getAllPokemons(){
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/?offset=0&limit=1300");
        if ($response->successful()) {
            $data = $response->json(); // Chuyển đổi JSON thành mảng PHP
            $collection = collect($data['results']); // Tạo collection từ mảng
        
            $perPage = 100;
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
            $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
            $paginator = new LengthAwarePaginator($currentPageItems, $collection->count(), $perPage, $currentPage);
        
            $paginator->withPath('/pokemon'); // Đặt đường dẫn cho phân trang
            
            $items = $paginator->items();
            return view('pokedex')->with('paginator', $paginator)->with('items', $items);
        }
    }
}

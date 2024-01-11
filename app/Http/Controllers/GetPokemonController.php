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

    private function convertToSentence($evol_details) {
        $sentence = __('Evolution method').": ";
        $parts = [];
    
        if (isset($evol_details['pokemon_v2_evolutiontrigger']['name'])) {
            $parts[] = __(str_replace('-', ' ', ucfirst($evol_details['pokemon_v2_evolutiontrigger']['name'])));
        }
    
        if ($evol_details['min_level'] !== null) {
            $parts[] = __('at level ') . $evol_details['min_level'];
        }
    
        if ($evol_details['min_happiness'] !== null) {
            $parts[] = __('at happiness ') . $evol_details['min_happiness'];
        }

        if ($evol_details['pokemon_v2_item'] !== null) {
            $parts[] = str_replace('-', ' ', $evol_details['pokemon_v2_item']['name']);
        }
        if ($evol_details['needs_overworld_rain']) {
            $parts[] = __('during rain');
        }
        if ($evol_details['time_of_day'] !== '') {
            $parts[] = 'at ' . str_replace('-', ' ', $evol_details['time_of_day']);
        }
        if ($evol_details['held_item_id'] !== null) {
            $held_item = $this->pokemonApiRepo->getItemById($evol_details['held_item_id']);
            $parts[] = 'holding ' . str_replace('-', ' ', $held_item['pokemon_v2_item'][0]['name']);
        }
    
        $sentence .= implode(" ", $parts);
        $sentence .= ".";
    
        return $sentence;
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
        // $evolution_chain_id = $data['specy']['evolution_chain_id'];
        // $evolution_chain = $this->pokemonApiRepo->getEvolutionChainById($evolution_chain_id);
        $evolves_from = $data['specy']['evolves_from_species_id'] ? $this->pokemonApiRepo->getPokemonById($data['specy']['evolves_from_species_id'])['pokemon_v2_pokemon'][0] : null;
        $evol_details = $data['specy']['evolves_from_species_id'] ? $data['specy']['evolutions']['nodes'][0] : null;

        $evol_details_sentence = $evol_details ? $this->convertToSentence($evol_details) : null;

        return view('pokemon', compact('data'))->with('evolves_from', $evolves_from)->with('evol_details_sentence', $evol_details_sentence);
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

    public function getMoveByName($name){
        $move = $this->pokemonApiRepo->getMoveByName($name)['pokemon_v2_move'][0];
        // dd($move['pokemon_v2_moveeffect']['pokemon_v2_moveeffecteffecttexts'][0]['effect']);
        return view('move')->with('move', $move);
    }
}

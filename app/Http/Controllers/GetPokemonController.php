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
        $data = $response['pokemon'][0];
        $move_pool = [];
        for ($i=1; $i <= 9 ; $i++) { 
            $move_pool['gen_'.$i]['lv'] = collect($data['moves'])->where('version.generation', $i)->where('method.name','level-up')->unique()->sortBy('level')->all();
            $move_pool['gen_'.$i]['tm'] = collect($data['moves'])->where('version.generation', $i)->where('method.name','machine')->unique()->all();
            $move_pool['gen_'.$i]['egg'] = collect($data['moves'])->where('version.generation', $i)->where('method.name','egg')->unique()->all();
        }
        $data['moves'] = $move_pool;
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

                //get 5 results maximum
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

    public function runApi(){
        // URL của GraphQL API
        $graphqlEndpoint = 'https://beta.pokeapi.co/graphql/v1beta';

        $graphqlQuery = <<<'EOT'
            query GetPokemonInfo($pokemonId: Int!) {
                pokemon:pokemon_v2_pokemon(where: { id: { _eq: $pokemonId } }) {
                    id
                    name
                    height
                    weight
                    specy:pokemon_v2_pokemonspecy{
                    id
                    evolution_chain:pokemon_v2_evolutionchain{
                        pokemonspecies:pokemon_v2_pokemonspecies {
                        id
                        name
                        }
                    }
                    }
                    moves:pokemon_v2_pokemonmoves{
                    version:pokemon_v2_versiongroup{
                        generation:generation_id
                    }
                    level
                    pokemon_v2_movelearnmethod{
                        name
                    }
                    move:pokemon_v2_move{
                        name
                        type:pokemon_v2_type{
                        name
                        }
                        power
                        accuracy
                        damage_class:pokemon_v2_movedamageclass{
                        name
                        }
                    }
                    }
                    types: pokemon_v2_pokemontypes {
                    type: pokemon_v2_type {
                        name
                    }
                    }
                    abilities: pokemon_v2_pokemonabilities {
                    is_hidden
                    ability: pokemon_v2_ability {
                        name
                    }
                    }
                    sprites: pokemon_v2_pokemonsprites {
                    sprites
                    }
                    base_stats: pokemon_v2_pokemonstats {
                    base_stat
                    }
                }
            }
        EOT;

        $client = new Client();
        $response = $client->post($graphqlEndpoint, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'query' => $graphqlQuery,
                'variables' => [
                    'pokemonId' => 1, // Thay đổi giá trị này tùy thuộc vào Pokémon bạn muốn lấy thông tin
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        dd(collect($data)->first());
        return response()->json($data);
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

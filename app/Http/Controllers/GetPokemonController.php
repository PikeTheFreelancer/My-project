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
        } else {
            $data = [];
        }
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
        $response = Http::get("https://pokeapi.co/api/v2/move?offset=0&limit=921");

        if ($response->successful()) {
            $movesData = $response->json();
            $data = [];
            foreach ($movesData['results'] as $result) {
                $move = Http::get("https://pokeapi.co/api/v2/move/".$result['name']);
                $data[] = $move;
            }
            $json_data = json_encode($data, JSON_PRETTY_PRINT);
            $file_path = public_path("json/all_moves.json");
            file_put_contents($file_path, $json_data);

            return response()->json(['success' => true, 'file_path' => $file_path]);
        } else {
            return response()->json(['error' => "Error: {$response->status()}"], 500);
        }
    }
    public function getAllMovesData()
    {
        $file_path = public_path("json/all_moves.json");

        // Kiểm tra xem file tồn tại hay không
        if (file_exists($file_path)) {
            // Đọc nội dung từ file JSON và chuyển đổi thành mảng PHP
            $movesData = json_decode(file_get_contents($file_path), true);
            dd($movesData);

            return response()->json(['success' => true, 'movesData' => $movesData]);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }
}

<?php

namespace App\Repositories\PokemonApi;

interface PokemonApiRepositoryInterface {
    public function getPokemonByName($name);
    public function getPokemonById($id);
    public function getMovesByGen($name, $gen);
    public function getEvolutionChainById($id);
    public function getItemById($id);
    public function getMoveByName($name);
}
<?php

namespace App\Repositories\PokemonApi;

interface PokemonApiRepositoryInterface {
    public function getPokemonByName($name);
    public function getMovesByGen($name, $gen);
}
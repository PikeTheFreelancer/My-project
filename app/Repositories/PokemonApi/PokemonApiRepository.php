<?php

namespace App\Repositories\PokemonApi;
use GuzzleHttp\Client;

class PokemonApiRepository implements PokemonApiRepositoryInterface{
    public function getPokemonByName($name)
    {
        // URL của GraphQL API
        $graphqlEndpoint = 'https://beta.pokeapi.co/graphql/v1beta';

        $graphqlQuery = <<<'EOT'
            query GetPokemonInfo($name: String!) {
                pokemon:pokemon_v2_pokemon(where: { name: { _eq: $name } }) {
                    id
                    name
                    height
                    weight
                    specy:pokemon_v2_pokemonspecy{
                        evolution_chain_id
                        id
                    }
                    moves:pokemon_v2_pokemonmoves (where: {
                        pokemon_v2_versiongroup: {
                            generation_id: {_eq: 6}
                        }
                    }){
                        version:pokemon_v2_versiongroup{
                            generation:generation_id
                        }
                        level
                        method:pokemon_v2_movelearnmethod{
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
                        name:pokemon_v2_stat{
                            name
                        }
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
                    'name' => $name,
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return collect($data)->first();   
    }

    public function getMovesByGen($name, $gen){
        $graphqlEndpoint = 'https://beta.pokeapi.co/graphql/v1beta';
        $graphqlQuery = <<<'EOT'
        query GetPokemonInfo($name: String!, $gen: Int!) {
            pokemon:pokemon_v2_pokemon(where: { name: { _eq: $name } }) {
                moves:pokemon_v2_pokemonmoves (where: {
                    pokemon_v2_versiongroup: {
                        generation_id: {_eq: $gen}
                    }
                }){
                    version:pokemon_v2_versiongroup{
                        generation:generation_id
                    }
                    level
                    method:pokemon_v2_movelearnmethod{
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
                    'name' => $name,
                    'gen' => $gen
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return collect($data)->first();   
    }

    public function getEvolutionChainById($id){
        $graphqlEndpoint = 'https://beta.pokeapi.co/graphql/v1beta';
        $graphqlQuery = <<<'EOT'
        query GetEvolutionChain($id: Int!){
            evolutionchain:pokemon_v2_evolutionchain(where: {id: {_eq: $id} }){
            id
            species:pokemon_v2_pokemonspecies{
              name
              id
              order
              specy:pokemon_v2_pokemonspecy{
                name
              }
              evolutions:pokemon_v2_pokemonevolutions{
                trigger:pokemon_v2_evolutiontrigger{
                  name
                }
                min_level
                min_happiness
                pokemon_v2_item{
                  name
                }
              }
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
                    'id' => $id,
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return collect($data)->first();   
    }
}
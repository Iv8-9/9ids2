<?php

namespace App\Http\Controllers;

use App\Services\PokemonService;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    protected $pokemonService;

    public function __construct(PokemonService $pokemonService)
    {
        $this->pokemonService = $pokemonService;
    }

    public function show($identifier)
    {
        $pokemon = $this->pokemonService->getPokemon($identifier);
        
        if (!$pokemon) {
            return response()->json(['error' => 'Pokémon no encontrado'], 404);
        }

        $filteredData = [
            'nombre' => $pokemon['name'],
            'tipos' => array_map(function($type) {
                return $type['type']['name'];
            }, $pokemon['types']),
            'habilidades' => array_map(function($ability) {
                return $ability['ability']['name'];
            }, $pokemon['abilities']),
            'imagen' => $pokemon['sprites']['front_default']
        ];
        
        return response()->json($filteredData);
    }
}

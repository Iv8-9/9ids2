<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokemonService
{
    protected $client;
    protected $baseUri = 'https://pokeapi.co/api/v2/';

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'timeout'  => 2.0,
        ]);
    }

    /**
     * Obtiene información de un Pokémon por su nombre o ID
     */
    public function getPokemon($identifier)
    {
        try {
            $response = $this->client->request('GET', "pokemon/{$identifier}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return null;
        }
    }
}


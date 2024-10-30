<?php
namespace App\Services;

use Goutte\Client;
use Illuminate\Support\Facades\DB;

class ScrapingService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function scrapePokemonTable()
    {
        $crawler = $this->client->request('GET', 'https://pokemondb.net/pokedex/all');

        $crawler->filter('table#pokedex tbody tr')->each(function ($node) {
            $types = explode(' ', $node->filter('td')->eq(2)->text());
            $type1 = $types[0];
            $type2 = isset($types[1]) ? $types[1] : null;

            $weaknessesResistancesImmunities = $this->calculateWeaknessesResistancesImmunities($type1, $type2);

            $pokemon = [
                'number' => $node->filter('td')->eq(0)->text(),
                'name' => $node->filter('td')->eq(1)->text(),
                'type1' => $type1,
                'type2' => $type2,
                'total' => $node->filter('td')->eq(3)->text(),
                'hp' => $node->filter('td')->eq(4)->text(),
                'attack' => $node->filter('td')->eq(5)->text(),
                'defense' => $node->filter('td')->eq(6)->text(),
                'sp_atk' => $node->filter('td')->eq(7)->text(),
                'sp_def' => $node->filter('td')->eq(8)->text(),
                'speed' => $node->filter('td')->eq(9)->text(),
                'weaknesses' => json_encode(array_values($weaknessesResistancesImmunities['weaknesses'])),
                'resistances' => json_encode(array_values($weaknessesResistancesImmunities['resistances'])),
                'immunities' => json_encode(array_values($weaknessesResistancesImmunities['immunities'])),
            ];

            DB::table('pokemon')->insert($pokemon);
        });
    }

    private function calculateWeaknessesResistancesImmunities($type1, $type2 = null)
    {
        $typeChart = [
            'Normal' => ['weaknesses' => ['Fighting'], 'resistances' => [], 'immunities' => ['Ghost']],
            'Fire' => ['weaknesses' => ['Water', 'Ground', 'Rock'], 'resistances' => ['Fire', 'Grass', 'Ice', 'Bug', 'Steel', 'Fairy'], 'immunities' => []],
            'Water' => ['weaknesses' => ['Electric', 'Grass'], 'resistances' => ['Fire', 'Water', 'Ice', 'Steel'], 'immunities' => []],
            'Electric' => ['weaknesses' => ['Ground'], 'resistances' => ['Electric', 'Flying', 'Steel'], 'immunities' => []],
            'Grass' => ['weaknesses' => ['Fire', 'Ice', 'Poison', 'Flying', 'Bug'], 'resistances' => ['Water', 'Electric', 'Grass', 'Ground'], 'immunities' => []],
            'Ice' => ['weaknesses' => ['Fire', 'Fighting', 'Rock', 'Steel'], 'resistances' => ['Ice'], 'immunities' => []],
            'Fighting' => ['weaknesses' => ['Flying', 'Psychic', 'Fairy'], 'resistances' => ['Bug', 'Rock', 'Dark'], 'immunities' => []],
            'Poison' => ['weaknesses' => ['Ground', 'Psychic'], 'resistances' => ['Grass', 'Fighting', 'Poison', 'Bug', 'Fairy'], 'immunities' => []],
            'Ground' => ['weaknesses' => ['Water', 'Ice', 'Grass'], 'resistances' => ['Poison', 'Rock'], 'immunities' => ['Electric']],
            'Flying' => ['weaknesses' => ['Electric', 'Ice', 'Rock'], 'resistances' => ['Grass', 'Fighting', 'Bug'], 'immunities' => ['Ground']],
            'Psychic' => ['weaknesses' => ['Bug', 'Ghost', 'Dark'], 'resistances' => ['Fighting', 'Psychic'], 'immunities' => []],
            'Bug' => ['weaknesses' => ['Fire', 'Flying', 'Rock'], 'resistances' => ['Grass', 'Fighting', 'Ground'], 'immunities' => []],
            'Rock' => ['weaknesses' => ['Water', 'Grass', 'Fighting', 'Ground', 'Steel'], 'resistances' => ['Normal', 'Fire', 'Poison', 'Flying'], 'immunities' => []],
            'Ghost' => ['weaknesses' => ['Ghost', 'Dark'], 'resistances' => ['Poison', 'Bug'], 'immunities' => ['Normal', 'Fighting']],
            'Dragon' => ['weaknesses' => ['Ice', 'Dragon', 'Fairy'], 'resistances' => ['Fire', 'Water', 'Electric', 'Grass'], 'immunities' => []],
            'Dark' => ['weaknesses' => ['Fighting', 'Bug', 'Fairy'], 'resistances' => ['Ghost', 'Dark'], 'immunities' => ['Psychic']],
            'Steel' => ['weaknesses' => ['Fire', 'Fighting', 'Ground'], 'resistances' => ['Normal', 'Grass', 'Ice', 'Flying', 'Psychic', 'Bug', 'Rock', 'Dragon', 'Steel', 'Fairy'], 'immunities' => ['Poison']],
            'Fairy' => ['weaknesses' => ['Poison', 'Steel'], 'resistances' => ['Fighting', 'Bug', 'Dark'], 'immunities' => ['Dragon']],
        ];

        $weaknesses = [];
        $resistances = [];
        $immunities = [];

        foreach ([$type1, $type2] as $type) {
            
            $weaknesses = $typeChart[$type1]['weaknesses'];
            if($type2 != null){
                $weaknesses2 = $typeChart[$type2]['weaknesses'];
                $weaknesses = array_merge($weaknesses, $weaknesses2);
            }
            
            $resistances = $typeChart[$type1]['resistances'];
            if($type2 != null){
                $resistances2 = $typeChart[$type2]['resistances'];
                $resistances = array_merge($resistances, $resistances2);
            }

            $immunities = $typeChart[$type1]['immunities'];
            if($type2 != null){
                $immunities2 = $typeChart[$type2]['immunities'];
                $immunities = array_merge($immunities, $immunities2);
            }
            
        }

        // Remove duplicates
        $weaknesses = array_unique($weaknesses);
        $resistances = array_unique($resistances);
        $immunities = array_unique($immunities);

        // Cancel out weaknesses and resistances
        $weaknesses = array_diff($weaknesses, $resistances);
        $resistances = array_diff($resistances, $weaknesses);

        // Cancel out weaknesses and immunities
        $weaknesses = array_diff($weaknesses, $immunities);

        return [
            'weaknesses' => $weaknesses,
            'resistances' => $resistances,
            'immunities' => $immunities,
        ];
    }
}
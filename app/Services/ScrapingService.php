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

            //print_r(' END ');

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
                'weaknesses' => json_encode($weaknessesResistancesImmunities['weaknesses']),
                'resistances' => json_encode($weaknessesResistancesImmunities['resistances']),
                'immunities' => json_encode($weaknessesResistancesImmunities['immunities']),
            ];

            DB::table('pokemon')->insert($pokemon);
        });
    }

    private function calculateWeaknessesResistancesImmunities($type1, $type2 = null)
    {
        $typeChart = [
            'Normal' => ['weaknesses' => ['fighting'], 'resistances' => [], 'immunities' => ['ghost']],
            'Fire' => ['weaknesses' => ['water', 'ground', 'rock'], 'resistances' => ['fire', 'grass', 'ice', 'bug', 'steel', 'fairy'], 'immunities' => []],
            'Water' => ['weaknesses' => ['electric', 'grass'], 'resistances' => ['fire', 'water', 'ice', 'steel'], 'immunities' => []],
            'Electric' => ['weaknesses' => ['ground'], 'resistances' => ['electric', 'flying', 'steel'], 'immunities' => []],
            'Grass' => ['weaknesses' => ['fire', 'ice', 'poison', 'flying', 'bug'], 'resistances' => ['water', 'electric', 'grass', 'ground'], 'immunities' => []],
            'Ice' => ['weaknesses' => ['fire', 'fighting', 'rock', 'steel'], 'resistances' => ['ice'], 'immunities' => []],
            'Fighting' => ['weaknesses' => ['flying', 'psychic', 'fairy'], 'resistances' => ['bug', 'rock', 'dark'], 'immunities' => []],
            'Poison' => ['weaknesses' => ['ground', 'psychic'], 'resistances' => ['grass', 'fighting', 'poison', 'bug', 'fairy'], 'immunities' => []],
            'Ground' => ['weaknesses' => ['water', 'ice', 'grass'], 'resistances' => ['poison', 'rock'], 'immunities' => ['electric']],
            'Flying' => ['weaknesses' => ['electric', 'ice', 'rock'], 'resistances' => ['grass', 'fighting', 'bug'], 'immunities' => ['ground']],
            'Psychic' => ['weaknesses' => ['bug', 'ghost', 'dark'], 'resistances' => ['fighting', 'psychic'], 'immunities' => []],
            'Bug' => ['weaknesses' => ['fire', 'flying', 'rock'], 'resistances' => ['grass', 'fighting', 'ground'], 'immunities' => []],
            'Rock' => ['weaknesses' => ['water', 'grass', 'fighting', 'ground', 'steel'], 'resistances' => ['normal', 'fire', 'poison', 'flying'], 'immunities' => []],
            'Ghost' => ['weaknesses' => ['ghost', 'dark'], 'resistances' => ['poison', 'bug'], 'immunities' => ['normal', 'fighting']],
            'Dragon' => ['weaknesses' => ['ice', 'dragon', 'fairy'], 'resistances' => ['fire', 'water', 'electric', 'grass'], 'immunities' => []],
            'Dark' => ['weaknesses' => ['fighting', 'bug', 'fairy'], 'resistances' => ['ghost', 'dark'], 'immunities' => ['psychic']],
            'Steel' => ['weaknesses' => ['fire', 'fighting', 'ground'], 'resistances' => ['normal', 'grass', 'ice', 'flying', 'psychic', 'bug', 'rock', 'dragon', 'steel', 'fairy'], 'immunities' => ['poison']],
            'Fairy' => ['weaknesses' => ['poison', 'steel'], 'resistances' => ['fighting', 'bug', 'dark'], 'immunities' => ['dragon']],
        ];

        $weaknesses = [];
        $resistances = [];
        $immunities = [];

        // print_r(' type1: ');
        // print_r($type1);
        // print_r(' type2: ');
        // print_r($type2);

        foreach ([$type1, $type2] as $type) {
            
            // print_r(' in loop');
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


            // $resistances = array_merge($resistances, $typeChart[$type]['resistances']);
            // $immunities = array_merge($immunities, $typeChart[$type]['immunities']);
            
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
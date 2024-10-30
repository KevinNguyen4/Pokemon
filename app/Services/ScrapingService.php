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
    private function calculateWeaknessesResistancesImmunities($type1, $type2 = null)
    {
        $typeChart = [
            'normal' => ['weaknesses' => ['fighting'], 'resistances' => [], 'immunities' => ['ghost']],
            'fire' => ['weaknesses' => ['water', 'ground', 'rock'], 'resistances' => ['fire', 'grass', 'ice', 'bug', 'steel', 'fairy'], 'immunities' => []],
            'water' => ['weaknesses' => ['electric', 'grass'], 'resistances' => ['fire', 'water', 'ice', 'steel'], 'immunities' => []],
            'electric' => ['weaknesses' => ['ground'], 'resistances' => ['electric', 'flying', 'steel'], 'immunities' => []],
            'grass' => ['weaknesses' => ['fire', 'ice', 'poison', 'flying', 'bug'], 'resistances' => ['water', 'electric', 'grass', 'ground'], 'immunities' => []],
            'ice' => ['weaknesses' => ['fire', 'fighting', 'rock', 'steel'], 'resistances' => ['ice'], 'immunities' => []],
            'fighting' => ['weaknesses' => ['flying', 'psychic', 'fairy'], 'resistances' => ['bug', 'rock', 'dark'], 'immunities' => []],
            'poison' => ['weaknesses' => ['ground', 'psychic'], 'resistances' => ['grass', 'fighting', 'poison', 'bug', 'fairy'], 'immunities' => []],
            'ground' => ['weaknesses' => ['water', 'ice', 'grass'], 'resistances' => ['poison', 'rock'], 'immunities' => ['electric']],
            'flying' => ['weaknesses' => ['electric', 'ice', 'rock'], 'resistances' => ['grass', 'fighting', 'bug'], 'immunities' => ['ground']],
            'psychic' => ['weaknesses' => ['bug', 'ghost', 'dark'], 'resistances' => ['fighting', 'psychic'], 'immunities' => []],
            'bug' => ['weaknesses' => ['fire', 'flying', 'rock'], 'resistances' => ['grass', 'fighting', 'ground'], 'immunities' => []],
            'rock' => ['weaknesses' => ['water', 'grass', 'fighting', 'ground', 'steel'], 'resistances' => ['normal', 'fire', 'poison', 'flying'], 'immunities' => []],
            'ghost' => ['weaknesses' => ['ghost', 'dark'], 'resistances' => ['poison', 'bug'], 'immunities' => ['normal', 'fighting']],
            'dragon' => ['weaknesses' => ['ice', 'dragon', 'fairy'], 'resistances' => ['fire', 'water', 'electric', 'grass'], 'immunities' => []],
            'dark' => ['weaknesses' => ['fighting', 'bug', 'fairy'], 'resistances' => ['ghost', 'dark'], 'immunities' => ['psychic']],
            'steel' => ['weaknesses' => ['fire', 'fighting', 'ground'], 'resistances' => ['normal', 'grass', 'ice', 'flying', 'psychic', 'bug', 'rock', 'dragon', 'steel', 'fairy'], 'immunities' => ['poison']],
            'fairy' => ['weaknesses' => ['poison', 'steel'], 'resistances' => ['fighting', 'bug', 'dark'], 'immunities' => ['dragon']],
        ];

        $weaknesses = [];
        $resistances = [];
        $immunities = [];

        foreach ([$type1, $type2] as $type) { //need to cancel out some weaknesses/immunities/resistances, no logic here yet
            if ($type && isset($typeChart[$type])) {
                $weaknesses = array_merge($weaknesses, $typeChart[$type]['weaknesses']);
                $resistances = array_merge($resistances, $typeChart[$type]['resistances']);
                $immunities = array_merge($immunities, $typeChart[$type]['immunities']);
            }
        }

        // Remove duplicates
        $weaknesses = array_unique($weaknesses);
        $resistances = array_unique($resistances);
        $immunities = array_unique($immunities);

        return [
            'weaknesses' => $weaknesses,
            'resistances' => $resistances,
            'immunities' => $immunities,
        ];
    }

    public function scrapePokemonTable()
    {
        $crawler = $this->client->request('GET', 'https://pokemondb.net/pokedex/all');

        $crawler->filter('table#pokedex tbody tr')->each(function ($node, $index) {
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
                'weaknesses' => json_encode($weaknessesResistancesImmunities['weaknesses']),
                'resistances' => json_encode($weaknessesResistancesImmunities['resistances']),
                'immunities' => json_encode($weaknessesResistancesImmunities['immunities']),
            ];

            DB::table('pokemon')->insert($pokemon);
            //probably where i insert the other stuff
        });
    }


}
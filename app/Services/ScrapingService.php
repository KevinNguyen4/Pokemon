<?php
namespace App\Services;

use Goutte\Client;
use Illuminate\Support\Facades\DB;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Log;



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

        //this scrapes the abilities table and does the stragglers manually
        $this->scrapeAbilities();
        $this->setManualAbilities();
    }

    private function calculateWeaknessesResistancesImmunities($type1, $type2 = null){
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

            //remove dupes
            $weaknesses = array_unique($weaknesses);
            $resistances = array_unique($resistances);
            $immunities = array_unique($immunities);


            //so now they have all the data, now we have to cancel them out
            
            // If there is a type in both weaknesses and resistances, remove it from both
            $commonWeakResist = array_intersect($weaknesses, $resistances);
            $weaknesses = array_diff($weaknesses, $commonWeakResist);
            $resistances = array_diff($resistances, $commonWeakResist);

            // If there is a type in immunities, remove it from both weaknesses and resistances
            $weaknesses = array_diff($weaknesses, $immunities);
            $resistances = array_diff($resistances, $immunities);


            //now we order the 3 lists based on type ordering
            $order = [
                'Normal', 'Fire', 'Water', 'Electric', 'Grass', 'Ice', 'Fighting', 'Poison', 'Ground', 'Flying', 
                'Psychic', 'Bug', 'Rock', 'Ghost', 'Dragon', 'Dark', 'Steel', 'Fairy'
            ];
            
            // Custom sorting function
            $sortFunction = function($a, $b) use ($order) {
                $posA = array_search($a, $order);
                $posB = array_search($b, $order);
                return $posA - $posB;
            };
            
            // Sort the arrays based on the custom order
            usort($weaknesses, $sortFunction);
            usort($resistances, $sortFunction);
            usort($immunities, $sortFunction);
            
        }

        return [
            'weaknesses' => $weaknesses,
            'resistances' => $resistances,
            'immunities' => $immunities,
        ];
    }

    private function scrapeAbilities()
{
    $url = 'https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_Ability';
    $crawler = $this->client->request('GET', $url);

    $crawler->filter('table.roundy tbody tr')->each(function ($node) {
        try {
            // Extract and clean the name
            $name = $node->filter('td')->eq(2)->text();
            $name = str_replace('*', '', $name); // Remove any asterisks
            $name = preg_replace('/(?<=\w)(?=[A-Z])/', ' ', $name); // Insert space before uppercase letters following lowercase letters
            $name = preg_replace('/\s+/', ' ', $name); // Replace multiple spaces with a single space
            $name = trim($name); // Trim leading and trailing spaces

            // Extract and clean abilities( DOES NOT REMOVE GEN RIGHT NOW YET)
            $ability1 = preg_replace('/\s*Gen\s*[IVXLCDM]+\+?$/i', '', $node->filter('td')->eq(3)->text());
            $ability2 = preg_replace('/\s*Gen\s*[IVXLCDM]+\+?$/i', '', $node->filter('td')->eq(4)->text());
            $hiddenAbility = preg_replace('/\s*Gen\s*[IVXLCDM]+\+?$/i', '', $node->filter('td')->eq(5)->text());

            //for if i want the gen tags
            // $ability1 = preg_replace('/(?<=\w)(?=Gen\s*[IVXLCDM]+\+?)/i', ' ', $node->filter('td')->eq(3)->text());
            // $ability2 = preg_replace('/(?<=\w)(?=Gen\s*[IVXLCDM]+\+?)/i', ' ', $node->filter('td')->eq(4)->text());
            // $hiddenAbility = preg_replace('/(?<=\w)(?=Gen\s*[IVXLCDM]+\+?)/i', ' ', $node->filter('td')->eq(5)->text());

            // echo 'Scraped abilities for ' . $name . PHP_EOL;
            // echo 'Ability 1: ' . $ability1 . PHP_EOL;
            // echo 'Ability 2: ' . $ability2 . PHP_EOL;
            // echo 'Hidden Ability: ' . $hiddenAbility . PHP_EOL;

            // Find the closest matching Pokémon in the database
            $pokemon = $this->findClosestPokemon($name);

            if ($pokemon) {
                // Update the Pokémon with the scraped abilities
                $pokemon->update([
                    'ability1' => $ability1,
                    'ability2' => $ability2,
                    'hiddenAbility' => $hiddenAbility,
                ]);
            }
        } catch (\InvalidArgumentException $e) {
        }
    });
}

//helper function to find the closest pokemon, used in scrapeAbilities
//(its for pokemon names that are not the exact same, but still want to match)
private function findClosestPokemon($name)
{
    $pokemons = Pokemon::all();
    $closest = null;
    $highestSimilarity = 0;

    foreach ($pokemons as $pokemon) {
        similar_text($name, $pokemon->name, $similarity);

        if ($similarity > $highestSimilarity) {
            $closest = $pokemon;
            $highestSimilarity = $similarity;
        }
    }

    // Additional check to ensure the closest match is reasonably similar
    if ($highestSimilarity < 70) { // Adjust the threshold as needed
        return null;
    }

    return $closest;
}

private function setManualAbilities()
{
    $manualAbilities = [
        'Tauros Blaze Breed' => [
            'ability1' => 'Intimidate',
            'ability2' => 'Anger Point',
            'hiddenAbility' => 'Cud Chew',
        ],
        'Tauros Aqua Breed' => [
            'ability1' => 'Intimidate',
            'ability2' => 'Anger Point',
            'hiddenAbility' => 'Cud Chew',
        ],
        'Eevee Partner Eevee' => [
            'ability1' => 'Run Away',
            'ability2' => 'Adaptability',
            'hiddenAbility' => 'Anticipation',
        ],
        'Cherrim' => [
            'ability1' => 'Flower Gift',
            'ability2' => null,
            'hiddenAbility' => null,
        ],
        'Shellos' => [
            'ability1' => 'Sticky Hold',
            'ability2' => 'Storm Drain',
            'hiddenAbility' => 'Sand Force',
        ],
        'Gastrodon' => [
            'ability1' => 'Sticky Hold',
            'ability2' => 'Storm Drain',
            'hiddenAbility' => 'Sand Force',
        ],
        'Sawsbuck' => [
            'ability1' => 'Chlorophyll',
            'ability2' => 'Sap Sipper',
            'hiddenAbility' => 'Serene Grace',
        ],
        'Pumpkaboo Average Size' => [
            'ability1' => 'Pickup',
            'ability2' => 'Frisk',
            'hiddenAbility' => 'Insomnia',
        ],
        'Pumpkaboo Small Size' => [
            'ability1' => 'Pickup',
            'ability2' => 'Frisk',
            'hiddenAbility' => 'Insomnia',
        ],
        'Pumpkaboo Large Size' => [
            'ability1' => 'Pickup',
            'ability2' => 'Frisk',
            'hiddenAbility' => 'Insomnia',
        ],
        'Pumpkaboo Super Size' => [
            'ability1' => 'Pickup',
            'ability2' => 'Frisk',
            'hiddenAbility' => 'Insomnia',
        ],
        'Gourgeist Average Size' => [
            'ability1' => 'Pickup',
            'ability2' => 'Frisk',
            'hiddenAbility' => 'Insomnia',
        ],
        'Gourgeist Small Size' => [
            'ability1' => 'Pickup',
            'ability2' => 'Frisk',
            'hiddenAbility' => 'Insomnia',
        ],
        'Gourgeist Large Size' => [
            'ability1' => 'Pickup',
            'ability2' => 'Frisk',
            'hiddenAbility' => 'Insomnia',
        ],
        'Gourgeist Super Size' => [
            'ability1' => 'Pickup',
            'ability2' => 'Frisk',
            'hiddenAbility' => 'Insomnia',
        ],
        'Rockruff Own Tempo Rockruff' => [
            'ability1' => 'Own Tempo',
            'ability2' => null,
            'hiddenAbility' => null,
        ],
        'Eiscue Ice Face' => [
            'ability1' => 'Ice Face',
            'ability2' => null,
            'hiddenAbility' => null,
        ],
        'Basculegion Female' => [
            'ability1' => 'Swift Swim',
            'ability2' => 'Adaptability',
            'hiddenAbility' => 'Mold Breaker',
        ],
        'Palafin Zero Form' => [
            'ability1' => 'Zero to Hero',
            'ability2' => null,
            'hiddenAbility' => null,
        ],
        'Dudunsparce Two-Segment Form' => [
            'ability1' => 'Serene Grace',
            'ability2' => 'Run Away',
            'hiddenAbility' => 'Rattled',
        ],
        'Gimmighoul Chest Form' => [
            'ability1' => 'Rattled',
            'ability2' => null,
            'hiddenAbility' => null,
        ],
        'Terapagos Normal Form' => [
            'ability1' => 'Tera Shift',
            'ability2' => null,
            'hiddenAbility' => null,
        ],
    ];

    foreach ($manualAbilities as $name => $abilities) {
        $pokemon = Pokemon::where('name', $name)->first();

        if ($pokemon) {
            $pokemon->update([
                'ability1' => $abilities['ability1'],
                'ability2' => $abilities['ability2'],
                'hiddenAbility' => $abilities['hiddenAbility'],
            ]);
        }
    }
}


}
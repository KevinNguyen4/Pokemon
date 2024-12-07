<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    //OLD VERSION search results for pokemon database page(by name, number, type, and ability)
    // public function index(Request $request){
    //     $query = $request->input('query');

    //     if ($query) {
    //         if (is_numeric($query)) {
    //             // Remove leading zeros from the query
    //             $query = ltrim($query, '0');
    //             // Search by exact number match
    //             $pokemons = Pokemon::whereRaw('CAST(number AS UNSIGNED) = ?', [$query])->get();
    //         } else {
    //             // Search by name
    //             $pokemons = Pokemon::where('name', 'LIKE', "%{$query}%")->get();
    //         }

    //         //add type and ability here
    //             //$pokemons = Pokemon::where('type1', 'LIKE', "%{$query}%")->get();



    //     } else {
    //         $pokemons = Pokemon::all();
    //     }

    //     return view('welcome', compact('pokemons'));
    // }


    public function index(Request $request){
        $query = $request->input('query');
        $type = $request->input('type');
        $ability = $request->input('ability');

        $pokemons = Pokemon::query();

        if ($query) {
            $pokemons->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('number', 'like', '%' . $query . '%');
            });
        }

        if ($type) {
            $pokemons->where(function ($q) use ($type) {
                $q->where('type1', 'like', '%' . $type . '%')
                  ->orWhere('type2', 'like', '%' . $type . '%');
            });
        }

        if ($ability) {
            $pokemons->where(function ($q) use ($ability) {
                $q->where('ability1', 'like', '%' . $ability . '%')
                  ->orWhere('ability2', 'like', '%' . $ability . '%')
                  ->orWhere('hiddenAbility', 'like', '%' . $ability . '%');
            });
        }

        $pokemons = $pokemons->get();

        return view('welcome', compact('pokemons'));
}

    //for when you click on the pokemon name it will take you to a different site
    public function show($name){
        // Find the Pokémon by name
        $pokemon = Pokemon::where('name', $name)->firstOrFail();

        // Return the view with the Pokémon details
        return view('pokemon.show', compact('pokemon'));
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

    //about me page
    public function about(){
        return view('about');
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

    //pokemon quiz pages
    public function quiz(){
        return view('pokemonQuiz');
    }

    public function baseStatTotal(){
        // Fetch a random base stat total from the database
        $randomBaseStatTotal = Pokemon::where('total', '>=', 400)
        ->whereRaw('total % 10 = 0')
        ->inRandomOrder()
        ->first()
        ->total;

        return view('quiz.baseStatTotal', compact('randomBaseStatTotal'));
    }

    public function checkBaseStatTotal(Request $request){
        $baseStatTotal = $request->input('base_stat_total');
        $pokemonName = $request->input('pokemon_name');

        // Fetch all Pokémon with the given base stat total
        $pokemons = Pokemon::where('total', $baseStatTotal)->get();

        $bestMatch = null;
        $highestSimilarity = 0;

        // Check for the best match using similar_text
        foreach ($pokemons as $pokemon) {
            similar_text(strtolower($pokemonName), strtolower($pokemon->name), $percent);
            if ($percent > $highestSimilarity) {
                $highestSimilarity = $percent;
                $bestMatch = $pokemon;
            }

            // Check if the user's input matches the first word of the Pokémon name
            $pokemonFirstWord = strtolower(explode(' ', $pokemon->name)[0]);
            if (strtolower($pokemonName) == $pokemonFirstWord) {
                // Increment the correct counter
                $correctCounter = session('correct_counter1', 0) + 1;
                session(['correct_counter1' => $correctCounter]);

                return redirect()->back()->with('success', 'Correct! ' . $pokemon->name . ' has a base stat total of ' . $baseStatTotal . '. Correct in a row: ' . $correctCounter);
            }
        }

        // Define a threshold for leniency (e.g., 70% similarity)
        $threshold = 70;

        if ($bestMatch && $highestSimilarity >= $threshold) {
            // Increment the correct counter
            $correctCounter = session('correct_counter1', 0) + 1;
            session(['correct_counter1' => $correctCounter]);

            return redirect()->back()->with('success', 'Correct! ' . $bestMatch->name . ' has a base stat total of ' . $baseStatTotal . '. Correct in a row: ' . $correctCounter);
        } else {
            // Reset the correct counter
            session(['correct_counter1' => 0]);

            return redirect()->back()->with('error', 'Incorrect. No Pokémon with that name has a base stat total of ' . $baseStatTotal . '. Correct in a row: 0');
        }
    }

    public function ability(){
        // Fetch a random Pokémon from the database
        $randomPokemon = Pokemon::inRandomOrder()->first();

        // Select a random ability from the Pokémon's abilities
        $abilities = array_filter([$randomPokemon->ability1, $randomPokemon->ability2, $randomPokemon->hiddenAbility]);
        $randomAbility = $abilities[array_rand($abilities)];

        return view('quiz.ability', compact('randomAbility'));
    }

    public function checkAbility(Request $request){
        $ability = $request->input('ability');
        $pokemonName = $request->input('pokemon_name');

        // Fetch all Pokémon with the given ability
        $pokemons = Pokemon::where('ability1', $ability)
                           ->orWhere('ability2', $ability)
                           ->orWhere('hiddenAbility', $ability)
                           ->get();

        $bestMatch = null;
        $highestSimilarity = 0;

        // Check for the best match using similar_text
        foreach ($pokemons as $pokemon) {
            similar_text(strtolower($pokemonName), strtolower($pokemon->name), $percent);
            if ($percent > $highestSimilarity) {
                $highestSimilarity = $percent;
                $bestMatch = $pokemon;
            }

            // Check if the user's input matches the first word of the Pokémon name
            $pokemonFirstWord = strtolower(explode(' ', $pokemon->name)[0]);
            if (strtolower($pokemonName) == $pokemonFirstWord) {
                // Increment the correct counter
                $correctCounter = session('correct_counter2', 0) + 1;
                session(['correct_counter2' => $correctCounter]);

                return redirect()->back()->with('success', 'Correct! ' . $pokemon->name . ' has the ability ' . $ability . '. Correct in a row: ' . $correctCounter);
            }
        }

        // Define a threshold for leniency (e.g., 70% similarity)
        $threshold = 70;

        if ($bestMatch && $highestSimilarity >= $threshold) {
            // Increment the correct counter
            $correctCounter = session('correct_counter2', 0) + 1;
            session(['correct_counter2' => $correctCounter]);

            return redirect()->back()->with('success', 'Correct! ' . $bestMatch->name . ' has the ability ' . $ability . '. Correct in a row: ' . $correctCounter);
        } else {
            // Reset the correct counter
            session(['correct_counter2' => 0]);

            return redirect()->back()->with('error', 'Incorrect. No Pokémon with that name has the ability ' . $ability . '. Correct in a row: 0');
        }
    }

    public function typing(){
        // Define an array of all 18 Pokémon types
        $allTypes = [
            'Normal', 'Fire', 'Water', 'Electric', 'Grass', 'Ice', 'Fighting', 'Poison', 
            'Ground', 'Flying', 'Psychic', 'Bug', 'Rock', 'Ghost', 'Dragon', 'Dark', 
            'Steel', 'Fairy'
        ];
    
        // Select two random types from the array
        $randomTypes = array_rand(array_flip($allTypes), 2);
    
        return view('quiz.typing', compact('randomTypes'));
    }

    public function checkTyping(Request $request){
        $types = $request->input('types');
        $pokemonName = $request->input('pokemon_name');

        // Fetch all Pokémon with the given types
        $pokemons = Pokemon::where(function ($query) use ($types) {
            $query->where('type1', $types[0])
                ->orWhere('type2', $types[0]);
        })->where(function ($query) use ($types) {
            if (count($types) > 1) {
                $query->where('type1', $types[1])
                    ->orWhere('type2', $types[1]);
            }
        })->get();

        // Check if there are any Pokémon with the given types
        if ($pokemons->isEmpty()) {
            if (!empty($pokemonName)) {
                // Reset the correct counter
                session(['correct_counter3' => 0]);
                return redirect()->back()->with('error', 'Incorrect. No Pokémon has the typing ' . implode('/', $types) . '. Correct in a row: 0');
            } else {
                // Increment the correct counter
                $correctCounter = session('correct_counter3', 0) + 1;
                session(['correct_counter3' => $correctCounter]);
                return redirect()->back()->with('success', 'Correct! No Pokémon has the typing ' . implode('/', $types) . '. Correct in a row: ' . $correctCounter);
            }
        }

        $bestMatch = null;
        $highestSimilarity = 0;

        // Check for the best match using similar_text
        foreach ($pokemons as $pokemon) {
            similar_text(strtolower($pokemonName), strtolower($pokemon->name), $percent);
            if ($percent > $highestSimilarity) {
                $highestSimilarity = $percent;
                $bestMatch = $pokemon;
            }

            // Check if the user's input matches the first word of the Pokémon name
            $pokemonFirstWord = strtolower(explode(' ', $pokemon->name)[0]);
            if (strtolower($pokemonName) == $pokemonFirstWord) {
                // Increment the correct counter
                $correctCounter = session('correct_counter3', 0) + 1;
                session(['correct_counter3' => $correctCounter]);

                return redirect()->back()->with('success', 'Correct! ' . $pokemon->name . ' has the typing ' . implode('/', $types) . '. Correct in a row: ' . $correctCounter);
            }
        }

        // Define a threshold for leniency (e.g., 70% similarity)
        $threshold = 70;

        if ($bestMatch && $highestSimilarity >= $threshold) {
            // Increment the correct counter
            $correctCounter = session('correct_counter3', 0) + 1;
            session(['correct_counter3' => $correctCounter]);

            return redirect()->back()->with('success', 'Correct! ' . $bestMatch->name . ' has the typing ' . implode('/', $types) . '. Correct in a row: ' . $correctCounter);
        } else {
            // Reset the correct counter
            session(['correct_counter3' => 0]);

            return redirect()->back()->with('error', 'Incorrect. No Pokémon with that name has the typing ' . implode('/', $types) . '. Correct in a row: 0');
        }
    }

    public function higherLower(){
        // Check if there is a Pokémon 2 stored in the session
        if (session()->has('pokemon2')) {
            $pokemon1 = session('pokemon2');
        } else {
            // Fetch a random Pokémon from the database for the first question
            $pokemon1 = Pokemon::inRandomOrder()->first();
        }

        // Fetch a new random Pokémon for Pokémon 2
        $pokemon2 = Pokemon::inRandomOrder()->first();

        // Define an array of possible stats
        $stats = ['hp', 'attack', 'defense', 'sp_atk', 'sp_def', 'speed', 'total'];

        // Select a random stat
        $randomStat = $stats[array_rand($stats)];

        // Store Pokémon 2 in the session for the next question
        session(['pokemon2' => $pokemon2]);

        return view('quiz.higherLower', compact('pokemon1', 'pokemon2', 'randomStat'));
    }

    public function checkHigherLower(Request $request){
        $pokemon1 = Pokemon::find($request->input('pokemon1_id'));
        $pokemon2 = Pokemon::find($request->input('pokemon2_id'));
        $randomStat = $request->input('random_stat');
        $userGuess = $request->input('guess');

        $stat1 = $pokemon1->$randomStat;
        $stat2 = $pokemon2->$randomStat;

        $correctAnswer = $stat2 > $stat1 ? 'higher' : 'lower';

        // Mapping of stat keys to full names
        $statNames = [
            'hp' => 'HP',
            'attack' => 'Attack',
            'defense' => 'Defense',
            'sp_atk' => 'Special Attack',
            'sp_def' => 'Special Defense',
            'speed' => 'Speed',
            'total' => 'Total'
        ];

        $statFullName = $statNames[$randomStat];

        if ($userGuess === $correctAnswer) {
            // Increment the correct counter
            $correctCounter = session('correct_counter4', 0) + 1;
            session(['correct_counter4' => $correctCounter]);

            return redirect()->back()->with('success', 'Correct! ' . $pokemon2->name . ' has ' . $correctAnswer . ' ' . $statFullName . ' than ' . $pokemon1->name . '. Correct in a row: ' . $correctCounter);
        } else {
            // Reset the correct counter
            session(['correct_counter4' => 0]);

            return redirect()->back()->with('error', 'Incorrect. ' . $pokemon2->name . ' has ' . $correctAnswer . ' ' . $statFullName . ' than ' . $pokemon1->name . '. Correct in a row: 0');
        }
    }

    public function namePokemon(){
        return view('quiz.namePokemon');
    }

    public function clues(){
        // Fetch a random Pokémon from the database that has entries in its moves property
        $pokemon = Pokemon::whereNotNull('moves')->inRandomOrder()->first();
    
        // Decode the JSON data in the moves and weaknesses columns
        $moves = json_decode($pokemon->moves, true);
        $weaknesses = json_decode($pokemon->weaknesses, true);
    
        // Prepare initial clues
        $clues = [
            'moves' => 'Common moves: ' . implode(', ', $moves),
            'pokedex_number' => 'Pokedex number: ' . $pokemon->number,
            'start_of_name' => 'Start of the name: ' . substr($pokemon->name, 0, 1),
            'typing' => 'Typing: ' . $pokemon->type1 . ($pokemon->type2 ? '/' . $pokemon->type2 : ''),
            'ability' => 'Ability: ' . $pokemon->ability1 . ($pokemon->ability2 ? '/' . $pokemon->ability2 : '') . ($pokemon->hiddenAbility ? '/' . $pokemon->hiddenAbility : ''),
            'weakness' => 'Weak to: ' . $weaknesses[array_rand($weaknesses)]
        ];
    
        // Store the Pokémon and clues in the session
        session(['clue_pokemon' => $pokemon, 'clues' => $clues, 'attempts' => 0]);
    
        return view('quiz.clues', compact('clues'));
    }
    
    public function checkClues(Request $request){
        $pokemon = session('clue_pokemon');
        $clues = session('clues');
        $attempts = session('attempts', 0);
        $userGuess = $request->input('pokemon_name');

        // Increment the attempts counter
        $attempts++;
        session(['attempts' => $attempts]);

        // Check if the user's guess is correct using similar_text for leniency
        similar_text(strtolower($userGuess), strtolower($pokemon->name), $percent);
        if ($percent > 70) { // Adjust the threshold as needed
            // Reset the session data
            session()->forget(['clue_pokemon', 'clues', 'attempts']);
            return redirect()->back()->with('success', 'Correct! The Pokémon is ' . $pokemon->name);
        }

        // Check if the user has reached the maximum number of attempts
        if ($attempts >= 6) {
            // Reset the session data
            session()->forget(['clue_pokemon', 'clues', 'attempts']);
            return redirect()->back()->with('error', 'You have used all your attempts. The Pokémon was ' . $pokemon->name);
        }

        //they got it wrong, show next clue
        echo "<pre>";
        print_r($attempts);
        echo "</pre>";
        return redirect()->back();
        
    }

    public function getRandomPokemon(){
        // Fetch a random Pokémon from the database that has entries in its moves property
        $pokemon = Pokemon::whereNotNull('moves')->inRandomOrder()->first();
    
        // Decode the JSON data in the moves and weaknesses columns
        $moves = json_decode($pokemon->moves, true);
        $weaknesses = json_decode($pokemon->weaknesses, true);
    
        // Prepare initial clues
        $clues = [
            'moves' => 'Common moves: ' . implode(', ', $moves),
            'pokedex_number' => 'Pokedex number: ' . $pokemon->number,
            'start_of_name' => 'Start of the name: ' . substr($pokemon->name, 0, 1),
            'typing' => 'Typing: ' . $pokemon->type1 . ($pokemon->type2 ? '/' . $pokemon->type2 : ''),
            'ability' => 'Ability: ' . $pokemon->ability1 . ($pokemon->ability2 ? '/' . $pokemon->ability2 : '') . ($pokemon->hiddenAbility ? '/' . $pokemon->hiddenAbility : ''),
            'weakness' => 'Weak to: ' . $weaknesses[array_rand($weaknesses)]
        ];
    
        // Store the Pokémon and clues in the session
        session(['clue_pokemon' => $pokemon, 'clues' => $clues, 'attempts' => 0]);
    
        return response()->json(['clues' => $clues]);
    }
    
    public function checkGuess(Request $request){
        $pokemon = session('clue_pokemon');
        $clues = session('clues');
        $attempts = session('attempts', 0);
        $userGuess = $request->input('pokemon_name');
    
        // Increment the attempts counter
        $attempts++;
        session(['attempts' => $attempts]);
    
        // Check if the user's guess is correct using similar_text for leniency
        similar_text(strtolower($userGuess), strtolower($pokemon->name), $percent);
        if ($percent > 70) { // Adjust the threshold as needed
            // Reset the session data
            session()->forget(['clue_pokemon', 'clues', 'attempts']);
            return response()->json([
                'success' => true,
                'message' => 'Correct! The Pokémon is ' . $pokemon->name
            ]);
        }
    
        // Check if the user has reached the maximum number of attempts
        if ($attempts >= 6) {
            // Reset the session data
            session()->forget(['clue_pokemon', 'clues', 'attempts']);
            return response()->json([
                'success' => false,
                'message' => 'You have used all your attempts. The Pokémon was ' . $pokemon->name
            ]);
        }
    
        // Return with an error message and reveal the next clue
        return response()->json([
            'success' => false,
            'message' => 'Incorrect. Try again.'
        ]);
    }




}
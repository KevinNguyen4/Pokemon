<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    //search results for pokemon database page
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            if (is_numeric($query)) {
                // Remove leading zeros from the query
                $query = ltrim($query, '0');
                // Search by exact number match
                $pokemons = Pokemon::whereRaw('CAST(number AS UNSIGNED) = ?', [$query])->get();
            } else {
                // Search by name
                $pokemons = Pokemon::where('name', 'LIKE', "%{$query}%")->get();
            }
        } else {
            $pokemons = Pokemon::all();
        }

        return view('welcome', compact('pokemons'));
    }

    //for when you click on the pokemon name it will take you to a different site
    public function show($name)
    {
        // Find the Pokémon by name
        $pokemon = Pokemon::where('name', $name)->firstOrFail();

        // Return the view with the Pokémon details
        return view('pokemon.show', compact('pokemon'));
    }


}
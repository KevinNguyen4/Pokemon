<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    //search results for pokemon database page(by name, number, type, and ability)
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

    public function sendEmail(Request $request)
    {
        // Check if the email was sent within the last 24 hours
        if (Cache::has('email_sent')) {
            return back()->with('error', 'You can only send an email once every 24 hours.');
        }

        // Send the email
        Mail::raw('This is a test email from Kevin Nguyen\'s website.', function ($message) {
            $message->to('kdn2000job@gmail.com')
                    ->subject('Test Email from Kevin Nguyen\'s Website');
        });

        // Store a flag in the cache to prevent sending another email for 24 hours
        Cache::put('email_sent', true, 86400);

        return back()->with('success', 'Email sent successfully!');
    }

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

    //pokemon quiz pages
    public function quiz(){
        return view('pokemonQuiz');
    }

    public function baseStatTotal(Request $request){
        if ($request->isMethod('post')) {
            $baseStatTotal = $request->input('base_stat_total');
            $pokemons = Pokemon::where('total', $baseStatTotal)->get();
            return view('quiz.baseStatTotal', compact('pokemons', 'baseStatTotal'));
        }
    
        return view('quiz.baseStatTotal');
    }

    public function ability()
    {
        return view('quiz.ability');
    }

    public function typing()
    {
        return view('quiz.typing');
    }

    public function higherLower()
    {
        return view('quiz.higherLower');
    }

    public function namePokemon()
    {
        return view('quiz.namePokemon');
    }

    public function clues()
    {
        return view('quiz.clues');
    }




}
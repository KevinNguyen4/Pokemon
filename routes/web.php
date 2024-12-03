<?php

use App\Http\Controllers\PokemonController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//main page
Route::get('/', function () {
    return view('welcome');
});

//search results for pokemon database page
Route::get('/', [PokemonController::class, 'index'])->name('pokemon.search');

//show the Pokémon details when u click on each name
Route::get('/pokemon/{name}', [PokemonController::class, 'show'])->name('pokemon.show');

//add new ones here for new pages(quiz, about, etc)
Route::get('/pokemonQuiz', [PokemonController::class, 'quiz'])->name('quiz');
Route::get('/quiz', [PokemonController::class, 'index'])->name('pokemon.index');
Route::get('/quiz/base-stat-total', [PokemonController::class, 'baseStatTotal'])->name('pokemon.baseStatTotal');
Route::get('/quiz/ability', [PokemonController::class, 'ability'])->name('pokemon.ability');
Route::get('/quiz/typing', [PokemonController::class, 'typing'])->name('pokemon.typing');
Route::get('/quiz/higher-lower', [PokemonController::class, 'higherLower'])->name('pokemon.higherLower');
Route::get('/quiz/name-pokemon', [PokemonController::class, 'namePokemon'])->name('pokemon.namePokemon');
Route::get('/quiz/clues', [PokemonController::class, 'clues'])->name('pokemon.clues');

//about me
Route::get('/about', [PokemonController::class, 'about'])->name('aboutme');
Route::post('/send-email', [PokemonController::class, 'sendEmail'])->name('pokemon.email');

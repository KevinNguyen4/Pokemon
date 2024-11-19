<?php

use App\Http\Controllers\PokemonController;
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
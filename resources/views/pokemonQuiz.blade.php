{{-- POKEMON QUIZ PAGE
8-Make a fun little game, perhaps guessing base stats or typing or something like 
pokedoku who has this ability or something based off the stuff in the table
(guess how many ghost types there are, how many pokemon with higher than 600 Base stats, or whatever)

Make a score/quiz with progress and fun little things throughout the way
1. name a pokemon that has this base stat total?
2. name a pokemon that has this ability
3. how many X types are there?
4. name a pokemon that has this typing(fire rock)
5. higher or lower stats --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kevin's Pokémon Quiz</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <div class="container">
        <h1>Pokémon Quiz</h1>
        <div class="table-container">
            <p>Pick a quiz:</p>
            <ul><br><br>
                <li><a href="{{ route('pokemon.baseStatTotal') }}" class="button">Name a Pokémon that has this base stat total</a></li><br><br>
                <li><a href="{{ route('pokemon.ability') }}" class="button">Name a Pokémon that has this ability</a></li><br><br>
                <li><a href="{{ route('pokemon.typing') }}" class="button">Name a Pokémon that has this typing (e.g., Fire/Rock)</a></li><br><br>
                <li><a href="{{ route('pokemon.higherLower') }}" class="button">Higher or Lower Stats</a></li><br><br>
                <li><a href="{{ route('pokemon.namePokemon') }}" class="button">Name as many Pokémon that</a></li><br><br>
                <li><a href="{{ route('pokemon.clues') }}" class="button">Guess the Pokémon based on clues</a></li><br><br>

        </div>
    </div>
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
</body>
</html>
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
    @include('layouts.header')
    <div class="aboutContainer">
        <h1>Pokémon Quiz</h1>
        <div class="quiz-container">
            <div class="quiz-content">
                <h2>Pick a quiz:</h2><br><br>
                <ul>
                    <li><a href="{{ route('pokemon.baseStatTotal') }}" class="button">Name a Pokémon that has this base stat total</a></li><br><br>
                    <li><a href="{{ route('pokemon.ability') }}" class="button">Name a Pokémon that has this ability</a></li><br><br>
                    <li><a href="{{ route('pokemon.typing') }}" class="button">Name a Pokémon that has this typing (e.g., Fire/Rock)</a></li><br><br>
                    <li><a href="{{ route('pokemon.higherLower') }}" class="button">Higher or Lower Stats</a></li><br><br>
                    <li><a href="{{ route('pokemon.namePokemon') }}" class="button">Name as many of the original 151 as you can</a></li><br><br>
                    <li><a href="{{ route('pokemon.clues') }}" class="button">Guess the Pokémon based on clues</a></li><br><br>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
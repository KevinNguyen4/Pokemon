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
            pick a quiz<br>
            1. name a pokemon that has this base stat total<br>
            2. name a pokemon that has this ability<br>
            3. name a pokemon that has this typing(fire rock)<br>
            4. higher or lower stats<br>
            5. name as many pokemon that start with a certain letter,type, or are weak to(it can be a streak thing like go until fail)<br>
            6. gives clues to the pokemon and you have to guess like its weak to rock, electric, its 2nd type is flying/is monotype<br>

        </div>
    </div>
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Name Pokémon</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <div class="container">
        <h1>Pokémon Quiz - Name Pokémon</h1>
        <form method="POST" action="{{ route('pokemon.namePokemon') }}">
            @csrf
            <label for="criteria">Enter a criteria (e.g., starts with a letter, type, weakness):</label>
            <input type="text" name="criteria" id="criteria" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Ability</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <div class="quizContainer">
        <h1>Pokémon Quiz - Ability</h1>
        <p>Guess any Pokémon that has the ability <strong>{{ $randomAbility }}</strong></p>
        <form method="POST" action="{{ route('pokemon.checkAbility') }}">
            @csrf
            <input type="hidden" name="ability" value="{{ $randomAbility }}">
            <label for="pokemon_name">Enter Pokémon name:</label>
            <input type="text" name="pokemon_name" id="pokemon_name" required>
            <button type="submit">Submit</button>
        </form>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif
    </div>
</body>
</html>
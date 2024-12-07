<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Base Stat Total</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <div class="container">
        <h1>Pokémon Quiz - Base Stat Total</h1>
        <p>Guess any Pokémon that has a base stat total of <strong>{{ $randomBaseStatTotal }}</strong></p>
        <form method="POST" action="{{ route('pokemon.checkBaseStatTotal') }}">
            @csrf
            <input type="hidden" name="base_stat_total" value="{{ $randomBaseStatTotal }}">
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
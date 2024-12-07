<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Typing</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <div class="container">
        <h1>Pokémon Quiz - Typing</h1>
            <p>Guess any Pokémon that has the typing <strong>{{ implode("/", $randomTypes) }}</strong></p>
        <form method="POST" action="{{ route('pokemon.checkTyping') }}">
            @csrf

                <input type="hidden" name="types[]" value="{{ $randomTypes[0] }}">
                @if (count($randomTypes) > 1)
                    <input type="hidden" name="types[]" value="{{ $randomTypes[1] }}">
                @endif

            <label for="pokemon_name">Enter Pokémon name:</label>
            <input type="text" name="pokemon_name" id="pokemon_name" required>
            <button type="submit">Submit</button>
        </form>
        <form method="POST" action="{{ route('pokemon.checkTyping') }}">
            @csrf

                <input type="hidden" name="types[]" value="{{ $randomTypes[0] }}">
                @if (count($randomTypes) > 1)
                    <input type="hidden" name="types[]" value="{{ $randomTypes[1] }}">
                @endif

            <input type="hidden" name="pokemon_name" value="">
            <button type="submit">This typing does not exist</button>
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
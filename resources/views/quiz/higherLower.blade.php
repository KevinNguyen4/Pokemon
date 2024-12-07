<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Higher or Lower Stats</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <div class="container">
        <h1>Pokémon Quiz - Higher or Lower Stats</h1>
        <p>Does <strong>{{ $pokemon2->name }}</strong> have higher or lower <strong>{{ ucfirst($randomStat) }}</strong> than <strong>{{ $pokemon1->name }}</strong>?</p>
        <form method="POST" action="{{ route('pokemon.checkHigherLower') }}">
            @csrf
            <input type="hidden" name="pokemon1_id" value="{{ $pokemon1->id }}">
            <input type="hidden" name="pokemon2_id" value="{{ $pokemon2->id }}">
            <input type="hidden" name="random_stat" value="{{ $randomStat }}">
            <button type="submit" name="guess" value="higher" class="button">Higher</button>
            <button type="submit" name="guess" value="lower" class="button">Lower</button>
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
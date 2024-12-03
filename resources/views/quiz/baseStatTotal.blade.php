<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Base Stat Total</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Pokémon Quiz - Base Stat Total</h1>
        <form method="POST" action="{{ route('pokemon.baseStatTotal') }}">
            @csrf 
            <label for="base_stat_total">Enter a base stat total:</label>
            <input type="number" name="base_stat_total" id="base_stat_total" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
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
    <div class="container">
        <h1>Pokémon Quiz - Ability</h1>
        <form method="POST" action="{{ route('quiz.ability') }}">
            @csrf
            <label for="ability">Enter an ability:</label>
            <input type="text" name="ability" id="ability" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
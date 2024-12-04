<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Clues</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.header')
    <div class="container">
        <h1>Pokémon Quiz - Clues</h1>
        <form method="POST" action="{{ route('quiz.clues') }}">
            @csrf
            <label for="clues">Enter clues (e.g., weak to rock, electric, second type is flying):</label>
            <input type="text" name="clues" id="clues" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
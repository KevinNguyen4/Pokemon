<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Higher or Lower Stats</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Pokémon Quiz - Higher or Lower Stats</h1>
        <form method="POST" action="{{ route('quiz.higherLower') }}">
            @csrf
            <label for="stat">Enter a stat (e.g., HP, Attack):</label>
            <input type="text" name="stat" id="stat" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
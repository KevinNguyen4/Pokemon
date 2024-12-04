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
        <form method="POST" action="{{ route('quiz.typing') }}">
            @csrf
            <label for="typing">Enter a typing (e.g., Fire/Rock):</label>
            <input type="text" name="typing" id="typing" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
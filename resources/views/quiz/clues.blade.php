<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Clues</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    @include('layouts.header')
    <div class="quizContainer">
        <h1>Pokémon Quiz - Clues</h1>
        <p>Guess the Pokémon based on the clues provided. You have 6 tries.</p>
        <ul id="clues-list">
            <li id="clue-moves"></li>
            <li id="clue-pokedex-number" style="display: none;"></li>
            <li id="clue-start-of-name" style="display: none;"></li>
            <li id="clue-weakness" style="display: none;"></li>
            <li id="clue-ability" style="display: none;"></li>
            <li id="clue-typing" style="display: none;"></li>
        </ul>
        <form id="guess-form">
            @csrf
            <label for="pokemon_name">Enter Pokémon name:</label>
            <input type="text" name="pokemon_name" id="pokemon_name" required>
            <button type="submit">Submit</button>
        </form>
        <button id="next-button" style="display: none;">Next</button>
        <p id="message" style="color: green;"></p>
        <p>Attempts: <span id="attempts">0</span> / 6</p>
    </div>

    <script>
        $(document).ready(function() {
            let attempts = 0;
            let clues = {
                'moves': '',
                'pokedex_number': '',
                'start_of_name': '',
                'typing': '',
                'ability': '',
                'weakness': ''
            };

            // Fetch a random Pokémon and initialize clues
            function fetchRandomPokemon() {
                $.ajax({
                    url: '{{ route("pokemon.getRandomPokemon") }}',
                    method: 'GET',
                    success: function(response) {
                        clues = response.clues;
                        $('#clue-moves').text(clues.moves);
                        $('#clue-pokedex-number').hide();
                        $('#clue-start-of-name').hide();
                        $('#clue-typing').hide();
                        $('#clue-ability').hide();
                        $('#clue-weakness').hide();
                        $('#attempts').text(0);
                        attempts = 0;
                        $('#message').text('');
                        $('#guess-form').show();
                        $('#next-button').hide();
                        $('#pokemon_name').val(''); // Clear the input box
                    }
                });
            }

            fetchRandomPokemon();

            $('#guess-form').on('submit', function(event) {
                event.preventDefault();
                const userGuess = $('#pokemon_name').val().trim().toLowerCase();

                $.ajax({
                    url: '{{ route("pokemon.checkGuess") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        pokemon_name: userGuess,
                        attempts: attempts
                    },
                    success: function(response) {
                        attempts++;
                        $('#attempts').text(attempts);

                        if (response.success) {
                            $('#message').text(response.message).css('color', 'green');
                            $('#guess-form').hide();
                            $('#next-button').show();
                        } else {
                            $('#message').text(response.message).css('color', 'red');
                            showNextClue(attempts);
                        }

                        if (attempts >= 6) {
                            $('#guess-form').hide();
                            $('#next-button').show();
                        }
                    }
                });
            });

            $('#next-button').on('click', function() {
                fetchRandomPokemon();
            });

            function showNextClue(attempts) {
                if (attempts == 1) {
                    $('#clue-pokedex-number').text(clues.pokedex_number).show();
                } else if (attempts == 2) {
                    $('#clue-start-of-name').text(clues.start_of_name).show();
                } else if (attempts == 3) {
                    $('#clue-weakness').text(clues.weakness).show();
                } else if (attempts == 4) {
                    $('#clue-ability').text(clues.ability).show();
                } else if (attempts == 5) {
                    $('#clue-typing').text(clues.typing).show();
                }
                $('#pokemon_name').val(''); 
            }
        });
    </script>
</body>
</html>
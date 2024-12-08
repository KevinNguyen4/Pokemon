<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Quiz - Name Pokémon</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
</head>

<body>
    @include('layouts.header')
    <div class="quizContainer">
        <h1>Pokémon Quiz - Name Original Pokémon</h1>
        <p>Name as many of the original 151 Pokémon as you can.</p>
        <input type="text" id="pokemonInput" placeholder="Enter Pokémon name">
        <button id="giveUpButton">Give Up</button>
        <div id="pokemonSlots">
            @for ($i = 1; $i <= 151; $i++)
                <div class="pokemon-slot" id="slot{{ $i }}">
                    <label for="pokemon{{ $i }}">{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</label>
                    <input type="text" id="pokemon{{ $i }}" name="pokemon[]" class="pokemon-input" disabled>
                </div>
            @endfor
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pokemonNames = [
                "Bulbasaur", "Ivysaur", "Venusaur", "Charmander", "Charmeleon", "Charizard",
                "Squirtle", "Wartortle", "Blastoise", "Caterpie", "Metapod", "Butterfree",
                "Weedle", "Kakuna", "Beedrill", "Pidgey", "Pidgeotto", "Pidgeot", "Rattata",
                "Raticate", "Spearow", "Fearow", "Ekans", "Arbok", "Pikachu", "Raichu",
                "Sandshrew", "Sandslash", "NidoranF", "Nidorina", "Nidoqueen", "NidoranM",
                "Nidorino", "Nidoking", "Clefairy", "Clefable", "Vulpix", "Ninetales",
                "Jigglypuff", "Wigglytuff", "Zubat", "Golbat", "Oddish", "Gloom", "Vileplume",
                "Paras", "Parasect", "Venonat", "Venomoth", "Diglett", "Dugtrio", "Meowth",
                "Persian", "Psyduck", "Golduck", "Mankey", "Primeape", "Growlithe", "Arcanine",
                "Poliwag", "Poliwhirl", "Poliwrath", "Abra", "Kadabra", "Alakazam", "Machop",
                "Machoke", "Machamp", "Bellsprout", "Weepinbell", "Victreebel", "Tentacool",
                "Tentacruel", "Geodude", "Graveler", "Golem", "Ponyta", "Rapidash", "Slowpoke",
                "Slowbro", "Magnemite", "Magneton", "Farfetch'd", "Doduo", "Dodrio", "Seel",
                "Dewgong", "Grimer", "Muk", "Shellder", "Cloyster", "Gastly", "Haunter",
                "Gengar", "Onix", "Drowzee", "Hypno", "Krabby", "Kingler", "Voltorb",
                "Electrode", "Exeggcute", "Exeggutor", "Cubone", "Marowak", "Hitmonlee",
                "Hitmonchan", "Lickitung", "Koffing", "Weezing", "Rhyhorn", "Rhydon",
                "Chansey", "Tangela", "Kangaskhan", "Horsea", "Seadra", "Goldeen", "Seaking",
                "Staryu", "Starmie", "Mr. Mime", "Scyther", "Jynx", "Electabuzz", "Magmar",
                "Pinsir", "Tauros", "Magikarp", "Gyarados", "Lapras", "Ditto", "Eevee",
                "Vaporeon", "Jolteon", "Flareon", "Porygon", "Omanyte", "Omastar", "Kabuto",
                "Kabutops", "Aerodactyl", "Snorlax", "Articuno", "Zapdos", "Moltres",
                "Dratini", "Dragonair", "Dragonite", "Mewtwo", "Mew"
            ];

            const input = document.getElementById('pokemonInput');
            const guessedPokemon = new Set();

            input.addEventListener('input', function () {
                const value = input.value.trim().toLowerCase();
                const index = pokemonNames.findIndex(name => name.toLowerCase() === value);
                if (index !== -1 && !guessedPokemon.has(value)) {
                    const slot = document.getElementById('slot' + (index + 1));
                    const slotInput = slot.querySelector('.pokemon-input');
                    slotInput.value = pokemonNames[index];
                    slotInput.classList.add('correct');
                    slotInput.disabled = true;
                    guessedPokemon.add(value);
                    input.value = '';

                    if (guessedPokemon.size === pokemonNames.length) {
                        confetti();
                    }
                }
            });

            document.getElementById('giveUpButton').addEventListener('click', function () {
                pokemonNames.forEach((name, index) => {
                    const slot = document.getElementById('slot' + (index + 1));
                    const slotInput = slot.querySelector('.pokemon-input');
                    if (!slotInput.classList.contains('correct')) {
                        slotInput.value = name;
                        slotInput.classList.add('revealed');
                    }
                });
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BATTLE SIM</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
</head>

<body>
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <h1>BATTLE SIM</h1>
        <div class="team-container">
            <h3>Your Team:</h3>
            <div class="team" id="team">
                <!-- Selected Pokémon will be displayed here -->
            </div>
            <button id="battle-button" class="battle-button" onclick="goToBattle()">Go Battle!</button>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="small-column">Name</th>
                        <th>Sprite</th>
                        <th>Type 1</th>
                        <th>Type 2</th>
                        <th>Ability 1</th>
                        <th>Ability 2</th>
                        <th>Hidden Ability</th>
                        <th class="small-column" onclick="sortTable('total')"><span>Total <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('hp')"><span>HP <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('attack')"><span>Atk <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('defense')"><span>Def <i class="fa-solid fa-sort"></i></span></th>
                        <th class="smaller-column" onclick="sortTable('sp_atk')"><span>Sp.Atk <i class="fa-solid fa-sort"></i></span></th>
                        <th class="smaller-column" onclick="sortTable('sp_def')"><span>Sp.Def <i class="fa-solid fa-sort"></i></span></th>
                        <th class="smaller-column" onclick="sortTable('speed')"><span>Speed <i class="fa-solid fa-sort"></i></span></th>
                    </tr>
                </thead>
                <tbody id="pokemon-table-body">
                    <!-- Pokémon rows will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pokemonNames = [
                "Bulbasaur", "Ivysaur", "Venusaur", "Charmander", "Charmeleon", "Charizard",
                "Squirtle", "Wartortle", "Blastoise", "Caterpie", "Metapod", "Butterfree",
                "Weedle", "Kakuna", "Beedrill", "Pidgey", "Pidgeotto", "Pidgeot", "Rattata",
                "Raticate", "Spearow", "Fearow", "Ekans", "Arbok", "Pikachu", "Raichu",
                "Sandshrew", "Sandslash", "Nidoran♀", "Nidorina", "Nidoqueen", "Nidoran♂",
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

            const pokemonTableBody = document.getElementById('pokemon-table-body');
            const teamContainer = document.getElementById('team');
            const battleButton = document.getElementById('battle-button');
            const selectedPokemon = new Set();

            // Dynamically create Pokémon table rows
            pokemonNames.forEach(name => {
                const tr = document.createElement('tr');
                const formattedName = name.toLowerCase().replace("♀", "f").replace("♂", "m").replace("'", "").replace(".", "").replace(" ", "-");
                const imgSrc = `https://img.pokemondb.net/sprites/home/normal/${formattedName}.png`;

                tr.innerHTML = `
                    <td class="small-column">${name}</td>
                    <td><img src="${imgSrc}" alt="${name}" class="sprite" onclick="selectPokemon('${name}', this)"></td>
                    <td class="type1"></td>
                    <td class="type2"></td>
                    <td class="ability1"></td>
                    <td class="ability2"></td>
                    <td class="hidden-ability"></td>
                    <td data-stat="total"></td>
                    <td data-stat="hp"></td>
                    <td data-stat="attack"></td>
                    <td data-stat="defense"></td>
                    <td data-stat="sp_atk"></td>
                    <td data-stat="sp_def"></td>
                    <td data-stat="speed"></td>
                `;

                fetch(`https://pokeapi.co/api/v2/pokemon/${formattedName}`)
                    .then(response => response.json())
                    .then(data => {
                        const types = data.types.map(typeInfo => typeInfo.type.name);
                        const abilities = data.abilities.map((abilityInfo, index) => {
                            const abilityName = abilityInfo.ability.name.charAt(0).toUpperCase() + abilityInfo.ability.name.slice(1);
                            if (abilityInfo.is_hidden) {
                                return { type: 'hidden', name: abilityName };
                            } else {
                                return { type: `ability${index + 1}`, name: abilityName };
                            }
                        });

                        const type1 = types[0] ? `<span class="type type-${types[0]}">${types[0].charAt(0).toUpperCase() + types[0].slice(1)}</span>` : '';
                        const type2 = types[1] ? `<span class="type type-${types[1]}">${types[1].charAt(0).toUpperCase() + types[1].slice(1)}</span>` : '';
                        tr.querySelector('.type1').innerHTML = type1;
                        tr.querySelector('.type2').innerHTML = type2;

                        abilities.forEach(ability => {
                            if (ability.type === 'hidden') {
                                tr.querySelector('.hidden-ability').textContent = ability.name;
                            } else {
                                tr.querySelector(`.${ability.type}`).textContent = ability.name;
                            }
                        });

                        tr.querySelector('[data-stat="total"]').textContent = data.stats.reduce((total, stat) => total + stat.base_stat, 0);
                        tr.querySelector('[data-stat="hp"]').textContent = data.stats[0].base_stat;
                        tr.querySelector('[data-stat="attack"]').textContent = data.stats[1].base_stat;
                        tr.querySelector('[data-stat="defense"]').textContent = data.stats[2].base_stat;
                        tr.querySelector('[data-stat="sp_atk"]').textContent = data.stats[3].base_stat;
                        tr.querySelector('[data-stat="sp_def"]').textContent = data.stats[4].base_stat;
                        tr.querySelector('[data-stat="speed"]').textContent = data.stats[5].base_stat;
                    });

                pokemonTableBody.appendChild(tr);
            });

            window.selectPokemon = function(name, img) {
                if (selectedPokemon.size < 6 && !selectedPokemon.has(name)) {
                    selectedPokemon.add(name);
                    img.classList.add('selected');
                    updateTeam();
                } else if (selectedPokemon.has(name)) {
                    selectedPokemon.delete(name);
                    img.classList.remove('selected');
                    updateTeam();
                }
            }

            function updateTeam() {
                teamContainer.innerHTML = '';
                selectedPokemon.forEach(name => {
                    const img = document.createElement('img');
                    const formattedName = name.toLowerCase().replace("♀", "f").replace("♂", "m").replace("'", "").replace(".", "").replace(" ", "-");
                    img.src = `https://img.pokemondb.net/sprites/home/normal/${formattedName}.png`;
                    img.alt = name;
                    img.onclick = () => {
                        selectedPokemon.delete(name);
                        updateTeam();
                        document.querySelector(`img[alt="${name}"]`).classList.remove('selected');
                    };
                    teamContainer.appendChild(img);
                });

                // Add placeholders for remaining slots
                for (let i = selectedPokemon.size; i < 6; i++) {
                    const placeholder = document.createElement('div');
                    placeholder.classList.add('placeholder');
                    placeholder.textContent = 'Empty';
                    teamContainer.appendChild(placeholder);
                }

                // Show or hide the "Go Battle!" button
                if (selectedPokemon.size === 6) {
                    battleButton.style.display = 'block';
                } else {
                    battleButton.style.display = 'none';
                }
            }

            // Initialize team with placeholders
            updateTeam();
        });

        function goToBattle() {
            // Store the selected Pokémon team in localStorage
            //localStorage.setItem('selectedPokemon', JSON.stringify(Array.from(selectedPokemon)));
            // Redirect to the battle page
            window.location.href = '<?php echo e(route('battle')); ?>';
            
        }
    </script>
</body>
</html><?php /**PATH C:\Users\KDN20\OneDrive\Documents\Pokemon\Pokemon\resources\views/battleSimulator.blade.php ENDPATH**/ ?>
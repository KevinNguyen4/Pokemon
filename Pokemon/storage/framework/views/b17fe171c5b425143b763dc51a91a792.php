<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
</head>

<body>
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <h1>Battle</h1>
        <div class="team-container">
            <div class="team" id="your-team">
                <h3>Your Team</h3>
                <!-- Your selected Pokémon will be displayed here -->
            </div>
            <div class="team" id="opponent-team">
                <h3>Opponent Team</h3>
                <!-- Opponent Pokémon will be displayed here -->
            </div>
        </div>
        <div class="battle-log" id="battle-log">
            <h3>Battle Log</h3>
            <!-- Battle log will be displayed here -->
        </div>
        <button onclick="startBattle()">Start Battle</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const yourTeam = JSON.parse(localStorage.getItem('selectedPokemon')) || [];
            const opponentTeam = [
                "Charizard", "Blastoise", "Venusaur", "Pikachu", "Gengar", "Dragonite"
            ];

            const yourTeamContainer = document.getElementById('your-team');
            const opponentTeamContainer = document.getElementById('opponent-team');
            const battleLog = document.getElementById('battle-log');

            function displayTeam(team, container) {
                team.forEach(name => {
                    const img = document.createElement('img');
                    const formattedName = name.toLowerCase().replace("♀", "f").replace("♂", "m").replace("'", "").replace(".", "").replace(" ", "-");
                    img.src = `https://img.pokemondb.net/sprites/home/normal/${formattedName}.png`;
                    img.alt = name;
                    container.appendChild(img);
                });
            }

            displayTeam(yourTeam, yourTeamContainer);
            displayTeam(opponentTeam, opponentTeamContainer);

            window.startBattle = function() {
                battleLog.innerHTML += '<p>The battle has started!</p>';
                // Add more battle logic here
            }
        });
    </script>
</body>
</html><?php /**PATH C:\Users\KDN20\OneDrive\Documents\Pokemon\Pokemon\resources\views/battle.blade.php ENDPATH**/ ?>
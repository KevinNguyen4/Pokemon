<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kevin's Pokémon Database</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
    <style>
        .sprite {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <h1>Pokémon Database</h1>
        <form method="GET" action="<?php echo e(route('pokemon.search')); ?>" class="search-form">
            <input type="text" name="query" placeholder="Search by name or number" value="<?php echo e(request('query')); ?>">
            <input type="text" name="type" placeholder="Search by type" value="<?php echo e(request('type')); ?>">
            <input type="text" name="ability" placeholder="Search by ability" value="<?php echo e(request('ability')); ?>">
            <button class="button" type="submit">Search</button>
            <a href="<?php echo e(route('pokemon.search')); ?>" class="button">Clear</a>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="smaller-column" onclick="sortTable('number')"><span>Num <i class="fa-solid fa-sort"></i></span></th>
                        <th class="small-column">Name</th>
                        <th>Sprite</th>
                        <th>Type 1</th>
                        <th>Type 2</th>
                        <th class="small-column" onclick="sortTable('total')"><span>Total <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('hp')"><span>HP <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('attack')"><span>Atk <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('defense')"><span>Def <i class="fa-solid fa-sort"></i></span></th>
                        <th class="smaller-column" onclick="sortTable('sp_atk')"><span>Sp.Atk <i class="fa-solid fa-sort"></i></span></th>
                        <th class="smaller-column" onclick="sortTable('sp_def')"><span>Sp.Def <i class="fa-solid fa-sort"></i></span></th>
                        <th class="smaller-column" onclick="sortTable('speed')"><span>Speed <i class="fa-solid fa-sort"></i></span></th>
                        <th>Weaknesses</th>
                        <th>Resistances</th>
                        <th>Immunities</th>
                    </tr>
                </thead>
                <tbody id="pokemon-table-body">
                    <?php
                    //SPECIAL NAMING CASES
                        $spriteMapping = [
                            'Tauros Combat Breed' => 'tauros-paldean-combat',
                            'Tauros Aqua Breed' => 'tauros-aqua',
                            'Tauros Blaze Breed' => 'tauros-blaze',
                            'Maushold Family of Four' => 'maushold',
                            'Maushold Family of Three' => 'maushold-family3',

                            'Eevee Partner Eevee' => 'eevee',
                            'Pikachu Partner Pikachu' => 'pikachu',
                            'Ogerpon Hearthflame Mask' => 'ogerpon-hearthflame',
                            'Ogerpon Teal Mask' => 'ogerpon-teal',
                            'Ogerpon Wellspring Mask' => 'ogerpon-wellspring',
                            'Ogerpon Cornerstone Mask' => 'ogerpon-cornerstone',
                            'Terapagos Normal Form' => 'terapagos-normal',
                            'Terapagos Terastal Form' => 'terapagos-terastal',
                            'Terapagos Stellar Form' => 'terapagos-stellar',
                            'Farfetch\'d' => 'farfetchd',
                            'Mr. Mime' => 'mr-mime',
                            'Nidoran♀' => 'nidoran-f',
                            'Nidoran♂' => 'nidoran-m',
                            'Flabébé' => 'flabebe',
                            'Type: Null' => 'type-null',
                            'Mime Jr.' => 'mime-jr',
                            'Porygon-Z' => 'porygon-z',
                            'Ho-oh' => 'ho-oh',
                            'Zygarde 50% Forme' => 'zygarde-50',
                            'Zygarde 10% Forme' => 'zygarde-10',
                            'Zygarde Complete Forme' => 'zygarde-complete',
                            'Deoxys Normal Forme' => 'deoxys-normal',
                            'Deoxys Attack Forme' => 'deoxys-attack',
                            'Deoxys Defense Forme' => 'deoxys-defense',
                            'Deoxys Speed Forme' => 'deoxys-speed',
                            'Giratina Altered Forme' => 'giratina-altered',
                            'Giratina Origin Forme' => 'giratina-origin',
                            'Shaymin Land Forme' => 'shaymin-land',
                            'Shaymin Sky Forme' => 'shaymin-sky',
                            'Basculin Red-Striped Form' => 'basculin-red-striped',
                            'Basculin Blue-Striped Form' => 'basculin-blue-striped',
                            'Darmanitan Standard Mode' => 'darmanitan-standard',
                            'Darmanitan Zen Mode' => 'darmanitan-zen',
                            'Tornadus Incarnate Forme' => 'tornadus-incarnate',
                            'Tornadus Therian Forme' => 'tornadus-therian',
                            'Thundurus Incarnate Forme' => 'thundurus-incarnate',
                            'Thundurus Therian Forme' => 'thundurus-therian',
                            'Landorus Incarnate Forme' => 'landorus-incarnate',
                            'Landorus Therian Forme' => 'landorus-therian',
                            'Kyurem Black Kyurem' => 'kyurem-black',
                            'Kyurem White Kyurem' => 'kyurem-white',
                            'Keldeo Ordinary Form' => 'keldeo-ordinary',
                            'Keldeo Resolute Form' => 'keldeo-resolute',
                            'Meloetta Aria Forme' => 'meloetta-aria',
                            'Meloetta Pirouette Forme' => 'meloetta-pirouette',
                            'Aegislash Shield Forme' => 'aegislash-shield',
                            'Aegislash Blade Forme' => 'aegislash-blade',
                            'Pumpkaboo Average Size' => 'pumpkaboo-average',
                            'Pumpkaboo Small Size' => 'pumpkaboo-small',
                            'Pumpkaboo Large Size' => 'pumpkaboo-large',
                            'Pumpkaboo Super Size' => 'pumpkaboo-super',
                            'Gourgeist Average Size' => 'gourgeist-average',
                            'Gourgeist Small Size' => 'gourgeist-small',
                            'Gourgeist Large Size' => 'gourgeist-large',
                            'Gourgeist Super Size' => 'gourgeist-super',
                            'Oricorio Baile Style' => 'oricorio-baile',
                            'Oricorio Pom-Pom Style' => 'oricorio-pom-pom',
                            'Oricorio Pa\'u Style' => 'oricorio-pau',
                            'Oricorio Sensu Style' => 'oricorio-sensu',
                            'Lycanroc Midday Form' => 'lycanroc-midday',
                            'Lycanroc Midnight Form' => 'lycanroc-midnight',
                            'Lycanroc Dusk Form' => 'lycanroc-dusk',
                            'Wishiwashi Solo Form' => 'wishiwashi-solo',
                            'Wishiwashi School Form' => 'wishiwashi-school',
                            'Minior Meteor Form' => 'minior-meteor',
                            'Minior Core Form' => 'minior-core',
                            'Mimikyu Disguised Form' => 'mimikyu-disguised',
                            'Mimikyu Busted Form' => 'mimikyu-busted',
                            'Necrozma Dusk Mane Necrozma' => 'necrozma-dusk-mane',
                            'Necrozma Dawn Wings Necrozma' => 'necrozma-dawn-wings',
                            'Necrozma Ultra Necrozma' => 'necrozma-ultra', 
                            'Magearna Original Color' => 'magearna-original',
                            'Cramorant Gulping Form' => 'cramorant-gulping',
                            'Cramorant Gorging Form' => 'cramorant-gorging',
                            'Toxtricity Amped Form' => 'toxtricity-amped',
                            'Toxtricity Low Key Form' => 'toxtricity-low-key',
                            'Eiscue Ice Face' => 'eiscue-ice',
                            'Eiscue Noice Face' => 'eiscue-noice',
                            'Indeedee Male' => 'indeedee-male',
                            'Indeedee Female' => 'indeedee-female',
                            'Morpeko Full Belly Mode' => 'morpeko-full-belly',
                            'Morpeko Hangry Mode' => 'morpeko-hangry',
                            'Zacian Hero of Many Battles' => 'zacian-hero',
                            'Zacian Crowned Sword' => 'zacian-crowned',
                            'Zamazenta Hero of Many Battles' => 'zamazenta-hero',
                            'Zamazenta Crowned Shield' => 'zamazenta-crowned',
                            'Urshifu Single Strike Style' => 'urshifu-single-strike',
                            'Urshifu Rapid Strike Style' => 'urshifu-rapid-strike',

                            'Castform Sunny Form' => 'castform-sunny',
                            'Castform Rainy Form' => 'castform-rainy',
                            'Castform Snowy Form' => 'castform-snowy',
                            'Kyogre Primal Kyogre' => 'kyogre-primal',
                            'Groudon Primal Groudon' => 'groudon-primal',
                            'Burmy Plant Cloak' => 'burmy-plant',
                            'Burmy Sandy Cloak' => 'burmy-sandy',
                            'Burmy Trash Cloak' => 'burmy-trash',
                            'Wormadam Plant Cloak' => 'wormadam-plant',
                            'Wormadam Sandy Cloak' => 'wormadam-sandy',
                            'Wormadam Trash Cloak' => 'wormadam-trash',
                            'Rotom Heat Rotom' => 'rotom-heat',
                            'Rotom Wash Rotom' => 'rotom-wash',
                            'Rotom Frost Rotom' => 'rotom-frost',
                            'Rotom Fan Rotom' => 'rotom-fan',
                            'Rotom Mow Rotom' => 'rotom-mow',
                            'Dialga Origin Forme' => 'dialga-origin',
                            'Palkia Origin Forme' => 'palkia-origin',
                            'Basculin White-Striped Form' => 'basculin-white-striped',
                            'Greninja Ash-Greninja' => 'greninja-ash',
                            'Hoopa Hoopa Confined' => 'hoopa-confined',
                            'Hoopa Hoopa Unbound' => 'hoopa-unbound',
                            'Rockruff Own Tempo Rockruff' => 'rockruff-own-tempo',
                            'Squawkabilly Green Plumage' => 'squawkabilly-green',
                            'Squawkabilly Blue Plumage' => 'squawkabilly-blue',
                            'Squawkabilly Yellow Plumage' => 'squawkabilly-yellow',
                            'Squawkabilly White Plumage' => 'squawkabilly-white',
                            'Palafin Zero Form' => 'palafin-zero',
                            'Palafin Hero Form' => 'palafin-hero',
                            'Tatsugiri Curly Form' => 'tatsugiri-curly',
                            'Tatsugiri Droopy Form' => 'tatsugiri-droopy',
                            'Tatsugiri Stretchy Form' => 'tatsugiri-stretchy',
                            'Dudunsparce Two-Segment Form' => 'dudunsparce-two-segment',
                            'Dudunsparce Three-Segment Form' => 'dudunsparce-three-segment',
                            'Gimmighoul Chest Form' => 'gimmighoul-chest',
                            'Gimmighoul Roaming Form' => 'gimmighoul-roaming',

                            //megas
                            'Venusaur Mega Venusaur' => 'venusaur-mega',
                            'Charizard Mega Charizard X' => 'charizard-mega-x',
                            'Charizard Mega Charizard Y' => 'charizard-mega-y',
                            'Blastoise Mega Blastoise' => 'blastoise-mega',
                            'Beedrill Mega Beedrill' => 'beedrill-mega',
                            'Pidgeot Mega Pidgeot' => 'pidgeot-mega',
                            'Alakazam Mega Alakazam' => 'alakazam-mega',
                            'Slowbro Mega Slowbro' => 'slowbro-mega',
                            'Gengar Mega Gengar' => 'gengar-mega',
                            'Kangaskhan Mega Kangaskhan' => 'kangaskhan-mega',
                            'Pinsir Mega Pinsir' => 'pinsir-mega',
                            'Gyarados Mega Gyarados' => 'gyarados-mega',
                            'Aerodactyl Mega Aerodactyl' => 'aerodactyl-mega',
                            'Mewtwo Mega Mewtwo X' => 'mewtwo-mega-x',
                            'Mewtwo Mega Mewtwo Y' => 'mewtwo-mega-y',
                            'Ampharos Mega Ampharos' => 'ampharos-mega',
                            'Steelix Mega Steelix' => 'steelix-mega',
                            'Scizor Mega Scizor' => 'scizor-mega',
                            'Heracross Mega Heracross' => 'heracross-mega',
                            'Houndoom Mega Houndoom' => 'houndoom-mega',
                            'Tyranitar Mega Tyranitar' => 'tyranitar-mega',
                            'Sceptile Mega Sceptile' => 'sceptile-mega',
                            'Blaziken Mega Blaziken' => 'blaziken-mega',
                            'Swampert Mega Swampert' => 'swampert-mega',
                            'Gardevoir Mega Gardevoir' => 'gardevoir-mega',
                            'Sableye Mega Sableye' => 'sableye-mega',
                            'Mawile Mega Mawile' => 'mawile-mega',
                            'Aggron Mega Aggron' => 'aggron-mega',
                            'Medicham Mega Medicham' => 'medicham-mega',
                            'Manectric Mega Manectric' => 'manectric-mega',
                            'Sharpedo Mega Sharpedo' => 'sharpedo-mega',
                            'Camerupt Mega Camerupt' => 'camerupt-mega',
                            'Altaria Mega Altaria' => 'altaria-mega',
                            'Banette Mega Banette' => 'banette-mega',
                            'Absol Mega Absol' => 'absol-mega',
                            'Glalie Mega Glalie' => 'glalie-mega',
                            'Salamence Mega Salamence' => 'salamence-mega',
                            'Metagross Mega Metagross' => 'metagross-mega',
                            'Latias Mega Latias' => 'latias-mega',
                            'Latios Mega Latios' => 'latios-mega',
                            'Rayquaza Mega Rayquaza' => 'rayquaza-mega',
                            'Lopunny Mega Lopunny' => 'lopunny-mega',
                            'Garchomp Mega Garchomp' => 'garchomp-mega',
                            'Lucario Mega Lucario' => 'lucario-mega',
                            'Abomasnow Mega Abomasnow' => 'abomasnow-mega',
                            'Gallade Mega Gallade' => 'gallade-mega',
                            'Audino Mega Audino' => 'audino-mega',
                            'Diancie Mega Diancie' => 'diancie-mega',

                            //Alolan and Galarian hisui forms
                            'Rattata Alolan Rattata' => 'rattata-alolan',
                            'Raticate Alolan Raticate' => 'raticate-alolan',
                            'Raichu Alolan Raichu' => 'raichu-alolan',
                            'Sandshrew Alolan Sandshrew' => 'sandshrew-alolan',
                            'Sandslash Alolan Sandslash' => 'sandslash-alolan',
                            'Vulpix Alolan Vulpix' => 'vulpix-alolan',
                            'Ninetales Alolan Ninetales' => 'ninetales-alolan',
                            'Diglett Alolan Diglett' => 'diglett-alolan',
                            'Dugtrio Alolan Dugtrio' => 'dugtrio-alolan',
                            'Meowth Alolan Meowth' => 'meowth-alolan',
                            'Persian Alolan Persian' => 'persian-alolan',
                            'Geodude Alolan Geodude' => 'geodude-alolan',
                            'Graveler Alolan Graveler' => 'graveler-alolan',
                            'Golem Alolan Golem' => 'golem-alolan',
                            'Grimer Alolan Grimer' => 'grimer-alolan',
                            'Muk Alolan Muk' => 'muk-alolan',
                            'Exeggutor Alolan Exeggutor' => 'exeggutor-alolan',
                            'Marowak Alolan Marowak' => 'marowak-alolan',
                            'Meowth Galarian Meowth' => 'meowth-galarian',
                            'Ponyta Galarian Ponyta' => 'ponyta-galarian',
                            'Rapidash Galarian Rapidash' => 'rapidash-galarian',
                            'Slowpoke Galarian Slowpoke' => 'slowpoke-galarian',
                            'Slowbro Galarian Slowbro' => 'slowbro-galarian',
                            'Farfetch\'d Galarian Farfetch\'d' => 'farfetchd-galarian',
                            'Weezing Galarian Weezing' => 'weezing-galarian',
                            'Mr. Mime Galarian Mr. Mime' => 'mr-mime-galarian',
                            'Articuno Galarian Articuno' => 'articuno-galarian',
                            'Zapdos Galarian Zapdos' => 'zapdos-galarian',
                            'Moltres Galarian Moltres' => 'moltres-galarian',
                            'Slowking Galarian Slowking' => 'slowking-galarian',
                            'Corsola Galarian Corsola' => 'corsola-galarian',
                            'Zigzagoon Galarian Zigzagoon' => 'zigzagoon-galarian',
                            'Linoone Galarian Linoone' => 'linoone-galarian',
                            'Darumaka Galarian Darumaka' => 'darumaka-galarian',
                            'Darmanitan Galarian Darmanitan' => 'darmanitan-galarian',
                            'Yamask Galarian Yamask' => 'yamask-galarian',
                            'Stunfisk Galarian Stunfisk' => 'stunfisk-galarian',
                            'Darmanitan Galarian Standard Mode' => 'darmanitan-galarian-standard',
                            'Darmanitan Galarian Zen Mode' => 'darmanitan-galarian-zen',
                            'Growlithe Hisuian Growlithe' => 'growlithe-hisuian',
                            'Arcanine Hisuian Arcanine' => 'arcanine-hisuian',
                            'Voltorb Hisuian Voltorb' => 'voltorb-hisuian',
                            'Electrode Hisuian Electrode' => 'electrode-hisuian',
                            'Typhlosion Hisuian Typhlosion' => 'typhlosion-hisuian',
                            'Qwilfish Hisuian Qwilfish' => 'qwilfish-hisuian',
                            'Sneasel Hisuian Sneasel' => 'sneasel-hisuian',
                            'Samurott Hisuian Samurott' => 'samurott-hisuian',
                            'Lilligant Hisuian Lilligant' => 'lilligant-hisuian',
                            'Zorua Hisuian Zorua' => 'zorua-hisuian',
                            'Zoroark Hisuian Zoroark' => 'zoroark-hisuian',
                            'Braviary Hisuian Braviary' => 'braviary-hisuian',
                            'Sliggoo Hisuian Sliggoo' => 'sliggoo-hisuian',
                            'Goodra Hisuian Goodra' => 'goodra-hisuian',
                            'Avalugg Hisuian Avalugg' => 'avalugg-hisuian',
                            'Decidueye Hisuian Decidueye' => 'decidueye-hisuian',
                            'Wooper Paldean Wooper' => 'wooper-paldean',
                            'Enamorus Incarnate Forme' => 'enamorus-incarnate',
                            'Enamorus Therian Forme' => 'enamorus-therian'
                        ];
                    ?>
                    <?php $__currentLoopData = $pokemons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pokemon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $formattedName = strtolower(str_replace(['♀', '♂', ' ', '.', "'"], ['f', 'm', '-', '', ''], $pokemon->name));
                            if (array_key_exists($pokemon->name, $spriteMapping)) {
                                $formattedName = $spriteMapping[$pokemon->name];
                            }
                        ?>
                        <tr class="border-b">
                            <td class="smaller-column" data-stat="number"><?php echo e(ltrim($pokemon->number, '0')); ?></td>
                            <td class="small-column"><a href="<?php echo e(route('pokemon.show', $pokemon->name)); ?>" style="color: inherit; text-decoration: none;"><?php echo e($pokemon->name); ?></a></td>
                            <td><img src="https://img.pokemondb.net/sprites/home/normal/<?php echo e($formattedName); ?>.png" alt="<?php echo e($pokemon->name); ?>" class="sprite"></td>
                            <td class="type1"><?php echo e($pokemon->type1); ?></td>
                            <td class="type2"><?php echo e($pokemon->type2); ?></td>
                            <td data-stat="total"><?php echo e($pokemon->total); ?></td>
                            <td data-stat="hp"><?php echo e($pokemon->hp); ?></td>
                            <td data-stat="attack"><?php echo e($pokemon->attack); ?></td>
                            <td data-stat="defense"><?php echo e($pokemon->defense); ?></td>
                            <td data-stat="sp_atk"><?php echo e($pokemon->sp_atk); ?></td>
                            <td data-stat="sp_def"><?php echo e($pokemon->sp_def); ?></td>
                            <td data-stat="speed"><?php echo e($pokemon->speed); ?></td>
                            <td class="weaknesses"><?php echo e(implode(' ', json_decode($pokemon->weaknesses, true))); ?></td>
                            <td class="resistances"><?php echo e(implode(' ', json_decode($pokemon->resistances, true))); ?></td>
                            <td class="immunities"><?php echo e(implode(' ', json_decode($pokemon->immunities, true))); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
</body>
</html><?php /**PATH C:\Users\KDN20\OneDrive\Documents\Pokemon\Pokemon\resources\views/welcome.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kevin's Pokémon Database</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <div class="container">
        <h1>Pokémon Database</h1>
        <form method="GET" action="{{ route('pokemon.search') }}" class="search-form">
            <input type="text" name="query" placeholder="Search by name or number" value="{{ request('query') }}">
            <input type="text" name="type" placeholder="Search by type" value="{{ request('type') }}">
            <input type="text" name="ability" placeholder="Search by ability" value="{{ request('ability') }}">
            <button class="button" type="submit">Search</button>
            <button href="{{ route('pokemon.search') }}" class="button">Clear</button>
        </form>
        

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="smaller-column" onclick="sortTable('number')"><span>Num <i class="fa-solid fa-sort"></i></span></th>
                        <th class="small-column">Name</th>
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
                    @foreach($pokemons as $pokemon)
                        <tr class="border-b">
                            <td class="smaller-column" data-stat="number">{{ ltrim($pokemon->number, '0') }}</td>
                            <td class="small-column"><a href="{{ route('pokemon.show', $pokemon->name) }}" style="color: inherit; text-decoration: none;">{{ $pokemon->name }}</a></td>
                            <td class="type1">{{ $pokemon->type1 }}</td>
                            <td class="type2">{{ $pokemon->type2 }}</td>
                            <td data-stat="total">{{ $pokemon->total }}</td>
                            <td data-stat="hp">{{ $pokemon->hp }}</td>
                            <td data-stat="attack">{{ $pokemon->attack }}</td>
                            <td data-stat="defense">{{ $pokemon->defense }}</td>
                            <td data-stat="sp_atk">{{ $pokemon->sp_atk }}</td>
                            <td data-stat="sp_def">{{ $pokemon->sp_def }}</td>
                            <td data-stat="speed">{{ $pokemon->speed }}</td>
                            <td class="weaknesses">{{ implode(' ', json_decode($pokemon->weaknesses, true)) }}</td>
                            <td class="resistances">{{ implode(' ', json_decode($pokemon->resistances, true)) }}</td>
                            <td class="immunities">{{ implode(' ', json_decode($pokemon->immunities, true)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
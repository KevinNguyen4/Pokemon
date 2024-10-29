<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kevin's Pokémon Database</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h1>Pokémon Database</h1>
        <form method="GET" action="{{ route('pokemon.search') }}" class="search-form">
            <input type="text" name="query" placeholder="Search by name or number" value="{{ request('query') }}">
            <button type="submit">Search</button>
            <a href="{{ route('pokemon.search') }}" class="button">Clear</a>
        </form>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th onclick="sortTable('number')"><span>Number <i class="fa-solid fa-sort"></i></span></th>
                        <th>Name</th>
                        <th>Type 1</th>
                        <th>Type 2</th>
                        <th onclick="sortTable('total')"><span>Total <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('hp')"><span>HP <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('attack')"><span>Attack <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('defense')"><span>Defense <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('sp_atk')"><span>Sp.&nbsp;Atk <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('sp_def')"><span>Sp.&nbsp;Def <i class="fa-solid fa-sort"></i></span></th>
                        <th onclick="sortTable('speed')"><span>Speed <i class="fa-solid fa-sort"></i></span></th>
                    </tr>
                </thead>
                <tbody id="pokemon-table-body">
                    @foreach($pokemons as $pokemon)
                        <tr class="border-b">
                            <td data-stat="number">{{ ltrim($pokemon->number, '0') }}</td>
                            <td>{{ $pokemon->name }}</td>
                            <td class="type1">{{ $pokemon->type1 }}</td>
                            <td class="type2">{{ $pokemon->type2 }}</td>
                            <td data-stat="total">{{ $pokemon->total }}</td>
                            <td data-stat="hp">{{ $pokemon->hp }}</td>
                            <td data-stat="attack">{{ $pokemon->attack }}</td>
                            <td data-stat="defense">{{ $pokemon->defense }}</td>
                            <td data-stat="sp_atk">{{ $pokemon->sp_atk }}</td>
                            <td data-stat="sp_def">{{ $pokemon->sp_def }}</td>
                            <td data-stat="speed">{{ $pokemon->speed }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
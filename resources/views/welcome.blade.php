<!-- 
The CSS for this one is public/css/app.css
The JS is public/js/custom.js
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Database</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Pokémon Database</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Type 1</th>
                        <th>Type 2</th>
                        <th>Total</th>
                        <th>HP</th>
                        <th>Attack</th>
                        <th>Defense</th>
                        <th>Sp. Atk</th>
                        <th>Sp. Def</th>
                        <th>Speed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pokemons as $pokemon)
                        <tr class="border-b">
                            <td>{{ $pokemon->number }}</td>
                            <td>{{ $pokemon->name }}</td>
                            <td class="type1">{{ $pokemon->type1 }}</td>
                            <td class="type2">{{ $pokemon->type2 }}</td>
                            <td>{{ $pokemon->total }}</td>
                            <td>{{ $pokemon->hp }}</td>
                            <td>{{ $pokemon->attack }}</td>
                            <td>{{ $pokemon->defense }}</td>
                            <td>{{ $pokemon->sp_atk }}</td>
                            <td>{{ $pokemon->sp_def }}</td>
                            <td>{{ $pokemon->speed }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pokemon->name }} Details</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>{{ $pokemon->name }} Details</h1>
        <table>
            <tr>
                <th>Number</th>
                <td>{{ $pokemon->number }}</td>
            </tr>
            <tr>
                <th>Type 1</th>
                <td>{{ $pokemon->type1 }}</td>
            </tr>
            <tr>
                <th>Type 2</th>
                <td>{{ $pokemon->type2 }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ $pokemon->total }}</td>
            </tr>
            <tr>
                <th>HP</th>
                <td>{{ $pokemon->hp }}</td>
            </tr>
            <tr>
                <th>Attack</th>
                <td>{{ $pokemon->attack }}</td>
            </tr>
            <tr>
                <th>Defense</th>
                <td>{{ $pokemon->defense }}</td>
            </tr>
            <tr>
                <th>Sp. Atk</th>
                <td>{{ $pokemon->sp_atk }}</td>
            </tr>
            <tr>
                <th>Sp. Def</th>
                <td>{{ $pokemon->sp_def }}</td>
            </tr>
            <tr>
                <th>Speed</th>
                <td>{{ $pokemon->speed }}</td>
            </tr>
            <tr>
                <th>Weaknesses</th>
                <td>{{ implode(', ', json_decode($pokemon->weaknesses, true)) }}</td>
            </tr>
            <tr>
                <th>Resistances</th>
                <td>{{ implode(', ', json_decode($pokemon->resistances, true)) }}</td>
            </tr>
            <tr>
                <th>Immunities</th>
                <td>{{ implode(', ', json_decode($pokemon->immunities, true)) }}</td>
            </tr>
        </table>
        <br>
        <a href="{{ route('pokemon.search') }}" class="button">Back to List</a>
    </div>
</body>
</html>
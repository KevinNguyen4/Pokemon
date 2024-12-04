<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pokemon->name }} Details</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    @include('layouts.header')
    <div class="container">
        <h1>{{ $pokemon->name }} Details</h1>
        <table>
            <tr>
                <th>Number</th>
                <td>{{ $pokemon->number }}</td>
            </tr>
            <tr>
                <th>Type 1</th>
                <td class="type1">{{ $pokemon->type1 }}</td>
            </tr>
            <tr>
                <th>Type 2</th>
                <td class="type2">{{ $pokemon->type2 }}</td>
            </tr>
            <tr>
                <th>Ability 1</th>
                <td>{{ $pokemon->ability1 }}</td>
            </tr>
            <tr>
                <th>Ability 2</th>
                <td>{{ $pokemon->ability2 }}</td>
            </tr>
            <tr>
                <th>Hidden Ability</th>
                <td>{{ $pokemon->hiddenAbility }}</td>
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
                <td class="weaknesses">{{ implode(' ', json_decode($pokemon->weaknesses, true)) }}</td>
            </tr>
            <tr>
                <th>Resistances</th>
                <td class="resistances">{{ implode(' ', json_decode($pokemon->resistances, true)) }}</td>
            </tr>
            <tr>
                <th>Immunities</th>
                <td class="immunities">{{ implode(' ', json_decode($pokemon->immunities, true)) }}</td>
            </tr>
            <tr>
                <th>Common Moves</th>
                    <td>
                        @if (!empty($pokemon->moves))
                            {{ implode(', ', json_decode($pokemon->moves, true)) }}
                        @else
                            <!-- Return blank if moves are empty -->
                        @endif
                    </td>
            </tr>
            <tr>
                <th>Common Items</th>
                <td>
                    @if (!empty($pokemon->items))
                        {{ implode(', ', json_decode($pokemon->items, true)) }}
                    @else
                        <!-- Return blank if items are empty -->
                    @endif
                </td>
            </tr>
            <tr>
                <th>Common Ability</th>
                <td>{{ $pokemon->popular_ability }}</td>
            </tr>
        </table>
        <br>
        <a href="{{ route('pokemon.search') }}" class="button">Back to List</a>
    </div>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
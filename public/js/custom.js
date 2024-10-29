// public/js/custom.js

document.addEventListener('DOMContentLoaded', function() {
    const typeCells = document.querySelectorAll('td.type1, td.type2');
    typeCells.forEach(cell => {
        const type = cell.textContent.trim().toLowerCase();
        cell.style.backgroundColor = getTypeColor(type);
    });
});

function getTypeColor(type) {
    switch (type) {
        case 'normal':
            return '#A8A77A';
        case 'fire':
            return '#EE8130';
        case 'water':
            return '#6390F0';
        case 'electric':
            return '#F7D02C';
        case 'grass':
            return '#7AC74C';
        case 'ice':
            return '#96D9D6';
        case 'fighting':
            return '#C22E28';
        case 'poison':
            return '#A33EA1';
        case 'ground':
            return '#E2BF65';
        case 'flying':
            return '#A98FF3';
        case 'psychic':
            return '#F95587';
        case 'bug':
            return '#A6B91A';
        case 'rock':
            return '#B6A136';
        case 'ghost':
            return '#735797';
        case 'dragon':
            return '#6F35FC';
        case 'dark':
            return '#705746';
        case 'steel':
            return '#B7B7CE';
        case 'fairy':
            return '#D685AD';
        default:
            return 'transparent'; // Default background
    }
}

let currentSort = {
    stat: '',
    order: 'desc'
};

function sortTable(stat) {
    const tableBody = document.getElementById('pokemon-table-body');
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    if (currentSort.stat === stat) {
        currentSort.order = currentSort.order === 'asc' ? 'desc' : 'asc';
    } else {
        currentSort.stat = stat;
        currentSort.order = 'desc';
    }

    rows.sort((a, b) => {
        const aStat = parseInt(a.querySelector(`td[data-stat="${stat}"]`).textContent);
        const bStat = parseInt(b.querySelector(`td[data-stat="${stat}"]`).textContent);
        return currentSort.order === 'asc' ? aStat - bStat : bStat - aStat;
    });

    // Append sorted rows back to the table body
    rows.forEach(row => tableBody.appendChild(row));
}
// public/js/custom.js

document.addEventListener('DOMContentLoaded', function() {
    const typeCells = document.querySelectorAll('td.grass');
    typeCells.forEach(cell => {
        cell.style.backgroundColor = '#d4edda'; // Light green background
    });
});
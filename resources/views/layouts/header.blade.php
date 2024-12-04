<div class="header">
    <div class="header-content">
        <h1><a href="{{ route('pokemon.search') }}">Kevin's Pokémon Database</a></h1>
        <nav>
            <a href="{{ route('pokemon.search') }}" class="button">Home</a>
            <a href="{{ route('quiz') }}" class="button">Pokémon Quiz</a>
            <a href="{{ route('aboutme') }}" class="button">About Me</a>
        </nav>
    </div>
</div>
<style>
    .header {
        background-color: #2E6F40;
        color: white;
        padding: 10px 0;
    }
    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .header h1 {
        margin: 0;
        font-size: 24px;
    }
    .header h1 a {
        color: white;
        text-decoration: none;
    }
    .header nav {
        display: flex;
        gap: 15px;
    }
    .header .button {
        border-radius: 10px;
        background-color: #2E6F40;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }
    .header .button:hover {
        background-color: #24532D;
    }
</style>
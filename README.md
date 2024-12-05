# Pokemon

This is a Kevin Nguyen Pokemon Database

Sources(data scraped from these sites):
https://pokemondb.net/pokedex/all  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_Ability  
https://www.pikalytics.com/pokedex/gen9vgc2024regh  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number#Generation_I  



To Do List

General

    2-TO ALL PAGES: make it look pretty! put some artwork or pictures or designs on the sides

Backend

    1-maybe make a command to just update the VGC data because everything else doesn't really change
    2-scrape pikalytics doesn't work for different forms(rotom-wash/lilligant-hisui)(and ditto moves are funky)

Database Page

    1-filter for stats(needs a little work)(sorting by number makes it wacky)
    2-think about lazy loading for my page?
    3-make heading for database(atk, def) sticky so u can see when scrolling down

Show/detail Page

    1-get pictures for each pokemon on their personal links
    2-graph/plot to visualize stats on pokemons personal page(with colors)
    3-look into spacing for the pokemon-details page, they should prob be all spaced same so there is room for graphs on the other side(chanseys and lickitung and persian page has weird spacing)

Quiz Page

    1-make the page look nicer somehow
    2-implement the logic for the games

About Page








scrape the table again: php artisan scrape:pokemon-table
start server: go to \Documents\Pokemon\Pokemon then php artisan serve
Drop table from mysql workbench, run create table query, then scrape again
To change what VGC format from pikalytics to get, go to scrapePokemonMoves() and change baseURL

Other projects:
League of legends extension?
Google chrome extension
card game, turn based game with health, attack, some effects, items, kinda like hearthstone
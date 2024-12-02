# Pokemon

This is a Kevin Nguyen Pokemon Database

Sources:
https://pokemondb.net/pokedex/all  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_Ability  
https://www.pikalytics.com/pokedex/gen9vgc2024regh  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number#Generation_I  



To Do List

General

    14-make a header/footer? something to practice applying those and making a nice one
    15-make buttons/header for main database page, quiz page, and about page
    18-make it look pretty! put some artwork or pictures on the sides

Backend

    12-maybe make a command to just update the VGC data because everything else doesn't really change
    13-scrape pikalytics doesn't work for different forms(rotom-wash/lilligant-hisui)(and ditto moves are funky)

Database Page

    5-filter for stats(needs a little work)(sorting by number makes it wacky)
    6-Search and Clear buttons font size are a little different?
    7-filters for typing, stats? weaknesses/resistances, to search up by(like an advanced search)
    11-think about lazy loading for my page?
    17-make heading for database(atk, def) sticky so u can see when scrolling down

Show/detail Page

    9-get pictures for each pokemon on their personal links
    10-graph/plot to visualize stats on pokemons personal page(with colors)
    16-look into spacing for the pokemon-details page, they should prob be all spaced same so there is room for graphs on the other side(chanseys and lickitung and persian page has weird spacing)

Quiz Page

    8-Make a fun little game, perhaps guessing base stats or typing or something like pokedoku who has this ability or something based off the stuff in the table
        (guess how many ghost types there are, how many pokemon with higher than 600 Base stats, or whatever)

About Page

    19-i guess just all the things that i've listed on the page 







scrape the table again: php artisan scrape:pokemon-table
start server: go to \Documents\Pokemon\Pokemon then php artisan serve
Drop table from mysql workbench, run create table query, then scrape again
To change what VGC format from pikalytics to get, go to scrapePokemonMoves() and change baseURL

Other projects:
League of legends extension?
Google chrome extension
card game, turn based game with health, attack, some effects, items, kinda like hearthston


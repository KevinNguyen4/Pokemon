# Pokemon

This is a Kevin Nguyen Pokemon Database

Sources(data scraped from these sites):
https://pokemondb.net/pokedex/all  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_Ability  
https://www.pikalytics.com/pokedex/gen9vgc2024regh  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number#Generation_I  



To Do List

General

    1-make buttons/header for main database page, quiz page, and about page
    2-make it look pretty! put some artwork or pictures or designs on the sides
    3-some type of framing for the stuff so it's not just text on a background

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

    1-i guess just all the things that i've listed on the page 
    2-put a censored resume in public directory named resume_Kevin_Nguyen.pdf
    4-email button not working
    5-make the resume viewable in browser
    6-see general point 3, gotta spruce it up a bit






scrape the table again: php artisan scrape:pokemon-table
start server: go to \Documents\Pokemon\Pokemon then php artisan serve
Drop table from mysql workbench, run create table query, then scrape again
To change what VGC format from pikalytics to get, go to scrapePokemonMoves() and change baseURL

Other projects:
League of legends extension?
Google chrome extension
card game, turn based game with health, attack, some effects, items, kinda like hearthstone
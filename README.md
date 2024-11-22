# Pokemon

This is a Kevin Nguyen Pokemon Database


https://pokemondb.net/pokedex/all  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_Ability  
https://www.pikalytics.com/pokedex/gen9vgc2024regh  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number#Generation_I  



To Do List  
X
X
3-See how to update it instead of dropping and redoing it each time lol(i think using pokemon([update]) would work, like how we do with weaknesses)
X
5-filter for stats(needs a little work)(sorting by number makes it wacky)
6-Search and Clear buttons font size are a little different?
7-filters for typing, stats? weaknesses/resistances, to search up by(like an advanced search)
8-Make a fun little game, perhaps guessing base stats or typing or something like pokedoku who has this ability or something based off the stuff in the table
    (guess how many ghost types there are, how many pokemon with higher than 600 Base stats, or whatever)
9-get pictures for each pokemon on their personal links
10-graph/plot to visualize stats on pokemons personal page(with colors)
11-think about lazy loading for my page?
12-maybe make a command to just update the VGC data because everything else doesn't really change
13-scrape pikalytics doesn't work for different forms(rotom-wash/lilligant-hisui)(and ditto moves are funky)








scrape the table again: php artisan scrape:pokemon-table
start server: go to \Documents\Pokemon\Pokemon then php artisan serve
Drop table from mysql workbench, run create table query, then scrape again
To change what format from pikalytics to get, go to scrapePokemonMoves() and change baseURL

Other projects:
League of legends extension?
Google chrome extension
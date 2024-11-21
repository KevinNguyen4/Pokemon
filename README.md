# Pokemon

This is a Kevin Nguyen Pokemon Database


https://pokemondb.net/pokedex/all  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_Ability  
https://www.pikalytics.com/pokedex/gen9vgc2024regh  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number#Generation_I  



To Do List  
1-See how to match up pokemon from different sites
    -names might be a little weird
    -primary keys for number/name?
2-Scrape Pikalytics for moves/items each format->Put in DB for the ones you find, but don't replace(some aren't in national dex for gen 9)   
    which also gets u the most recent data  
3-See how to update it instead of dropping and redoing it each time lol
4-add logic for resistances/immunities/weaknesses based on ability
5-filter for stats(needs a little work)(sorting by number makes it wacky)
6-Search and Clear buttons font size are a little different?
7-filters for typing, stats? weaknesses/resistances, to search up by(like an advanced search)
8-Make a fun little game, perhaps guessing base stats or typing or something like pokedoku who has this ability or something based off the stuff in the table
    (guess how many ghost types there are, how many pokemon with higher than 600 Base stats, or whatever)
9-get pictures for each pokemon on their personal links
10-graph/plot to visualize stats on pokemons personal page(with colors)










scrape the table again: php artisan scrape:pokemon-table
start server: go to \Documents\Pokemon\Pokemon then php artisan serve
Drop table from mysql workbench, run create table query, then scrape again

Other projects:
League of legends extension?
Google chrome extension
# Pokemon

This is a Kevin Nguyen Pokemon Database

Base stats for all pokemon  
Abilities(base/hidden)
Perhaps some queries/metrics(how many ghost type pokemon are there)  
Common Moves for each pokemon  
Common Held Items  
EV Spread/Team Mates?  
If legendary/mythical/paradox/NFE/other classifications(starter, fossil, psuedo-leg?, )  
What generation?  
Weaknesses/Resistances/Type Matchups(can make logic thing for this, like +-1 for weakness/resist -999 for immune)
    does not take into account for abilities that make immune  


https://pokemondb.net/pokedex/all  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_Ability  
https://www.pikalytics.com/pokedex/gen9vgc2024regh  
https://bulbapedia.bulbagarden.net/wiki/List_of_Pok%C3%A9mon_by_National_Pok%C3%A9dex_number#Generation_I  



To Do List  
-See how to match up pokemon from different sites
    -names might be a little weird
    -primary keys for number/name
-Scrape Pikalytics each format->Put in DB for the ones you find, but don't replace(some aren't in national dex for gen 9)   
    which also gets u the most recent data  
-See how to update it instead of dropping and redoing it each time lol

-filter for stats(needs a little work)(sorting by number makes it wacky)
-Search and Clear buttons font size are a little different?

-Make a fun little game, perhaps guessing base stats or typing or something like pokedoku who has this ability or something based off the stuff in the table
    (guess how many ghost types there are, how many pokemon with higher than 600 Base stats, or whatever)
MAYBE WE CAN DO SOMETHING WHERE IF U CLICK ON THE POKEMONS NAME, IT TAKES U TO AN OFF SITE THAT SHOWS U MORE IN DEPTH ABOUT IT, LIKE COMPETITIVE, ABILITY, AND MORE
    cuz theres not a lot of space to do it on the main page
    get pictures for each pokemon


scrape the table again: php artisan scrape:pokemon-table
start server: php artisan serve
Drop table from mysql workbench or thru down command here



Other projects:
League of legends extension?
Google chrome extension


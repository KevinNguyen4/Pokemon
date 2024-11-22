<?php
// app/Console/Commands/ScrapePokemonTable.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ScrapingService;


//php artisan scrape:pokemon-table
class ScrapePokemonTable extends Command
{
    protected $signature = 'scrape:pokemon-table';
    protected $description = 'Scrape the Pokémon table from PokéDB';

    protected $scrapingService;

    public function __construct(ScrapingService $scrapingService)
    {
        parent::__construct();
        $this->scrapingService = $scrapingService;
    }

    public function handle()
    {
        $this->scrapingService->scrapePokemonTable();
        $this->info('Pokémon table scraped successfully!');
    }
}
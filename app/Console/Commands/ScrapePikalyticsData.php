<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PikalyticsScrapingService;

class ScrapePikalyticsData extends Command
{
    protected $signature = 'scrape:pikalytics';
    protected $description = 'Scrape data from Pikalytics and update the database';

    protected $scrapingService;

    public function __construct(PikalyticsScrapingService $scrapingService)
    {
        parent::__construct();
        $this->scrapingService = $scrapingService;
    }

    public function handle()
    {
        $this->scrapingService->scrapeData();
        $this->info('Data scraped and updated successfully.');
    }
}
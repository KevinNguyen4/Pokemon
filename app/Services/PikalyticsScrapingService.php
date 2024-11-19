<?php

namespace App\Services;

use Goutte\Client;
use App\Models\Pokemon;

class PikalyticsScrapingService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function scrapeData()
    {
        $url = 'https://pikalytics.com/';
        $crawler = $this->client->request('GET', $url);

        // Example: Scrape data for each Pokémon
        $crawler->filter('.pokemon-card')->each(function ($node) {
            $name = $node->filter('.pokemon-name')->text();
            $usage = $node->filter('.usage-percentage')->text();

            // Scrape the 5 most common moves
            $moves = [];
            $node->filter('.moves .move')->each(function ($moveNode, $index) use (&$moves) {
                if ($index < 5) {
                    $moves[] = $moveNode->text();
                }
            });

            // Find the corresponding Pokémon in the database
            $pokemon = Pokemon::where('name', $name)->first();

            if ($pokemon) {
                // Update the Pokémon with the scraped data
                $pokemon->update([
                    //'usage' => $usage,
                    'common_moves' => json_encode($moves), // Store moves as JSON
                ]);
            }
        });
    }
}
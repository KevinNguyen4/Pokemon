<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\ScrapePikalyticsData;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ScrapePikalyticsData::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Schedule the command to run daily
        $schedule->command('scrape:pikalytics')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitializeApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the app by running all necessary upserting commands.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initializing application for production...');

        Artisan::call('upsert:currency');
        $this->info('Currency upserted successfully.');

        Artisan::call('upsert:language');
        $this->info('Language upserted successfully.');

        Artisan::call('upsert:icons');
        $this->info('Icons upserted successfully.');

        $this->info('⏺ Application initialized successfully.');
    }
}

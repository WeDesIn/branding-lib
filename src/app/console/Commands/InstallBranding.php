<?php

namespace Digihood\Branding\App\Console\Commands;

use Illuminate\Console\Command;

class InstallBranding extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:Branding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Artisan::call('backpack:install');
        return 1;
    }
}

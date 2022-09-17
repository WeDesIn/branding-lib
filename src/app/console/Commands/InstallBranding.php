<?php

namespace Digihood\Branding\App\Console\Commands;


use Digihood\Branding\BrandingServiceProvider;
use Illuminate\Console\Command;
use Artisan;
class InstallBranding extends Command
{
    use \Backpack\CRUD\app\Console\Commands\Traits\PrettyCommandOutput;
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
        $this->info('Install backpack');
        Artisan::call('backpack:install', []);
      
    }
}

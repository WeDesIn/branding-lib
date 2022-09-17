<?php

namespace Digihood\Branding\App\Console\Commands;

use Illuminate\Console\Command;
use Digihood\Branding\BrandingServiceProvider;
class InstallBranding extends Command
{
    use Traits\PrettyCommandOutput;
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
        $this->infoBlock('Installing Digihood Branding:', 'Step 1');

        // Publish files
        $this->progressBlock('Publishing configs, views, js and css files');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => BrandingServiceProvider::class,
            '--tag' => 'minimum',
        ]);
        $this->closeProgressBlock();
        $this->infoBlock('Installing Digihood Branding:', 'Step 2');
        $this->progressBlock('Install Backpack');
        $this->executeArtisanProcess('backpack:install');
        $this->closeProgressBlock();
        return 1;
    }
}

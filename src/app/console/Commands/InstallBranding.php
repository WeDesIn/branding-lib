<?php

namespace Digihood\Branding\App\Console\Commands;


use Digihood\Branding\BrandingServiceProvider;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
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
        $this->info('Installing Digihood Branding:', 'Step 1');

        // Publish files
        $this->progressBlock('Publishing configs');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => BrandingServiceProvider::class,
        ]);
        $this->closeProgressBlock();
        $this->infoBlock('Installing Digihood Branding:', 'Step 2');
        $this->progressBlock('Install Backpack');
        $this->executeArtisanProcess('backpack:install');
        $this->closeProgressBlock();
      
    }
}

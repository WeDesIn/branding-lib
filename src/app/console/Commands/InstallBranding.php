<?php

namespace Digihood\Branding\App\Console\Commands;


use Digihood\Branding\BrandingServiceProvider;
use Illuminate\Console\Command;
use Artisan;
use Carbon\Carbon;
class InstallBranding extends Command
{
    use \Backpack\CRUD\app\Console\Commands\Traits\PrettyCommandOutput;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:Branding';
    protected $digihoodMasters = [
        'josef' => 'josef','milan' => 'milan','filip' => 'filip ','jan' => 'jan'];
  
    protected $defaultPassword = 'Digihood';
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
        $this->info('Instalace backpacku');
        $this->call('backpack:install', []);
        $this->alert('Instalace backpacku Dokončena');
        $this->create_users();
         
    }

    protected function create_users(){
        $choise = $this->choice('Kdo vytvaří projekt?',$this->digihoodMasters);
        $userClass = config('backpack.base.user_model_fqn', 'App\Models\User');
        $userModel = new $userClass();
        try {
            $user = collect([
                'name' => $this->digihoodMasters[$choise],
                'email' => $this->digihoodMasters[$choise].'@digihood.cz',
                'password' => \Hash::make($this->defaultPassword),
            ]);

            // Merge timestamps
            if ($userModel->timestamps) {
                $user = $user->merge([
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

            $userModel->insert($user->toArray());
            $this->info('Uživatel vytvořen');
            $next_user =$this->ask('Chcete přidat dalšího Digi uživatele?','ne');
            if($next_user == 'ano'){
                 $this->create_users();
            } 
            
        } catch (\Throwable$e) {
            $this->errorBlock($e->getMessage());
        }
    }
}


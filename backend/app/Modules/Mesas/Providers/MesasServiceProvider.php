<?php

namespace App\Modules\Mesas\Providers;

use Illuminate\Support\ServiceProvider;

class MesasServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadRoutesFrom(base_path('app/Modules/Mesas/Routes/api.php'));
        $this->loadMigrationsFrom(base_path('app/Modules/Mesas/Database/Migrations'));
    }
}
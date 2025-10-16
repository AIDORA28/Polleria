<?php

namespace App\Modules\_ModuleTemplate\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleTemplateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
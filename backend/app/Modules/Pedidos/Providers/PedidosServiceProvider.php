<?php

namespace App\Modules\Pedidos\Providers;

use Illuminate\Support\ServiceProvider;

class PedidosServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
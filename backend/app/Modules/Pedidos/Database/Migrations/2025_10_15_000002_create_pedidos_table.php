<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->string('mesa')->nullable();
            $table->json('items');
            $table->string('estado')->default('abierto');
            $table->timestamps();

            $table->index(['sucursal_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
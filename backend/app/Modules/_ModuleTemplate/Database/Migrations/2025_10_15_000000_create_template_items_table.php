<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('template_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('sucursal_id')->nullable();
            $table->timestamps();

            $table->index(['sucursal_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_items');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Ensure a sensible default and keep the column unsigned
            $table->unsignedInteger('amount')->default(1);
            $table->timestamps();

            // Enforce amount is at least 1
            $table->check('amount >= 1');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

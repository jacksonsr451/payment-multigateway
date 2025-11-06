<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('amount')->default(1);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE products ADD CONSTRAINT chk_amount CHECK (amount >= 1)");
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

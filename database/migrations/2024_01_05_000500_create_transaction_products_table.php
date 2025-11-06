<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('quantity');
            $table->timestamps();

            $table->unique(['transaction_id', 'product_id']);
        });

        DB::statement("
            ALTER TABLE transaction_products 
            ADD CONSTRAINT chk_quantity CHECK (quantity > 0)
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_products');
    }
};

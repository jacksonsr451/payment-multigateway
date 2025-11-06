<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('gateway_id')->constrained()->cascadeOnDelete();
            $table->string('external_id')->unique();
            $table->string('status');
            $table->unsignedInteger('amount');
            $table->string('card_last_numbers', 4);
            $table->timestamps();
        });

        DB::statement("
            ALTER TABLE transactions 
            ADD CONSTRAINT chk_transactions_status 
            CHECK (status IN ('PENDING','APPROVED','DECLINED','FAILED'))
        ");

        DB::statement("
            ALTER TABLE transactions 
            ADD CONSTRAINT chk_transactions_amount 
            CHECK (amount > 0)
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

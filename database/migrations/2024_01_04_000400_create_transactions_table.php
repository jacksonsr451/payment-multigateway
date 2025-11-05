<?php

use App\Models\Client;
use App\Models\Gateway;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->check("status in ('PENDING','APPROVED','DECLINED','FAILED')");
            $table->check('amount > 0');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

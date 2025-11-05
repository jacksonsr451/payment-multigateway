<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Gateway;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'gateway_id' => Gateway::factory(),
            'external_id' => fake()->unique()->uuid(),
            'status' => fake()->randomElement([
                Transaction::STATUS_PENDING,
                Transaction::STATUS_APPROVED,
                Transaction::STATUS_DECLINED,
                Transaction::STATUS_FAILED,
            ]),
            'amount' => fake()->numberBetween(100, 10000),
            'card_last_numbers' => (string) fake()->numberBetween(1000, 9999),
        ];
    }
}

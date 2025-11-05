<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransactionProduct>
 */
class TransactionProductFactory extends Factory
{
    protected $model = TransactionProduct::class;

    public function definition(): array
    {
        return [
            'transaction_id' => Transaction::factory(),
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(1, 5),
        ];
    }
}

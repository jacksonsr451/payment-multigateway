<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_requires_positive_amount(): void
    {
        $this->expectException(QueryException::class);

        Product::factory()->create(['amount' => 0]);
    }

    public function test_product_has_many_transaction_products(): void
    {
        $product = Product::factory()->create();
        $transaction = Transaction::factory()->create();
        TransactionProduct::factory()->count(2)->create([
            'product_id' => $product->id,
            'transaction_id' => $transaction->id,
        ]);

        $this->assertCount(2, $product->transactionProducts);
        $this->assertTrue($product->transactionProducts->pluck('product_id')->unique()->contains($product->id));
    }
}

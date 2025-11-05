<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_product_requires_positive_quantity(): void
    {
        $this->expectException(QueryException::class);

        TransactionProduct::factory()->create(['quantity' => 0]);
    }

    public function test_transaction_product_relationships(): void
    {
        $transactionProduct = TransactionProduct::factory()
            ->for(Transaction::factory())
            ->for(Product::factory())
            ->create(['quantity' => 2]);

        $this->assertSame(2, $transactionProduct->quantity);
        $this->assertNotNull($transactionProduct->transaction);
        $this->assertNotNull($transactionProduct->product);
    }
}

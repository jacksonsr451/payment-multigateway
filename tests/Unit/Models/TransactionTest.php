<?php

namespace Tests\Unit\Models;

use App\Models\Client;
use App\Models\Gateway;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionProduct;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_transaction_has_required_attributes(): void
    {
        $client = Client::factory()->create();
        $gateway = Gateway::factory()->create();

        $transaction = Transaction::factory()->create([
            'client_id' => $client->id,
            'gateway_id' => $gateway->id,
            'external_id' => 'ext-123',
            'status' => Transaction::STATUS_PENDING,
            'amount' => 1000,
            'card_last_numbers' => '1234',
        ]);

        $this->assertSame($client->id, $transaction->client_id);
        $this->assertSame($gateway->id, $transaction->gateway_id);
        $this->assertSame('ext-123', $transaction->external_id);
        $this->assertSame(Transaction::STATUS_PENDING, $transaction->status);
        $this->assertSame(1000, $transaction->amount);
        $this->assertSame('1234', $transaction->card_last_numbers);
    }

    public function test_transaction_relationships(): void
    {
        $transaction = Transaction::factory()
            ->for(Client::factory())
            ->for(Gateway::factory())
            ->create();

        $products = Product::factory()->count(2)->create();

        foreach ($products as $product) {
            TransactionProduct::factory()->create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
            ]);
        }

        $this->assertCount(2, $transaction->transactionProducts);
        $this->assertNotNull($transaction->client);
        $this->assertNotNull($transaction->gateway);
    }

    public function test_transaction_requires_valid_status(): void
    {
        $this->expectException(QueryException::class);

        Transaction::factory()->create(['status' => 'INVALID']);
    }
}

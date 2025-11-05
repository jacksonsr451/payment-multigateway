<?php

namespace Tests\Unit\Models;

use App\Models\Client;
use App\Models\Gateway;
use App\Models\Transaction;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_requires_unique_email(): void
    {
        Client::factory()->create(['email' => 'client@local']);

        $this->expectException(QueryException::class);

        Client::factory()->create(['email' => 'client@local']);
    }

    public function test_client_has_many_transactions(): void
    {
        $client = Client::factory()->create();
        $transactions = Transaction::factory()
            ->for($client)
            ->for(Gateway::factory())
            ->count(2)
            ->create();

        $this->assertCount(2, $client->transactions);
        $this->assertTrue($client->transactions->pluck('id')->diff($transactions->pluck('id'))->isEmpty());
    }
}

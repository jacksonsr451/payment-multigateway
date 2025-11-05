<?php

namespace Tests\Unit\Models;

use App\Models\Gateway;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GatewayTest extends TestCase
{
    use RefreshDatabase;

    public function test_gateway_attributes(): void
    {
        $gateway = Gateway::factory()->create([
            'name' => 'gateway_one',
            'is_active' => true,
            'priority' => 1,
        ]);

        $this->assertSame('gateway_one', $gateway->name);
        $this->assertTrue($gateway->is_active);
        $this->assertSame(1, $gateway->priority);
    }

    public function test_gateway_priority_scope_orders_ascending(): void
    {
        $first = Gateway::factory()->create(['priority' => 2]);
        $second = Gateway::factory()->create(['priority' => 1]);

        $ordered = Gateway::ordered()->pluck('id')->all();

        $this->assertSame([$second->id, $first->id], $ordered);
    }

    public function test_gateway_unique_priority_constraint(): void
    {
        Gateway::factory()->create(['priority' => 1]);

        $this->expectException(QueryException::class);

        Gateway::factory()->create(['priority' => 1]);
    }
}

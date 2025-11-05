<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_defaults_to_user_role(): void
    {
        $user = User::factory()->create();

        $this->assertSame(User::ROLE_USER, $user->role);
    }

    public function test_user_password_is_hashed(): void
    {
        $user = User::factory()->create([
            'password' => 'secret123',
            'role' => User::ROLE_MANAGER,
        ]);

        $this->assertTrue(Hash::check('secret123', $user->password));
    }

    public function test_user_rejects_invalid_role(): void
    {
        $this->expectException(QueryException::class);

        User::factory()->create(['role' => 'INVALID']);
    }
}

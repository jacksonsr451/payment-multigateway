<?php

namespace Database\Seeders;

use App\Models\Gateway;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@local',
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('secret'),
            'role' => User::ROLE_ADMIN,
        ]);

        Gateway::updateOrCreate([
            'name' => 'gateway_one',
        ], [
            'is_active' => true,
            'priority' => 1,
        ]);

        Gateway::updateOrCreate([
            'name' => 'gateway_two',
        ], [
            'is_active' => true,
            'priority' => 2,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * AdminUserSeeder
 *
 * Creates a default administrator account for the Prototype Manager.
 *
 * Usage:
 *   php artisan db:seed --class=AdminUserSeeder
 *
 * ⚠️  Change the password immediately after first login in production.
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@prototype.test'],
            [
                'name'              => 'Administrator',
                'email'             => 'admin@prototype.test',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user created: admin@prototype.test / password');
        $this->command->warn('⚠️  Please change the password after first login!');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user for /admin (change password after first login)
        User::updateOrCreate(
            ['email' => 'info@estgroup.com.my'],
            [
                'name' => 'EST Group Admin',
                'password' => 'EstGroup#Admin2026!',
            ]
        );

        $this->call(PartnerLogoSeeder::class);
    }
}

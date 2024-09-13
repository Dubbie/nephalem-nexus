<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createDevUser();
        $this->call(SkillSeeder::class);
        $this->call(WeaponSeeder::class);
        $this->call(ArmorSeeder::class);
    }

    private function createDevUser(): void
    {
        User::create([
            'name' => config('app.developer.name'),
            'email' => config('app.developer.email'),
            'password' => Hash::make(config('app.developer.password')),
            'role' => User::ROLE_DEVELOPER,
        ]);
    }
}

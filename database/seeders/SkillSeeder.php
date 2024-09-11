<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(AmazonSkillSeeder::class);
        $this->call(AssassinSkillSeeder::class);
        $this->call(BarbarianSkillSeeder::class);
        $this->call(DruidSkillSeeder::class);
        $this->call(NecromancerSkillSeeder::class);
        $this->call(PaladinSkillSeeder::class);
        $this->call(SorceressSkillSeeder::class);
    }
}

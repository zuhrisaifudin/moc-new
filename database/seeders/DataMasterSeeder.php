<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            RoleMocSeeder::class,
            FormSeeder::class,
            RegionDistrictSeeder::class,
            
        ]);
    }
}

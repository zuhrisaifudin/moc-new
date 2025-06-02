<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MocRequest;
use App\Models\MocApproval;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        $this->call([
            ModuleUserSeeder::class,
            ModuleRoleSeeder::class,
            ModuleModulesSeeder::class,
            ModulePermissionSeeder::class,
            ModuleStageSeeder::class,
            ModuleCriteriaSeeder::class,
            ModuleRegionSeeder::class,
            ModuleDistrictSeeder::class,
            ModuleTransactionMocSeeder::class,
           

            DataMasterSeeder::class,
        ]);

    }
}

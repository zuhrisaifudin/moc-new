<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModuleStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $moduleModules = Module::create([
            'name' => 'Modul Tahap',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModuleModules = [
            [
                'name' => 'manage-stage',
                'display_name' => 'Manage Tahap',
                'description' => 'Bisa Memanage Tahap',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-stage',
                'display_name' => 'Create Tahap',
                'description' => 'Bisa Mengedit Tahap',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-stage',
                'display_name' => 'Edit Tahap',
                'description' => 'Bisa Mengedit Tahap',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-stage',
                'display_name' => 'Edit Tahap',
                'description' => 'Bisa Mengedit Tahap',
                'guard_name' => 'web'
            ]
        ];

        foreach ($permissionModuleModules as $key) {
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $moduleModules->id
            ]);
        }
    }
}

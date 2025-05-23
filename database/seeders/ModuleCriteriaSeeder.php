<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModuleCriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $moduleModules = Module::create([
            'name' => 'Modul Kriteria',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModuleModules = [
            [
                'name' => 'manage-criteria',
                'display_name' => 'Manage Kriteria',
                'description' => 'Bisa Memanage Kriteria',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-criteria',
                'display_name' => 'Create Kriteria',
                'description' => 'Bisa Mengedit Kriteria',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-criteria',
                'display_name' => 'Edit Kriteria',
                'description' => 'Bisa Mengedit Kriteria',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-criteria',
                'display_name' => 'Edit Kriteria',
                'description' => 'Bisa Mengedit Kriteria',
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

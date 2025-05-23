<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModuleRegionSeeder extends Seeder
{
    public function run()
    {
        $regionModules = Module::create([
            'name' => 'Modul Wilayah',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModuleModules = [
            [
                'name' => 'manage-region',
                'display_name' => 'Manage Wilayah',
                'description' => 'Bisa Memanage Wilayah',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-region',
                'display_name' => 'Create Wilayah',
                'description' => 'Bisa Mengedit Wilayah',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-region',
                'display_name' => 'Edit Wilayah',
                'description' => 'Bisa Mengedit Wilayah',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-region',
                'display_name' => 'Hapus Wilayah',
                'description' => 'Bisa Menghapus Wilayah',
                'guard_name' => 'web'
            ],
            
        ];

        foreach ($permissionModuleModules as $key) {
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $regionModules->id
            ]);
        }
    }
}

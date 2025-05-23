<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModuleModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $moduleModules = Module::create([
            'name' => 'Modul Module',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModuleModules = [
            [
                'name' => 'manage-module',
                'display_name' => 'Manage Modul',
                'description' => 'Bisa Memanage Module',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-module',
                'display_name' => 'Create Module',
                'description' => 'Bisa Mengedit Module',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-module',
                'display_name' => 'Edit Module',
                'description' => 'Bisa Mengedit Module',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manage-module-trashed',
                'display_name' => 'Manage Softdelete Module',
                'description' => 'Bisa Manage Softdelete Module',
                'guard_name' => 'web'
            ],
            [
                'name' => 'force-delete-module',
                'display_name' => 'Hapus Softdelete Module',
                'description' => 'Bisa Manage Force Softdelete Module',
                'guard_name' => 'web'
            ],
            [
                'name' => 'restore-delete-module',
                'display_name' => 'Restore Softdelete Module',
                'description' => 'Bisa Manage Restore Softdelete Module',
                'guard_name' => 'web'
            ],
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

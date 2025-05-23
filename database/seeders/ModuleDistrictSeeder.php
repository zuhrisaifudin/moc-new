<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModuleDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $regionModules = Module::create([
            'name' => 'Modul Area',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModuleModules = [
            [
                'name' => 'manage-district',
                'display_name' => 'Manage Area',
                'description' => 'Bisa Memanage Area',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-district',
                'display_name' => 'Create Area',
                'description' => 'Bisa Mengedit Area',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-district',
                'display_name' => 'Edit Area',
                'description' => 'Bisa Mengedit Area',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-district',
                'display_name' => 'Hapus Area',
                'description' => 'Bisa Menghapus Area',
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

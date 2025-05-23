<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModulePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $modulePermission = Module::create([
            'name' => 'Modul Permission',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModulePermission = [
            [
                'name' => 'manage-permission',
                'display_name' => 'Manage Permission',
                'description' => 'Bisa Memanage Permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-permission',
                'display_name' => 'Create Permission',
                'description' => 'Bisa Mengedit Permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-permission',
                'display_name' => 'Edit Permission',
                'description' => 'Bisa Mengedit Permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-permission',
                'display_name' => 'Menghapus Permission',
                'description' => 'Bisa Menghapus Permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manage-permission-trashed',
                'display_name' => 'Manage Softdelete Permission',
                'description' => 'Bisa Manage Softdelete Permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'force-delete-permission',
                'display_name' => 'Hapus Softdelete Permission',
                'description' => 'Bisa Manage Force Softdelete Permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'restore-delete-permission',
                'display_name' => 'Restore Softdelete Permission',
                'description' => 'Bisa Manage Restore Softdelete Permission',
                'guard_name' => 'web'
            ],
        ];

        foreach ($permissionModulePermission as $key) {
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $modulePermission->id
            ]);
        }
    }
}

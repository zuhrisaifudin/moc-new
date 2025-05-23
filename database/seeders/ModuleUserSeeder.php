<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModuleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $modulePermission = Module::create([
            'name' => 'Modul User Manajemen',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModulePermission = [
            [
                'name' => 'manage-user',
                'display_name' => 'Manage User',
                'description' => 'Bisa Memanage Permission',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add-role-user',
                'display_name' => 'Tambah Role Akses',
                'description' => 'Bisa Menambah Role kedalam User',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-user',
                'display_name' => 'Edit User',
                'description' => 'Bisa Mengedit User',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-user',
                'display_name' => 'Menghapus User',
                'description' => 'Bisa Menghapus User',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add-permission-user',
                'display_name' => 'Tambah Permission  User',
                'description' => 'Bisa Menambah Permission kedalam User',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manage-user-trashed',
                'display_name' => 'Manage Softdelete User',
                'description' => 'Bisa Manage Softdelete User',
                'guard_name' => 'web'
            ],
            [
                'name' => 'force-delete-user',
                'display_name' => 'Hapus Softdelete User',
                'description' => 'Bisa Manage Force Softdelete User',
                'guard_name' => 'web'
            ],
            [
                'name' => 'restore-delete-user',
                'display_name' => 'Restore Softdelete User',
                'description' => 'Bisa Manage Restore Softdelete User',
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

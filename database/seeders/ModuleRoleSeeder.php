<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;
class ModuleRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Module User
        $moduleRoles = Module::create([
            'name' => 'Modul Role',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModuleRole = [
            [
                'name' => 'manage-role',
                'display_name' => 'Manage Role',
                'description' => 'Bisa Memanage Role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-role',
                'display_name' => 'Create Role',
                'description' => 'Bisa Membuat Role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-role',
                'display_name' => 'Edit Role',
                'description' => 'Bisa Mengedit Role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-role',
                'display_name' => 'Delete Role',
                'description' => 'Bisa Menghapus Role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add-access-role',
                'display_name' => 'Tambah Akses',
                'description' => 'Menambahkan Akses Permission ',
                'guard_name' => 'web'
            ],
            
            [
                'name' => 'manage-role-trashed',
                'display_name' => 'Manage Softdelete Role',
                'description' => 'Bisa Manage Softdelete Role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'force-delete-role',
                'display_name' => 'Hapus Softdelete Role',
                'description' => 'Bisa Manage Force Softdelete Role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'restore-delete-role',
                'display_name' => 'Restore Softdelete Role',
                'description' => 'Bisa Manage Restore Softdelete Role',
                'guard_name' => 'web'
            ],
        ];

        foreach ($permissionModuleRole as $key) {
            # code...
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $moduleRoles->id
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Permission;

class ModuleTransactionMocSeeder extends Seeder
{
    public function run()
    {
        $Modules = Module::create([
            'name' => 'Modul Transaksi MOC',
            'is_active' => true,
            'core' => true,
        ]);

        $permissionModuleModules = [
            [
                'name' => 'manage-moc',
                'display_name' => 'Manage Permohonan MOC',
                'description' => 'Bisa Memanage  Permohonan MOC',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create-moc',
                'display_name' => 'Tambah Permohonan MOC',
                'description' => 'Bisa Tambah Permohonan MOC',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit-moc',
                'display_name' => 'Ubah Permohonan MOC',
                'description' => 'Bisa Ubah  Permohonan MOC',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete-moc',
                'display_name' => 'Hapus Permohonan MOC',
                'description' => 'Bisa Menghapus  Permohonan MOC',
                'guard_name' => 'web'
            ],
            [
                'name' => 'show-moc',
                'display_name' => 'Melihat Permohonan MOC',
                'description' => 'Bisa Melihat Detail Permohonan MOC',
                'guard_name' => 'web'
            ],
            [
                'name' => 'send-moc',
                'display_name' => 'Mengirim Permohonan MOC',
                'description' => 'Bisa Mengirim ke Fungsi Pengusul Permohonan MOC',
                'guard_name' => 'web'
            ],
            [
                'name' => 'id-asset-moc',
                'display_name' => 'Tambah ID Asset Permohonan MOC',
                'description' => 'Bisa Tambah ID Asset  Permohonan MOC',
                'guard_name' => 'web'
            ],
            [
                'name' => 'approved-moc-request-fuction',
                'display_name' => 'Menyetujui by Fungsi Pengusul Permohonan MOC',
                'description' => 'Bisa Menyetujui by Fungsi Pengusul Permohonan MOC',
                'guard_name' => 'web'
            ],
            [
                'name' => 'approved-moc-checker-function',
                'display_name' => 'Menyetujui by Fungsi Pemeriksa Permohonan MOC',
                'description' => 'Bisa Menyetujui by Fungsi Pemeriksa Permohonan MOC',
                'guard_name' => 'web'
            ],
            
        ];

        foreach ($permissionModuleModules as $key) {
            Permission::create([
                'name' => $key['name'],
                'display_name' => $key['display_name'],
                'description' => $key['description'],
                'module_id' => $Modules->id
            ]);
        }
    }
}

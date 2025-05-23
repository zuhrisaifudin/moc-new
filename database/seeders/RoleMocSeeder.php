<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleMocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roleMoc = [
            [
                'name' => 'Pengusul',
                'display_name' => 'Pengusul',
                'description' => 'adalah Pekerja dari Fungsi / Area / Satuan Kerja / Organisasi / Direktur / Anak Perusahaan yang menginisiasi terjadinya perubahan pada infrastruktur gas.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Fungsi Pengusul',
                'display_name' => 'Fungsi Pengusul',
                'description' => 'adalah Fungsi / Area / Satuan Kerja / Organisasi / Direksi / Anak Perusahaan dari Pengusul yang menginisiasi, menetapkan dan menyampaikan usulan perubahan.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Fungsi Pemeriksa',
                'display_name' => 'Fungsi Pemeriksa',
                'description' => 'adalah Fungsi / Area / Satuan Kerja / Organisasi / Direksi yang memiliki kewenangan untuk melakukan verifikasi, validasi dan persetujuan atas usulan perubahan.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'MOC Controller',
                'display_name' => 'MOC Controller',
                'description' => 'adalah Personil / Pekerja / Anggota Sub Komite MOC yang memiliki kewenangan untuk menentukan Pemeriksa dan mengendalikan proses implementasi MOC di satuan kerja / anak perusahaan.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Tim Pemeriksa',
                'display_name' => 'Tim Pemeriksa',
                'description' => 'adalah Pekerja / Kumpulan Pekerja / Subject Matter Expert yang memiliki ilmu serta pengalaman dalam kajian manajemen perubahan serta memiliki otorisasi atas perubahan tersebut.',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Fungsi Approval',
                'display_name' => 'Fungsi Approval',
                'description' => 'adalah Fungsi / Area / Satuan Kerja / Organisasi / Direksi yang memiliki kewenangan atas persetujuan perubahan pada lingkup aset yang dikelola.',
                'guard_name' => 'web',
            ],

           
        ];

        foreach($roleMoc as $role){
            Role::create([
                'name' => $role['name'],
                'display_name' => $role['display_name'],
                'description' => $role['description'],
                'guard_name' => $role['guard_name'],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\DescriptionChange;
use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stage = Stage::create([
            'stages_name' => 'Sebelum Implementasi Lapangan',
            'type_form' => 1,
            'is_active' => true,
        ]);

        $kriteria = [
            [
                'stage_id' => $stage->id,
                'criteria_name' => 'A. Acuan Standar/Code/Reference/DAK',
                'is_active' => true,
                'descriptions' => [
                    '1. Kesesuaian dengan standar/spesifikasi teknis',
                ],
            ],
            [
                'stage_id' => $stage->id,
                'criteria_name' => 'B. Analisis Resiko (Tinjauan Hazid & Rekomendasi)',
                'is_active' => true,
                'descriptions' => [
                    '1. Aspek Keselamatan dan Kesehatan Kerja',
                    '2. Aspek Lingkungan',
                    '3. Identifikasi Bahaya & Penilaian Risiko (Teknis/Operasional)',
                ],
            ],
            [
                'stage_id' => $stage->id,
                'criteria_name' => 'C. Dokumentasi',
                'is_active' => true,
                'descriptions' => [
                    '1. Perubahan peralatan (gambar, prosedur pengujian sebelum penggunaan)',
                    '2. Dokumen Uji Kualitas',

                ],
            ],
            [
                'stage_id' => $stage->id,
                'criteria_name' => 'D. Informasi pemeliharaan sistem',
                'is_active' => true,
                'descriptions' => [
                    '1. Penjelasan/pelatihan untuk konstruksi, prosedur start up, Rapat HSE untuk personil maintenance/kontraktor',
                ],
            ],
            [
                'stage_id' => $stage->id,
                'criteria_name' => 'E. Prosedur-prosedur',
                'is_active' => true,
                'descriptions' => [
                    '1. User Manual',
                    '2. Sistem dan Tata Kerja',
                ],
            ],
            [
                'stage_id' => $stage->id,
                'criteria_name' => 'F. Perubahan Organisasi',
                'is_active' => true,
                'descriptions' => [
                    '1. Berdampak pada penambahan/pengurangan tenaga kerja',
                ],
            ],
            [
                'stage_id' => $stage->id,
                'criteria_name' => 'G. Pelatihan',
                'is_active' => true,
                'descriptions' => [
                    '1. Pelatihan untuk personil yang terlibat tentang semua prosedur baru',
                ],
            ],
           
        ];

        foreach ($kriteria as $key) {
            $criteria =  Criteria::create([
                'stage_id' => $key['stage_id'],
                'criteria_name' => $key['criteria_name'],
                'is_active' => $key['is_active'],
            ]);

            foreach ($key['descriptions'] as $desc) {
                DescriptionChange::create([
                    'criteria_id' => $criteria->id,
                    'description_change_name' => $desc,
                    'is_active' => true,
                ]);
            }
        }
        
    }
}
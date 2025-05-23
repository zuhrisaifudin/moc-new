<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MocRequest;
use App\Models\MocApproval;
use Illuminate\Support\Facades\DB;

class DataMocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $regions = ['Jawa Barat', 'Jawa Tengah', 'Jawa Timur'];
        $areas = ['Cikarang', 'Semarang', 'Surabaya', 'Bandung', 'Yogyakarta'];
        $types = ['installation', 'process', 'regulation', 'other'];
        $riskLevels = ['High', 'Medium', 'Low'];
        $stages = ['submission', 'review', 'checklist1', 'checklist2', 'approval', 'closed'];

        for ($i = 1; $i <= 50; $i++) {
            $mocRequest = MocRequest::create([
                'moc_number' => sprintf('00%03d/OMM.%s/%d/2025', $i, str_replace(' ', '', $regions[array_rand($regions)]), rand(1, 12)),
                'moc_title' => "Perubahan Sistem #" . $i,
                'type_of_change' => $types[array_rand($types)],
                'risk_level' => $riskLevels[array_rand($riskLevels)],
                'date' => now()->subDays(rand(1, 365))->format('Y-m-d'),
                'status' => rand(0, 1),
                'region' => $regions[array_rand($regions)],
                'area' => $areas[array_rand($areas)],
                'coordinates' => DB::raw(sprintf('POINT(%f, %f)', rand(105, 110) + (rand(0, 999) / 1000), rand(-7, -6) + (rand(0, 999) / 1000))),
                'proposed_by' => 'User ' . $i,
                'proposer_function' => 'Divisi Maintenance Region ' . rand(1, 3),
                'examiner_team' => json_encode([
                    ['name' => 'Budi Santoso', 'role' => 'SME Teknik'],
                    ['name' => 'Dewi Anggraeni', 'role' => 'HSSE Officer']
                ]),
                'current_stage' => $stages[array_rand($stages)],
                'is_temporary' => rand(0, 1),
                'start_date' => now()->subDays(rand(10, 100))->format('Y-m-d'),
                'end_date' => now()->addDays(rand(10, 100))->format('Y-m-d'),
                'reference_document' => 'P-00' . rand(100, 999) . '/15.03',
                'change_reason' => 'Alasan perubahan ke-' . $i,
            ]);

            $mocRequest->approvals()->create([
                'approval_type' => 'initiator',
                'approver_name' => 'System',
                'approver_role' => 'Admin',
                'status' => 'pending'
            ]);


        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $region =[
            [
                'name' => 'City Gas Project',
                'region_code' => 'CGP',
                'is_active' => 1,
                'districts' => [
                    [
                        'name' => 'IT1', 
                        'district_code' => 'IT1', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'IT2', 
                        'district_code' => 'IT2', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'IT3', 
                        'district_code' => 'IT3', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'IT4', 
                        'district_code' => 'IT4', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'IT5', 
                        'district_code' => 'IT5', 
                        'is_active' => 1
                    ],
                ],
            ],
            [
                'name' => 'GEI',
                'region_code' => 'GEI',
                'is_active' => 1,
                'districts' => [
                    [
                        'name' => 'PUSAT', 
                        'district_code' => 'PUSAT', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'SOR I', 
                        'district_code' => 'SOR I', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'SOR II', 
                        'district_code' => 'SOR II', 
                        'is_active' => 1
                    ]
                ],
            ],
            [
                'name' => 'KJP',
                'region_code' => 'KJP',
                'is_active' => 1,
            ],
            [
                'name' => 'MSCM',
                'region_code' => 'MSCM',
                'is_active' => 1,
                'districts' => [
                    [
                        'name' => 'Cilegon', 
                        'district_code' => 'Cilegon', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Kantor Pusat', 
                        'district_code' => 'Kantor Pusat', 
                        'is_active' => 1
                    ]
                ],
            ],
            [
                'name' => 'Nusantara Regas',
                'region_code' => 'NR',
                'is_active' => 1,
            ],
            [
                'name' => 'Operration Maintenance Management',
                'region_code' => 'OMM',
                'is_active' => 1,
                'districts' => [
                    [
                        'name' => 'Jawa Bagian Barat', 
                        'district_code' => 'Jawa Bagian Barat', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Sumatera Selatan', 
                        'district_code' => 'Sumatera Selatan', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Lampung', 
                        'district_code' => 'Lampung', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Kantor Pusat', 
                        'district_code' => 'Kantor Pusat', 
                        'is_active' => 1
                    ]
                    
                ],
            ],
            [
                'name' => 'PAG',
                'region_code' => 'PAG',
                'is_active' => 1,
            ],
            [
                'name' => 'Pertadaya Gas',
                'region_code' => 'PDG',
                'is_active' => 1,
            ],
            [
                'name' => 'Pertagas',
                'region_code' => 'PERTAGAS',
                'is_active' => 1,
            ],
            [
                'name' => 'PLI',
                'region_code' => 'PLI',
                'is_active' => 1,
            ],
            [
                'name' => 'Project Management Office',
                'region_code' => 'PMO',
                'is_active' => 1,
                'districts' => [
                    [
                        'name' => 'IT1', 
                        'district_code' => 'IT1', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'IT2', 
                        'district_code' => 'IT2', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'IT3', 
                        'district_code' => 'IT3', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'IT4', 
                        'district_code' => 'IT4', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'IT5', 
                        'district_code' => 'IT5', 
                        'is_active' => 1
                    ],
                ],
            ],
            [
                'name' => 'PN',
                'region_code' => 'PN',
                'is_active' => 1,
            ],
            [
                'name' => 'PSG',
                'region_code' => 'PSG',
                'is_active' => 1,
            ],
            [
                'name' => 'SEI',
                'region_code' => 'SEI',
                'is_active' => 1,
            ],
            [
                'name' => 'Sales Operation Region 1',
                'region_code' => 'SOR 1',
                'is_active' => 1,
                'districts' => [
                    [
                        'name' => 'Medan', 
                        'district_code' => 'Medan', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Dumai', 
                        'district_code' => 'Dumai', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Pekanbaru', 
                        'district_code' => 'Pekanbaru', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Batam', 
                        'district_code' => 'Batam', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Palembang', 
                        'district_code' => 'Palembang', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Lampung', 
                        'district_code' => 'Lampung', 
                        'is_active' => 1
                    ],
                ],
            ],
            [
                'name' => 'Sales Operation Region II',
                'region_code' => 'SOR II',
                'is_active' => 1,
                'districts' => [
                    [
                        'name' => 'Cilegon', 
                        'district_code' => 'Cilegon', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Tangerang', 
                        'district_code' => 'Tangerang', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Jakarta', 
                        'district_code' => 'Jakarta', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Bogor', 
                        'district_code' => 'Bogor', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Bekasi', 
                        'district_code' => 'Bekasi', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Karawang', 
                        'district_code' => 'Karawang', 
                        'is_active' => 1
                    ],
    
                    [
                        'name' => 'Cirebon', 
                        'district_code' => 'Cirebon', 
                        'is_active' => 1
                    ],
                ],
            ],
            [
                'name' => 'Sales Operation Region III',
                'region_code' => 'SOR III',
                'is_active' => 1,
                'districts' => [
                    [
                        'name' => 'Semarang', 
                        'district_code' => 'Semarang', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Surabaya-Gresik', 
                        'district_code' => 'Surabaya-Gresik', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Sidoarjo-Mojokerto', 
                        'district_code' => 'Sidoarjo-Mojokerto', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Pasuruan-Probolinggo', 
                        'district_code' => 'Pasuruan-Probolinggo', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Kalimantan', 
                        'district_code' => 'Kalimantan', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Kawasan Indonesia Timur', 
                        'district_code' => 'Kawasan Indonesia Timur', 
                        'is_active' => 1
                    ],
                    [
                        'name' => 'Bojonegoro', 
                        'district_code' => 'Bojonegoro', 
                        'is_active' => 1
                    ],
                ],
            ],
            [
                'name' => 'Transportation Gas Indonesia',
                'region_code' => 'TGI',
                'is_active' => 1,
            ],
            [
                'name' => 'WMN',
                'region_code' => 'WMN',
                'is_active' => 1,
            ],
        ];

        foreach ($region as $key){
            $region = \App\Models\Region::create([
                'name' => $key['name'],
                'region_code' => $key['region_code'],
                'is_active' => $key['is_active'],
            ]);

            if (isset($key['districts'])) {
                foreach ($key['districts'] as $district) {
                    \App\Models\District::create([
                        'name' => $district['name'],
                        'region_id' => $region->id,
                        'district_code' => $district['district_code'],
                        'is_active' => $district['is_active'],
                    ]);
                }
            }
        }
    }
}

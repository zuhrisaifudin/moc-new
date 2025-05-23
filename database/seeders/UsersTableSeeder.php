<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // $faker = Faker::create();

        // for ($i = 1; $i <= 100; $i++) {
        //     $createdAt = $faker->dateTimeBetween('-2 years', 'now');
            
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => str_replace('@example.com', '@pgn.co.id', $faker->unique()->safeEmail),
        //         'password' => Hash::make('12345678'),
        //         'email_verified_at' => $createdAt,
        //         'created_at' => $createdAt,
        //     ]);
        // }

        $userSuperAdmin =User::create([
            'name' => 'Saifudin Zuhri',
            'email' => 'zuhrisaifudin57@gmail.com',
            'password' => bcrypt('MenjadiBintang!@#QWE!'),
            'email_verified_at'=>'2022-01-02 17:04:58',
            'is_active' => 1,
            'remember_token' => null,
            'created_at' => now(),
        ]);

        $adminSuperAdminRole =Role::create([
            'name' => 'Super Administrator',
            'display_name' => 'Super Administrator',
            'description' => 'Role Untuk Akun Master',
            'guard_name' => 'web',
        ]);


        $userSuperAdmin->assignRole($adminSuperAdminRole);
    }
}

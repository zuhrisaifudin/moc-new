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
class UsersTableSeederDum extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $positions = [
            'Senior Expert I, Infrastructure Information System',
            'Senior Analyst II, Infrastructure Information System',
            'Junior Assistant IV, Infrastructure Information System',
            'Expert II, Infrastructure Information System',
            'Analyst I, Infrastructure Information System',
            'Assistant III, Infrastructure Information System',
            'Junior Analyst II, Infrastructure Information System',
            'Senior Assistant I, Infrastructure Information System',
            'Junior Expert III, Infrastructure Information System',
            'Support Staff IV, Infrastructure Information System',
        ];


        for ($i = 1; $i <= 100; $i++) {
            $createdAt = $faker->dateTimeBetween('-2 years', 'now');
            
            User::create([
                'name' => $faker->name,
                'email' => str_replace('@example.com', '@pgn.co.id', $faker->unique()->safeEmail),
                'password' => Hash::make('12345678'),
                'position' => $faker->randomElement($positions),
                'email_verified_at' => $createdAt,
                'created_at' => $createdAt,
            ]);
        }
    }
}

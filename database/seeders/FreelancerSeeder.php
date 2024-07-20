<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FreelancerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            'name' => 'Freelancer2',
            'email' => 'freelancer2@gmail.com',
            'hp' => '082298475626',
            'alamat' => 'Jl. tuban 11',
            'password' => bcrypt('123456'),
            'role' => 'freelancer'
        ]);

        DB::table('pegawais')->insert([
            'name' => 'Freelancer3',
            'email' => 'freelancer3@gmail.com',
            'hp' => '082298475626',
            'alamat' => 'Jl. tuban 11',
            'password' => bcrypt('123456'),
            'role' => 'freelancer'
        ]);
    }
}

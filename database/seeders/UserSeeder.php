<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Aldi',
            'email' => 'aldi@gmail.com',
            'alamat' => 'Jl. gunung merapi',
            'password' => bcrypt('123456'),
        ],
        [
                'name' => 'kevin',
                'email' => 'silahisabungan7@gmail.com',
                'alamat' => 'Jl. gunung merapi',
                'password' => bcrypt('123456'),
        ]
    );
    }
}

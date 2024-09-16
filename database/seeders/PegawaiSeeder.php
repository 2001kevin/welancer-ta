<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            // Superadmin
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'hp' => '081234567890',
                'alamat' => 'Jl. Contoh No. 1, Jakarta',
                'email_verified_at' => now(),
                'password' => Hash::make('superadminpassword'),
                'role' => 'superadmin',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Admin
            [
                'name' => 'Admin 1',
                'email' => 'admin1@gmail.com',
                'hp' => '081234567891',
                'alamat' => 'Jl. Admin No. 2, Bandung',
                'email_verified_at' => now(),
                'password' => Hash::make('admin1password'),
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Freelancers
            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'hp' => '081234567892',
                'alamat' => 'Jl. Freelancer No. 1, Surabaya',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword1'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@gmail.com',
                'hp' => '081234567893',
                'alamat' => 'Jl. Freelancer No. 2, Yogyakarta',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword2'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Johnson',
                'email' => 'michaeljohnson@gmail.com',
                'hp' => '081234567894',
                'alamat' => 'Jl. Freelancer No. 3, Jakarta',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword3'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emilydavis@gmail.com',
                'hp' => '081234567895',
                'alamat' => 'Jl. Freelancer No. 4, Bandung',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword4'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chris Lee',
                'email' => 'chrislee@gmail.com',
                'hp' => '081234567896',
                'alamat' => 'Jl. Freelancer No. 5, Semarang',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword5'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jessica Brown',
                'email' => 'jessicabrown@gmail.com',
                'hp' => '081234567897',
                'alamat' => 'Jl. Freelancer No. 6, Bali',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword6'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daniel Wilson',
                'email' => 'danielwilson@gmail.com',
                'hp' => '081234567898',
                'alamat' => 'Jl. Freelancer No. 7, Surabaya',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword7'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sophia Martinez',
                'email' => 'sophiamartinez@gmail.com',
                'hp' => '081234567899',
                'alamat' => 'Jl. Freelancer No. 8, Makassar',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword8'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Anderson',
                'email' => 'davidanderson@gmail.com',
                'hp' => '081234567900',
                'alamat' => 'Jl. Freelancer No. 9, Medan',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword9'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Olivia Thomas',
                'email' => 'oliviathomas@gmail.com',
                'hp' => '081234567901',
                'alamat' => 'Jl. Freelancer No. 10, Bali',
                'email_verified_at' => now(),
                'password' => Hash::make('freelancerpassword10'),
                'role' => 'freelancer',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            [
                'nama' => 'Wedding Service',
                'deskripsi' => 'Layanan pernikahan, mulai dari dokumentasi hingga tata rias yang dapat dikirimkan secara daring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Web Development',
                'deskripsi' => 'Pengembangan website yang dapat dikirimkan dalam bentuk file project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Graphic Design',
                'deskripsi' => 'Layanan desain grafis seperti logo, banner, dan lainnya yang dikirimkan secara digital',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Digital Marketing',
                'deskripsi' => 'Layanan pemasaran digital seperti social media ads, SEO, dan content marketing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

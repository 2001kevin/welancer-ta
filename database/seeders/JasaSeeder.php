<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jasas')->insert([
            // Jasa untuk kategori "Wedding Service"
            [
                'nama' => 'Wedding Photography',
                'deskripsi' => 'Dokumentasi foto pernikahan yang dikirimkan melalui Google Drive',
                'kategori_id' => 1, // ID kategori "Wedding Service"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Wedding Video Editing',
                'deskripsi' => 'Edit video pernikahan dengan hasil akhir dikirimkan melalui Google Drive',
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Jasa untuk kategori "Web Development"
            [
                'nama' => 'Website Design',
                'deskripsi' => 'Desain layout dan tampilan website yang dikirim dalam bentuk file project',
                'kategori_id' => 2, // ID kategori "Web Development"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Website Deployment',
                'deskripsi' => 'Pengembangan dan deployment website yang dikirim melalui file project',
                'kategori_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Jasa untuk kategori "Graphic Design"
            [
                'nama' => 'Logo Design',
                'deskripsi' => 'Desain logo profesional yang dikirim dalam format digital melalui Google Drive',
                'kategori_id' => 3, // ID kategori "Graphic Design"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Banner Design',
                'deskripsi' => 'Desain banner untuk kebutuhan marketing, dikirim melalui Google Drive',
                'kategori_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Jasa untuk kategori "Digital Marketing"
            [
                'nama' => 'SEO Optimization',
                'deskripsi' => 'Layanan optimasi SEO untuk website yang dilaporkan melalui file digital',
                'kategori_id' => 4, // ID kategori "Digital Marketing"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Social Media Management',
                'deskripsi' => 'Layanan manajemen media sosial dengan laporan dan aset digital yang dikirim melalui Google Drive',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

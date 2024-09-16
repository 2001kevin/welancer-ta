<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            // Skill untuk Wedding Video Editing
            [
                'nama' => 'Video Editing',
                'deskripsi' => 'Editing video dengan berbagai efek dan pemrosesan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Color Grading',
                'deskripsi' => 'Penyesuaian warna dan tone video.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Skill untuk Website Design
            [
                'nama' => 'Web Design',
                'deskripsi' => 'Desain antarmuka pengguna untuk situs web.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Responsive Design',
                'deskripsi' => 'Desain yang berfungsi dengan baik di berbagai perangkat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Skill untuk Logo Design
            [
                'nama' => 'Logo Design',
                'deskripsi' => 'Pembuatan desain logo untuk brand.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Skill untuk SEO Optimization
            [
                'nama' => 'SEO',
                'deskripsi' => 'Optimisasi mesin pencari untuk meningkatkan visibilitas situs.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Skill untuk Wedding Photography
            [
                'nama' => 'Photography',
                'deskripsi' => 'Kemampuan dalam mengambil foto berkualitas tinggi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Skill untuk Website Deployment
            [
                'nama' => 'Server Management',
                'deskripsi' => 'Pengelolaan dan konfigurasi server untuk website.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Skill untuk Banner Design
            [
                'nama' => 'Banner Design',
                'deskripsi' => 'Desain banner untuk web atau cetak.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Project Manager',
                'deskripsi' => 'Manage Project.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

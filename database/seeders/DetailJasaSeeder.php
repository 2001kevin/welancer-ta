<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailJasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_jasas')->insert([
            // Detail untuk Wedding Video Editing
            [
                'skill_id' => 1, // Video Editing
                'rincian_jasa_id' => 1, // Color Grading
                'pegawai_id' => 1, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 2, // Color Grading
                'rincian_jasa_id' => 2, // Cut Video
                'pegawai_id' => 2, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Detail untuk Website Design
            [
                'skill_id' => 3, // Web Design
                'rincian_jasa_id' => 3, // Design Mockup
                'pegawai_id' => 3, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 4, // Responsive Design
                'rincian_jasa_id' => 4, // Responsive Design
                'pegawai_id' => 4, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Detail untuk Logo Design
            [
                'skill_id' => 5, // Logo Design
                'rincian_jasa_id' => 5, // Simple Logo
                'pegawai_id' => 5, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 5, // Logo Design
                'rincian_jasa_id' => 6, // Complex Logo
                'pegawai_id' => 6, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Detail untuk SEO Optimization
            [
                'skill_id' => 6, // SEO
                'rincian_jasa_id' => 7, // Keyword Research
                'pegawai_id' => 7, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 6, // SEO
                'rincian_jasa_id' => 8, // On-Page SEO
                'pegawai_id' => 8, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Detail untuk Wedding Photography
            [
                'skill_id' => 7, // Photography
                'rincian_jasa_id' => 13, // Pre-Wedding Photoshoot
                'pegawai_id' => 9, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 7, // Photography
                'rincian_jasa_id' => 10, // Wedding Day Photography
                'pegawai_id' => 10, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Detail untuk Website Deployment
            [
                'skill_id' => 8, // Server Management
                'rincian_jasa_id' => 14, // Deployment to Live Server
                'pegawai_id' => 11, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 8, // Server Management
                'rincian_jasa_id' => 14, // Server Configuration
                'pegawai_id' => 12, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Detail untuk Banner Design
            [
                'skill_id' => 9, // Banner Design
                'rincian_jasa_id' => 15, // Web Banner Design
                'pegawai_id' => 7, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 9, // Banner Design
                'rincian_jasa_id' => 15, // Print Banner Design
                'pegawai_id' => 9, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'skill_id' => 10, // Banner Design
                'rincian_jasa_id' => 16, // Print Banner Design
                'pegawai_id' => 10, // ID Freelancer
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

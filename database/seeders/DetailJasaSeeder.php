<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PegawaiSkill;

class DetailJasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Detail untuk Wedding Video Editing
        $this->insertDetailJasa(1, 1); // Video Editing -> Color Grading
        $this->insertDetailJasa(2, 2); // Color Grading -> Cut Video

        // Detail untuk Website Design
        $this->insertDetailJasa(3, 3); // Web Design -> Design Mockup
        $this->insertDetailJasa(4, 4); // Responsive Design -> Responsive Design

        // Detail untuk Logo Design
        $this->insertDetailJasa(5, 5); // Logo Design -> Simple Logo
        $this->insertDetailJasa(5, 6); // Logo Design -> Complex Logo

        // Detail untuk SEO Optimization
        $this->insertDetailJasa(6, 7); // SEO -> Keyword Research
        $this->insertDetailJasa(6, 8); // SEO -> On-Page SEO

        // Detail untuk Wedding Photography
        $this->insertDetailJasa(7, 13); // Photography -> Pre-Wedding Photoshoot
        $this->insertDetailJasa(7, 10); // Photography -> Wedding Day Photography

        // Detail untuk Website Deployment
        $this->insertDetailJasa(8, 14); // Server Management -> Deployment to Live Server
        $this->insertDetailJasa(8, 14); // Server Management -> Server Configuration

        // Detail untuk Banner Design
        $this->insertDetailJasa(9, 15); // Banner Design -> Web Banner Design
        $this->insertDetailJasa(9, 15); // Banner Design -> Print Banner Design
        $this->insertDetailJasa(10, 16); // Banner Design -> Print Banner Design
    }

    /**
     * Insert detail jasa with related skill and pegawai.
     *
     * @param int $skillId
     * @param int $rincianJasaId
     * @return void
     */
    private function insertDetailJasa($skillId, $rincianJasaId)
    {
        // Ambil pegawai yang memiliki skill_id yang sesuai
        $pegawai = PegawaiSkill::where('skill_id', $skillId)->inRandomOrder()->first();

        if ($pegawai) {
            // Jika ada pegawai yang memiliki skill tersebut, lakukan insert ke detail_jasas
            DB::table('detail_jasas')->insert([
                'skill_id' => $skillId,
                'rincian_jasa_id' => $rincianJasaId,
                'pegawai_id' => $pegawai->pegawai_id,
                'level' => $pegawai->level,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            // Jika tidak ada pegawai dengan skill tersebut
            echo "No freelancer found with skill_id: $skillId\n";
        }
    }
}

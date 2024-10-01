<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PegawaiSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua freelancer
        $freelancers = Pegawai::where('role', 'freelancer')->get();

        // Ambil semua skill
        $skills = Skill::all();

        // Pastikan setiap skill dimiliki oleh minimal satu freelancer
        foreach ($skills as $skill) {
            // Ambil freelancer secara acak
            $freelancer = $freelancers->random();

            // Assign skill ke freelancer tersebut
            DB::table('pegawai_skills')->insert([
                'pegawai_id' => $freelancer->id,
                'skill_id' => $skill->id,
                'level' => Arr::random(['beginner', 'middle', 'advance']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Assign skill tambahan ke freelancer secara acak
        foreach ($freelancers as $freelancer) {
            // Setiap freelancer bisa memiliki lebih dari satu skill secara acak
            $assignedSkills = $skills->random(rand(1, $skills->count())); // Assign antara 1 hingga semua skill secara acak

            foreach ($assignedSkills as $skill) {
                // Cek apakah skill sudah diassign ke freelancer ini
                $exists = DB::table('pegawai_skills')
                    ->where('pegawai_id', $freelancer->id)
                    ->where('skill_id', $skill->id)
                    ->exists();

                if (!$exists) {
                    // Jika belum, insert data baru
                    DB::table('pegawai_skills')->insert([
                        'pegawai_id' => $freelancer->id,
                        'skill_id' => $skill->id,
                        'level' => Arr::random(['beginner', 'middle', 'advance']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}

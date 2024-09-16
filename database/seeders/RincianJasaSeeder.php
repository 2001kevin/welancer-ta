<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\RincianJasa;
use App\Events\RincianJasaCreated;

class RincianJasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rincian untuk jasa "Wedding Video Editing"
        $rincianJasa1 = RincianJasa::create([
            'nama' => 'Color Grading',
            'jasa_id' => 2, // Asumsi id jasa "Wedding Video Editing"
            'unit' => 1,
            'tipe_unit' => 'jam',
            'harga' => 500000,
        ]);
        event(new RincianJasaCreated($rincianJasa1));

        $rincianJasa2 = RincianJasa::create([
            'nama' => 'Cut Video',
            'jasa_id' => 2,
            'unit' => 2,
            'tipe_unit' => 'jam',
            'harga' => 300000,
        ]);
        event(new RincianJasaCreated($rincianJasa2));

        // Rincian untuk jasa "Website Design"
        $rincianJasa3 = RincianJasa::create([
            'nama' => 'Design Mockup',
            'jasa_id' => 3, // Asumsi id jasa "Website Design"
            'unit' => 1,
            'tipe_unit' => 'mockup',
            'harga' => 2000000,
        ]);
        event(new RincianJasaCreated($rincianJasa3));

        $rincianJasa4 = RincianJasa::create([
            'nama' => 'Responsive Design',
            'jasa_id' => 3,
            'unit' => 1,
            'tipe_unit' => 'halaman',
            'harga' => 1500000,
        ]);
        event(new RincianJasaCreated($rincianJasa4));

        // Rincian untuk jasa "Logo Design"
        $rincianJasa5 = RincianJasa::create([
            'nama' => 'Simple Logo',
            'jasa_id' => 5, // Asumsi id jasa "Logo Design"
            'unit' => 1,
            'tipe_unit' => 'logo',
            'harga' => 500000,
        ]);
        event(new RincianJasaCreated($rincianJasa5));

        $rincianJasa6 = RincianJasa::create([
            'nama' => 'Complex Logo',
            'jasa_id' => 5,
            'unit' => 1,
            'tipe_unit' => 'logo',
            'harga' => 1500000,
        ]);
        event(new RincianJasaCreated($rincianJasa6));

        // Rincian untuk jasa "SEO Optimization"
        $rincianJasa7 = RincianJasa::create([
            'nama' => 'Keyword Research',
            'jasa_id' => 8, // Asumsi id jasa "SEO Optimization"
            'unit' => 1,
            'tipe_unit' => 'project',
            'harga' => 800000,
        ]);
        event(new RincianJasaCreated($rincianJasa7));

        $rincianJasa8 = RincianJasa::create([
            'nama' => 'On-Page SEO',
            'jasa_id' => 8,
            'unit' => 1,
            'tipe_unit' => 'halaman',
            'harga' => 1000000,
        ]);
        event(new RincianJasaCreated($rincianJasa8));

        // Rincian untuk jasa "Social Media Marketing"
        $rincianJasa9 = RincianJasa::create([
            'nama' => 'Content Creation',
            'jasa_id' => 8, // Asumsi id jasa "Social Media Marketing"
            'unit' => 1,
            'tipe_unit' => 'post',
            'harga' => 500000,
        ]);
        event(new RincianJasaCreated($rincianJasa9));

        $rincianJasa10 = RincianJasa::create([
            'nama' => 'Ad Management',
            'jasa_id' => 7,
            'unit' => 1,
            'tipe_unit' => 'campaign',
            'harga' => 1500000,
        ]);
        event(new RincianJasaCreated($rincianJasa10));

        // Rincian untuk jasa "Translation Service"
        $rincianJasa11 = RincianJasa::create([
            'nama' => 'Document Translation',
            'jasa_id' => 8, // Asumsi id jasa "Translation Service"
            'unit' => 1,
            'tipe_unit' => 'page',
            'harga' => 200000,
        ]);
        event(new RincianJasaCreated($rincianJasa11));

        $rincianJasa12 = RincianJasa::create([
            'nama' => 'Website Translation',
            'jasa_id' => 8,
            'unit' => 1,
            'tipe_unit' => 'website',
            'harga' => 500000,
        ]);
        event(new RincianJasaCreated($rincianJasa12));

        $rincianJasa14 = RincianJasa::create([
            'nama' => 'Photo Edit',
            'jasa_id' => 1,
            'unit' => 1,
            'tipe_unit' => 'day',
            'harga' => 5000000,
        ]);
        event(new RincianJasaCreated($rincianJasa14));

        $rincianJasa16 = RincianJasa::create([
            'nama' => 'Server Configuration',
            'jasa_id' => 4,
            'unit' => 1,
            'tipe_unit' => 'server',
            'harga' => 500000,
        ]);
        event(new RincianJasaCreated($rincianJasa16));

        // Rincian untuk jasa "Banner Design"
        $rincianJasa17 = RincianJasa::create([
            'nama' => 'Web Banner Design',
            'jasa_id' => 6, // Asumsi id jasa "Banner Design"
            'unit' => 1,
            'tipe_unit' => 'banner',
            'harga' => 750000,
        ]);
        event(new RincianJasaCreated($rincianJasa17));

        $rincianJasa18 = RincianJasa::create([
            'nama' => 'Banner Design',
            'jasa_id' => 6,
            'unit' => 1,
            'tipe_unit' => 'banner',
            'harga' => 1000000,
        ]);
        event(new RincianJasaCreated($rincianJasa18));

    }
}

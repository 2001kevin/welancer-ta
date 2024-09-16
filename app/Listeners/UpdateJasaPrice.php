<?php

namespace App\Listeners;

use App\Events\RincianJasaCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Jasa;
use Illuminate\Support\Facades\Log;

class UpdateJasaPrice
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\RincianJasaCreated  $event
     * @return void
     */
    public function handle(RincianJasaCreated $event)
    {
        $rincianJasa = $event->rincianJasa;
        $jasa = Jasa::find($rincianJasa->jasa_id);

        Log::info('Updating Jasa Prices', ['jasa_id' => $jasa->id]);

        $minPrice = $jasa->rincian_jasa->min('harga');
        $maxPrice = $jasa->rincian_jasa->max('harga');

        Log::info('Min Price', ['min_price' => $minPrice]);
        Log::info('Max Price', ['max_price' => $maxPrice]);

        $jasa->min_price = $minPrice;
        $jasa->max_price = $maxPrice;
        $jasa->save();
    }
}

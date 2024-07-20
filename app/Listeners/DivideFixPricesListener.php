<?php

namespace App\Listeners;

use App\Events\FixPricesUpdated;
use App\Models\termin_pembayaran;
use App\Models\TerminPembayaran;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DivideFixPricesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FixPricesUpdated $event)
    {
        $transaction = $event->transaction;

        // Hitung nilai per termin
        $pricePerTerm = $transaction->fix_price / 3;

        // Ambil tanggal updated_at
        $updatedAt = Carbon::parse($transaction->updated_at);

        // Buat tiga termin transaksi
        for ($i = 1; $i < 4; $i++) {
            if($i == 1){
                TerminPembayaran::create([
                    'transaksi_id' => $transaction->id,
                    'jumlah_pembayaran' => $pricePerTerm,
                    'tanggal_termin' => $updatedAt->copy()->addMonths($i), // Tanggal termin ditambah setiap bulan
                    'status_pembayaran' => 'Waiting Payment',
                    'status_termin' => 'payable',
                ]);
            }else{
                TerminPembayaran::create([
                    'transaksi_id' => $transaction->id,
                    'jumlah_pembayaran' => $pricePerTerm,
                    'tanggal_termin' => $updatedAt->copy()->addMonths($i), // Tanggal termin ditambah setiap bulan
                    'status_pembayaran' => 'Waiting Payment',
                    'status_termin' => 'not payable',
                ]);
            }
        }
    }
}

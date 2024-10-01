<?php

namespace App\Listeners;

use App\Events\TransactionCreated;
use App\Models\TerminPembayaran;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class GenerateTermins
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
    public function handle(TransactionCreated $event)
    {
        $transaction = $event->transaction;
        $fixPrice = $transaction->fix_price; // Total harga transaksi
        $terminRincian = $transaction->rincian; // Rincian termin dari request (array persentase)

        // Inisialisasi array untuk menyimpan nilai termin
        $terminArray = [];
        $updatedAt = Carbon::parse($transaction->updated_at);

        // Loop untuk membagi harga total ke dalam termin berdasarkan persentase
        foreach ($terminRincian as $key => $percentage) {
            // Hitung jumlah termin berdasarkan persentase
            $portion = ($percentage / 100) * $fixPrice;
            $terminArray[] = $portion;

            $statusTermin = ($key === 0) ? 'payable' : 'not payable';
            // Simpan rincian termin ke database
            TerminPembayaran::create([
                'transaksi_id' => $transaction->id,
                'nama' => 'Termin '. $key+1,
                'jumlah_pembayaran' => $portion,
                'tanggal_termin' => $updatedAt->copy()->addMonths($key),
                'status_pembayaran' => 'Waiting Payment',
                'status_termin' => $statusTermin,
            ]);
        }
    }
}

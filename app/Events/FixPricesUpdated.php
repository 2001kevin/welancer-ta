<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\transaksi;
use Illuminate\Support\Facades\Log;

class FixPricesUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transaction;
    public $persenTermin;

    public function __construct(transaksi $transaksi, $persenTermin)
    {
        $this->transaction = $transaksi;
        $this->persenTermin = $persenTermin;
        Log::info('Event FixPricesUpdated triggered for transaction ID: ' . $transaksi->id);
    }
}

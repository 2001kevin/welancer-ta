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

    public function __construct(transaksi $transaksi)
    {
        $this->transaction = $transaksi;
        Log::info('Event FixPricesUpdated triggered for transaction ID: ' . $transaksi->id);
    }
}

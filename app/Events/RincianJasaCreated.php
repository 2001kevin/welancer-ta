<?php

namespace App\Events;

use App\Models\RincianJasa;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RincianJasaCreated
{
    use Dispatchable, SerializesModels;

    public $rincianJasa;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(RincianJasa $rincianJasa)
    {
        $this->rincianJasa = $rincianJasa;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('channel-name');
    }
}

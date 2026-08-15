<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class FabrikantCreate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $fabrikant;

    public function __construct($fabrikant)
    {
        $this->fabrikant = $fabrikant;
    }

    public function broadcastOn()
    {
        return new Channel('fabrikants');
    }

    public function broadcastAs()
    {
        return 'create';
    }

    public function broadcastWith()
    {
        return [
            'fabrikant' => $this->fabrikant->toArray(),
            'message' => "New fabrikant: {$this->fabrikant->name}"
        ];
    }
}
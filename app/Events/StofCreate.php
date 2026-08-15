<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StofCreate implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $stof;

    /**
     * Create a new event instance.
     */
    public function __construct($stof)
    {
        $this->stof = $stof;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn()
    {
        return new Channel('stofs');
       
    }

    public function broadcastAs()
    {
        return "create";
       
    }

    public function broadcastWith()
    {
        return [

            "stof" => $this->stof->toArray()
        ];
       
    }

    


}

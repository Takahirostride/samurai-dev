<?php

namespace App\Modules\Asp\Events;

use Illuminate\Queue\SerializesModels;
class AspClientEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $client;
    public $type;
    public function __construct($type,$client)
    {
        $this->type = $type;
        $this->client = $client;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}

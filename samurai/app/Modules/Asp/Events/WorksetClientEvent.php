<?php

namespace App\Modules\Asp\Events;

use Illuminate\Queue\SerializesModels;
class WorksetClientEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $work_id;
    public function __construct($work_id)
    {
        $this->work_id = $work_id;
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

<?php

namespace App\Modules\Asp\Events;

use Illuminate\Queue\SerializesModels;
class AspPolicyEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $policy;
    public $type;
    public function __construct($type,$policy)
    {
        $this->type = $type;
        $this->policy = $policy;
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

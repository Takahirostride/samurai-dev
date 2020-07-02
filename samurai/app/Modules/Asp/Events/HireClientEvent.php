<?php

namespace App\Modules\Asp\Events;

use Illuminate\Queue\SerializesModels;
class HireClientEvent
{
    use SerializesModels;
    public $hire_id;
    public $type;
    public function __construct($type,$hire_id)
    {
        $this->type = $type;
        $this->hire_id = $hire_id;
    }
    public function broadcastOn()
    {
        return [];
    }        
}    
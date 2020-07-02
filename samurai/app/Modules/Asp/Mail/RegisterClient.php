<?php

namespace App\Modules\Asp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Modules\Asp\Models\AspInvation;
class RegisterClient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $invation;
    public $subject="";
    public function __construct(AspInvation $invation)
    {
        $this->invation = $invation;
        $this->subject = $invation->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Asp::mail.register_client')
                    ->with(['invation'=>$this->invation]);
    }
}

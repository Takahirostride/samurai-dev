<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

class ChangePass extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $mail_id = 5;
    public function __construct($user)
    {
        $this->user     =   $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $user = $this->user;
        $db = DB::table('admin_system_notification')->where('id', $this->mail_id)->first();
        if(!$db) return false;
        $text = nl2br($db->text);
        $this->to($user->e_mail, $user->displayname)
            ->from(  $db->source, 'SAMURAI事務局' )
            ->subject( $db->title );
        
        return $this->html($text);
    }
}

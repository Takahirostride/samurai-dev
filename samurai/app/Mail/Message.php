<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Mail;

class Message extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    protected $text = '';

    public function __construct($data)
    {
        $this->data     =   $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //
        $data = $this->data;
        $user_id = $data['user_id'];
        $hire_id = $data['hire_id'];
        $message = $data['message'];
        
        $hire_first = DB::table('hire')->where('id',$hire_id)->first();
        
        if ((int)$user_id == (int)$hire_first->from_id) 
            $to_id = (int)$hire_first->to_id;
        else 
            $to_id = (int)$hire_first->from_id;
        
        $to_first = DB::table('users')->where('id',$to_id)->first();
        $from_first = DB::table('users')->where('id',$user_id)->first();
        
        if($hire_first->hire_type == 1) {
            $policy_name = DB::table('policy')->where('id',$hire_first->policy_id)->first()->name;
        } else {
            $policy_name = $hire_first->job_title;
        }
        $to_email = $to_first->e_mail;
        
        $subject= '[SAMURAI]メッセージ';
        $datass['displayname'] = $to_first->displayname;
        $datass['policy_name'] = $policy_name;
        $datass['message'] = $message;
        return $this->to($to_email, $to_first->displayname)
            ->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' )
            ->subject( $subject )->view('vendor.emails.message', compact('datass'));
    }
}

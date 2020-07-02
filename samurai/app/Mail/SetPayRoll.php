<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

class SetPayRoll extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $url;
    public function __construct($url)
    {
        $this->url     =   $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = DB::table('users')->where('id', session('user_id'))->first();
        $toEmail = $user->e_mail;
        $displayname = $user->displayname;
        $text = 'お客さまの退会の手続きが完了いたしました。<br>これまでsamuraiをご利用いただき、誠にありがとうございました。<br><br>このメールにお心当たりのない場合は、何も行わずにこのメールを破棄してください。';
        return $this->to($toEmail, $displayname)
            ->from(env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局')
            ->subject( 'samurai：退会完了メール' )
            ->text($text);
    }
}

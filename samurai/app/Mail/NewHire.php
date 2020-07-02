<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Mail;

class NewHire extends Mailable
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
        $data = $this->data;
        $text = date('Y年m月d日 H時i分s秒')."にsamuraiのご登録メールアドレスが変更されました。 <br><br>
                        
                        ・メールアドレスに関するお手続きをした覚えのないお客様<br>
                        お客様以外の方が誤ってお客様のメールアドレスを登録し、メールが誤配信された可能性があります。<br>
                        心当たりのない場合、何も行わずにこのメールを破棄してください。";
        $this->to($data['email_to'], $data['name'])
            ->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' )
            ->subject( 'samurai：メールアドレスの変更' );
        
        return $this->html($text);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Mail;

class NotifyBlockAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $admin_email = 'ihanhoukoku@samurai-match.jp';

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
        $text = "平素は弊社サービスをご利用いただき誠にありがとうございます。 <br>
<br>
".$data['text']."
<br>
<br>
samuraiをご利用いただきありがとうございます。<br>
□ご不明な点がある場合は、お問合せください。<br>
────────────────────────────────<br>
【samurai運営事務局】<br>
〒150-0036東京都渋谷区南平台町3-13　新堀ビル3F<br>
お問い合わせ窓口<br>
https://samurai-match.jp/inquiry/<br>
※原則として、2営業日以内に返信いたします。<br>
※土日祝日はお時間をいただく場合があります。<br>";
        $this->to($this->admin_email, 'SAMURAI')
            ->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' )
            ->subject( 'samurai：違反報告の受け付け' );
        
        return $this->html($text);
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Mail;

class BlockAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

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
        $text = "SAMURAI運営事務局です。<br>
<br>
いつもSAMURAIをご利用頂きましてありがとうございます。<br>
<br>
".$data->username."のアカウントは、SAMURAIの利用規約に反する行為、またはそのおそれがある行為が確認された為停止されました。<br>
https://samurai-match.jp/<br>
にログイン頂き、SAMURAIサポート係までお問い合わせください。<br>
<br>
　　 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
【SAMURAI運営事務局】<br>
　〒150-0036<br>
　東京都渋谷区南平台町3-13<br>
【お問合せ先】<br>
　https://samurai-match.jp/inquiry<br>
<br>
※原則として、3営業日以内に返信いたします。<br>
※土日祝日はお時間をいただく場合があります。<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
　このメールの送信アドレスは送信専用です。<br>
　ご返信頂きましても内容にはお答えできませんのでご注意ください。<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━";
        $this->to($data->e_mail, $data->displayname)
            ->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' )
            ->subject( 'samurai：違反報告の受け付け' );
        
        return $this->html($text);
    }
}

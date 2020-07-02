<?php

namespace App\Modules\Admin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Modules\Admin\Models\User;
class PersonConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $user;
    public $subject="samurai：本人確認完了メール";
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->user->displayname;
        $text = "

        {$name}様の本人確認が完了いたしました。<br>
        本人確認書類の提出を頂きましてありがとうございます。<br><br>
        下記からログインし、ご確認いただけます。<br><br>

        <a href=\"https://samurai-match.jp/\">https://samurai-match.jp/</a>
        ";        
        return $this->view('Admin::employee.customersupport.mailtemp')
                    ->with(['text'=>$text]);
    }
}

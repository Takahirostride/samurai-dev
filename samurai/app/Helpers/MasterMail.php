<?php

namespace App\Helpers;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\swift;
use Illuminate\Support\Facades\Input;
use Mail;
use Api\Users\Requests\CreateUserRequest;
use Api\Users\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Log;

class MasterMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
	
    public function __construct($data)
    {
		$this->data = $data;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
		$data = $this->data;
		$e_mail =$data['e_mail'];
		$state = $data['state'];
		$target = $data['target'];
		$user_name = $data['user_name'];
		$content = $data['content'];
		$type = $data['type'];
		
		if ($type == 0) {
			$text = '[SAMURAI] ユーザー '.$user_name."お問い合わせ対応があります。 必ず確認してください。 送信内容：".$content;
			
			Mail::raw($text, function($message) use($e_mail)
			{
				$message->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' );

				$message->to($e_mail, 'Name')->subject( 'お問い合わせ対応の設定' );
			});
		}
		else if ($type == 1) {
			$text = '[SAMURAI] ユーザー '.$user_name."本人確認書類をサポート。 必ず確認してください。 送信内容：".$content;
			
			Mail::raw($text, function($message) use($e_mail)
			{
				$message->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' );

				$message->to($e_mail, 'Name')->subject( '本人確認書類をサポート。' );
			});
		}
		else if ($type == 2) {
			$text = '[SAMURAI] ユーザー '.$user_name."違反申告対応。 必ず確認してください。 送信内容：".$content;
			
			Mail::raw($text, function($message) use($e_mail)
			{
				$message->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' );

				$message->to($e_mail, 'Name')->subject( '違反申告対応' );
			});
		}
		
    }
}

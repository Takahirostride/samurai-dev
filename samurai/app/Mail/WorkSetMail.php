<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Mail;

class WorkSetMail extends Mailable
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
        //
        
        $hire_id = $data['hire_id'];
        $user_id = $data['user_id'];
        $hire_first = DB::table('hire')->where('id', $hire_id)->first();
        if ((int)$hire_first->from_id == (int)$user_id) 
            $to_id = (int)$hire_first->to_id;
        else 
            $to_id = (int)$hire_first->from_id;
        
        $us1 = DB::table('users')->where('id',$user_id)->first();
        $us2 = DB::table('users')->where('id',$to_id)->first();
        $e_mail1 = $us1->e_mail;
        $e_mail2 = $us2->e_mail;
        $comp1 = (int)$us1->project_progress;
        $comp2 = (int)$us2->project_progress;

        
        $displayname = $us1->displayname;
        
        $schedule = $data['schedule'];
        
        $type = $data['type'];
        $toEmail = $e_mail1;
        $work_set_id = $data['work_set_id'];
        if($comp2 == 1) $toEmail = $e_mail2;

        if($type == 1) {
            $this->text = '[SAMURAI] ユーザー '.$displayname."新しいタスクを登録しました。 必ず確認してください。 スケジュールの日付:".$schedule;
            $this->to($toEmail, $displayname)
            ->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' )
            ->subject( '新しいタスクの登録' );
        }
        
        else if ($type == 2) {
            $this->text = '[SAMURAI] ユーザー '.$displayname."作業内容を編集しました。 スケジュールの日付".$schedule;
            $this->to($toEmail, $displayname)
            ->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' )
            ->subject( '作業内容を編集しました。' );
        }
        
        else if ($type ==3) {
            $this->text = '[SAMURAI] ユーザー '.$displayname."ユーザーが作業id:".$work_set_id."についての作業を完了しました。 スケジュールの日付".$schedule;
            $this->to($toEmail, $displayname)
            ->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' )
            ->subject( '作業内容完了。' );
            
        }
        
        else if ($type ==4) {
            $this->text = '[SAMURAI] ユーザー '.$displayname."ユーザーが作業id:".$work_set_id."についてファイルをアップロードし、新しいタスクを登録しました。  必ず確認してください。";
            $this->to($toEmail, $displayname)
            ->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' )
            ->subject( '作業ファイルをアップロードました。' );
            /*Mail::raw($text, function($message) use($toEmail, $displayname)
            {
                $message->from(  env("MAIL_USERNAME", "info@samurai-match.jp"), 'SAMURAI事務局' );

                $message->to($toEmail, $displayname)->subject( '作業ファイルをアップロードました。' );
            });*/
            
        }
        return $this->html($this->text);
    }
}

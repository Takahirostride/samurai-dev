<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB, Log;

class Bask extends Model {

    public static function hire_submit($data, $user_id, $to_ids, $policy_ids, $submit_type) {

        $cost_client = $data['cost_client'];
        $cost_agency = $data['cost_agency'];
        $cur_date = date("Y-m-d");
        $hire_id = "";
        $idsArray = [];
        foreach ($to_ids as $k => $to_id) {
            foreach ($policy_ids as $kk => $policy_id) {
                if($submit_type==1) {
                    $exist_flag =DB::table('hire')->where('from_id', $user_id)->where('to_id',$to_id)->where('policy_id', $policy_id)->where('finish_flag',0)->where('submit_type',1)
                    ->orWhere(function ($query) use ($user_id, $policy_id , $to_id)
                    {
                        $query->where('to_id', $user_id)->where('from_id',$to_id)->where('policy_id', $policy_id)->where('finish_flag',0)->where('submit_type',1);
                    })->first();
                }else{
                $exist_flag =DB::table('hire')->where('from_id', $user_id)->where('to_id',$to_id)->where('policy_id', $policy_id)->where('finish_flag',0)
                    ->orWhere(function ($query) use ($user_id, $policy_id , $to_id)
                    {
                        $query->where('to_id', $user_id)->where('from_id',$to_id)->where('policy_id', $policy_id)->where('finish_flag',0);
                    })->first();
                }
                if (!$exist_flag) {
                    if ($data['accept'] == 2) {
                        $cost_client = 0;
                        $cost_agency = 0;
                        $datahire['from_id'] = $user_id;
                        $datahire['to_id'] = $to_id;
                        $datahire['policy_id'] = $policy_id;
                        $datahire['deli_date'] = $data['deli_date'];
                        $datahire['deposit_setting'] = $data['deposit_setting'];
                        $datahire['deposit_money'] = $data['deposit_money'];
                        $datahire['content_type'] = $data['content_type'];
                        $datahire['accept'] = $data['accept'];
                        $datahire['cost_client'] = $cost_client;
                        $datahire['cost_agency'] = $cost_agency;
                        $datahire['update_date'] = $cur_date;
                        if($submit_type==1) {
                            $datahire['submit_type'] = '1';
                        }
                        $last_id = DB::table('hire')->insertGetId($datahire);

                        $datames['from_id'] = $user_id;
                        $datames['to_id'] = $to_id;
                        $datames['policy_id'] = $policy_id;
                        $datames['hire_id'] = $last_id;
                        $datames['message'] = $data['message'];
                        $datames['update_date'] = $cur_date;
                        $last_id_m = DB::table('message')->insertGetId($datames);

                        $idsArray[]= $last_id_m;

                        if (!DB::table('message_allow')->where('user_id', $to_id)->where('to_id',$user_id)->first()) {
                            DB::table('message_allow')->insert(['user_id'=>$user_id, 'to_id'=>$to_id, 'allow'=>'1']);
                        }
                        if($submit_type==1) {
                            //E_Mail Part
                            // $data = array("from_id"=>$user_id,"to_id"=>$to_id,"policy_id"=>$policy_id);
                            // $job = (new JobsRequested($data))->delay(60);
                            // $this->dispatch($job);
                        }else{

                        // $mail_data['name'] = "SAMURAI事務局";
                        // $mail_data['email_to'] = $new_email;
                        // $date = date('Y年m月d日 H時i分s秒');
                        // $text = "
                        // {$date}にsamuraiのご登録メールアドレスが変更されました。 <br><br>
                        
                        // ・メールアドレスに関するお手続きをした覚えのないお客様<br>
                        // お客様以外の方が誤ってお客様のメールアドレスを登録し、メールが誤配信された可能性があります。<br>
                        // 心当たりのない場合、何も行わずにこのメールを破棄してください。";
                
                        // Mail::send('mailtemp', ['text' => $text], function($message) use ($mail_data)
                        // {
                        //     $message->from( env("MAIL_USERNAME", "info@samurai-match.jp"), $mail_data['name']);
                
                        //     $message->to($mail_data['email_to'], 'Name')->subject('samurai：メールアドレスの変更');
                        // });
                        }
                    }
                    if($data['accept'] == 0) {
                        $cost_client = 0;
                        $datahire['from_id'] = $user_id;
                        $datahire['to_id'] = $to_id;
                        $datahire['policy_id'] = $policy_id;
                        $datahire['deli_date'] = $data['deli_date'];
                        $datahire['deposit_setting'] = $data['deposit_setting'];
                        $datahire['deposit_money'] = $data['deposit_money'];
                        $datahire['content_type'] = $data['content_type'];
                        $datahire['accept'] = $data['accept'];
                        $datahire['cost_client'] = $cost_client;
                        $datahire['cost_agency'] = $cost_agency;
                        $datahire['update_date'] = $cur_date;

                        if($submit_type==1) {
                            $datahire['submit_type'] = '1';
                        }
                        $last_id = DB::table('hire')->insertGetId($datahire);
                    }

                } else {
                    if ($data['accept'] == 0) {  //update hire table with cost.
                        $updatehire = [
                                'deposit_money'=>$data['deposit_money'],
                                'content_type'=>$data['content_type'],
                                'cost_agency'=>$cost_agency,
                                'accept'=>$data['accept'],
                                'deposit_setting'=>$data['deposit_setting']];
                        if($submit_type==1) {
                            $updatehire['submit_type'] = '1';
                        }

                        DB::table('hire')->where('id',$exist_flag->id)
                                ->update($updatehire);
                    }  else {
                        $datames['from_id'] = $user_id;
                        $datames['to_id'] = $to_id;
                        $datames['policy_id'] = $policy_id;
                        $datames['hire_id'] = $exist_flag->id;
                        $datames['message'] = $data['message'];
                        $datames['update_date'] = $cur_date;
                        $last_id_m = DB::table('message')->insertGetId($datames);
                        $idsArray[]= $last_id_m;

                        if (!DB::table('message_allow')->where('user_id', $to_id)->where('to_id',$user_id)->first()) {
                            DB::table('message_allow')->insert(['user_id'=>$user_id, 'to_id'=>$to_id, 'allow'=>'1']);
                        }
                        if($submit_type==1) {
                            //E_Mail Part
                            // $data = array("from_id"=>$user_id,"to_id"=>$to_id,"policy_id"=>$policy_id);
                            // $job = (new JobsRequested($data))->delay(60);
                            // $this->dispatch($job);
                        } 
                    }
                    $hire_id = $exist_flag->id;
                }
            }
        }
        $rs['ids']=$idsArray;
        $rs['hire_id']=$hire_id;
        return $rs;
    }
}
// 予定納期 = deli_date
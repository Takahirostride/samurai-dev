<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\MasterMail;
use Log;
use DB;
use Mail;
use App\Models\SeminarRegistered, App\Models\AdminEditInfo, App\Models\Category, App\Models\SubCategory, App\Models\Question;
use App\Helpers\UploadFile;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $infos = DB::table('admin_edit_info')->orderBy('edit_time', 'desc')->paginate(1000);
        return view("Admin::employee.index", ['infos'=>$infos]);
    }
    /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   get Inquiry
    *   @return     :
    */
    public function getInquiry($status = 0)
    {
        $admin_id = session('id'); // $exist_flag->login_id;
        $admin_name = session('admin_name'); // $exist_flag->name;
        $limit = 10;
        $displaystatusstring = array('0' => "答えなし" , "1"=> "答えあり" );
        if ($status == 0){
            $inquiry = DB::table('faq')->join('users','users.id','=','faq.user_id')->select('faq.id','faq.state','faq.faq_content','users.displayname','users.e_mail',
                       'faq.faq_title','faq.created_at'
                       ,'users.image','users.displayname','users.id as user_id','users.manage_flag')->paginate($limit);
        }elseif($status == 1) {
            $inquiry = DB::table('faq')->join('users','users.id','=','faq.user_id')->select('faq.id','faq.state','faq.faq_content','users.displayname','users.e_mail',
                        'faq.faq_title','faq.created_at'
                        ,'users.image','users.displayname','users.id as user_id','users.manage_flag')->where('faq.state',1)->paginate($limit);
        }elseif($status == 2) {
            $inquiry = DB::table('faq')->join('users','users.id','=','faq.user_id')->select('faq.id','faq.state','faq.faq_content','users.displayname','users.e_mail',
                        'faq.faq_title','faq.created_at' ,'users.image','users.displayname','users.id as user_id','users.manage_flag')
                        ->where('faq.state',0)->paginate($limit);
        }
        foreach ($inquiry as $key => $value) {
            if($value->state == 1){
                $answer_name = DB::table('faq_answers')->join('admin','admin.id','=','faq_answers.answer_id')->where('faq_id',$value->id)
                                ->select('admin.name as answer_name','faq_answers.answers')->first();

                if($answer_name){
                    $value->answer_name = $answer_name->answer_name;
                 }else{
                    $value->answer_name =""; 
                 }
               
            }else{
                $value->answer_name ="";  
            }  
        }
        if($status != 0){
            $inquiry->setPath($status);
        }

        $template = DB::table('faq_template')->get();
        $template1 = array();
        if($template){
            foreach ($template as $key => $value) {
                $template1[$value->id] = $value->item_name;
            }   
        }
        
        return view("Admin::employee.customersupport.inquiry", ['inquiry'=>$inquiry,
                                                                'displaystatusstring'=> $displaystatusstring,
                                                                'admin_id'=>$admin_id,
                                                                'admin_name' =>$admin_name,
                                                                'template' => $template1,
                                                                'status'=>$status]);
    }
     /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   getInquirybyid
    *   @return     :
    */
    public function getInquirybyid($id)
    {
        $result = DB::table('faq')->join('users','users.id','=','faq.user_id')->select('faq.id','faq.state','faq.faq_content','users.e_mail',
                        'faq.faq_title','faq.created_at' ,'users.image','users.displayname','users.id as user_id','users.manage_flag')
                        ->where('faq.id',$id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }
      /**
    *   Created by  :   Quang Thắng 5/10/2018 
    *   Description :   insertFaq_answers
    *   @return     :
    */
    public function insertFaq_answers(Request $request)
    {
        
        $faq_id = $request->faq_id;
        $admin_id = $request->admin_id;
        $text = $request->text;
        $user_id = $request->user_id;
        $state = 0;
        
        $result = DB::table('faq_answers')->insert(array('faq_id' => $faq_id, 
                                                   'answer_id' => $admin_id,
                                                   'answers'=> $text,
                                                   'state' => $state ));
        
        // log table master_mail 
        $target = 'お問い合わせ対応';
        $state = '承認';
        $created_at = date("Y-m-d");

        $result2 = DB::table('master_mail')->insert(array( 'admin_id' => $admin_id, 
                                                           'user_id' => $user_id,
                                                           'state' => $state,
                                                           'title' => $text,
                                                           'created_at' => $created_at,
                                                           'target'=> $target ));

        // send mail for user
        $data_mail['email'] = $request->e_mail;
        $data_mail['name'] = "SAMURAI事務局";
        $text = "
        この度は、samuraiへのお問い合わせいただき、誠にありがとうございます。 <br><br>
        お問い合わせ内容ご返信させていただきましたので、マイページよりご確認ください。<br>
        ";
        if($result2 && $result){
            Mail::send('Admin::employee.customersupport.mailtemp', ['text' => $text], function ($m) use ($data_mail) {
                $m->to($data_mail['email'], $data_mail['name'])->subject('samurai：お問い合わせありがとうございます。');
            });
            $request->session()->flash('message', 'Success');
        }else{
            $request->session()->flash('message', 'Error');

        }
        return redirect('admin/employee/customersupport/inquiry/');
    }
      /**
    *   Created by  :   Quang Thắng 5/10/2018 
    *   Description :   updateStatefaq
    *   @return     :
    */
    public function updateStatefaq(Request $request)
    {
        $faq_id = $request->faq_id1;
        $answer_id = $request->admin_id1;
        $answers = $request->Text1;
        $status = $request->status;

        $result = DB::table('faq_answers')->insert(array(  'faq_id' => $faq_id, 
                                                           'answer_id' => $answer_id,
                                                           'answers'=> $answers,
                                                           'state' => $status ));
        $result1 = DB::table('faq')->where('id',$faq_id)->update(['state'=>$status]);
        if($result && $result1){
            $request->session()->flash('message', 'Success');
        }else{
             $request->session()->flash('message', 'Error');
        }
        return redirect('admin/employee/customersupport/inquiry/');
    }
      /**
    *   Created by  :   Quang Thắng 8/10/2018 
    *   Description :   getContact
    *   @return     :
    */
    public function getContact($id = 0)
    {
        
        $limit = 10;
        $result = DB::table('faq_template')->paginate($limit);
        return view("Admin::employee.customersupport.contact",[ 'result'=>$result]);
    }
      /**
    *   Created by  :   Quang Thắng 8/10/2018 
    *   Description :   getContact
    *   @return     :
    */
    public function delContact(Request $request)
    {
        $del = $request->yes;
        $result = DB::table('faq_template')->whereIn('faq_template.id',$del)->delete();
        if($result){
            return redirect('admin/employee/customersupport/contact/');
        }
        
    }
      /**
    *   Created by  :   Quang Thắng 8/10/2018 
    *   Description :   updateContact
    *   @return     :
    */
    public function updateContact(Request $request) {
        $edit_type = $request->edit_type;
        $item_name  = $request->item_name;
        $title = $request->title;
        $text = $request->text;
        if($edit_type == 0){
            $result = DB::table('faq_template')->insert(array(  'item_name' => $item_name, 
                                                                'title' => $title,
                                                                'text' => $text));
        }else{
            $temp_id = $request->template_id;
            $result = DB::table('faq_template')->where('id',$temp_id)
                                               ->update(['item_name'=>$item_name,'title'=>$title,'text'=>$text]);
        }    
        return redirect('admin/employee/customersupport/contact/');
    }
      /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   getContactbyid
    *   @return     :
    */
    public function getContactbyid($id)
    {
        $result = DB::table('faq_template')->where('faq_template.id',$id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }    
       /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   getIdentifydoc
    *   @return     :
    */
    public function getIdentifydoc($status=0)
    {
        $admin_id = session('id'); // $exist_flag->login_id;
        $admin_name = session('admin_name'); // $exist_flag->name;
        $limit = 10;
        $arr_state = array('0' => "未承認" , "1"=> "承認" );
        if ($status == 0){
            $identify = DB::table('person_confirm')->join('users','users.id','=','person_confirm.user_id')
                                 ->select('person_confirm.id','users.displayname','person_confirm.update_at','person_confirm.state'
                                 ,'person_confirm.address','person_confirm.allow','person_confirm.birthday','person_confirm.files','person_confirm.name','users.image','users.manage_flag','users.id as user_id')->paginate($limit);
        }elseif($status == 1) {
            $identify = DB::table('person_confirm')->join('users','users.id','=','person_confirm.user_id')
                                  ->select('person_confirm.id','users.displayname','person_confirm.update_at','person_confirm.state','person_confirm.name'
                                 ,'person_confirm.address','person_confirm.allow','person_confirm.birthday','person_confirm.files','users.image','users.manage_flag','users.id as user_id')
                ->where('person_confirm.state',1)->paginate($limit);
        }elseif($status == 2) {
            $identify = DB::table('person_confirm')->join('users','users.id','=','person_confirm.user_id')
                                 ->select('person_confirm.id','users.displayname','person_confirm.files',
                                'person_confirm.allow','person_confirm.update_at','person_confirm.state','person_confirm.name','users.image','person_confirm.address','person_confirm.birthday'
                                ,'users.manage_flag','users.id as user_id')
                                ->where('person_confirm.state',0)->paginate($limit);
        }
        foreach ($identify as $key => $value) {
            if($value->state == 1){
                $answer_name = DB::table('person_confirm_answers')->join('admin','admin.id','=','person_confirm_answers.answer_id')->where('person_confirm_answers.person_confirm_id',$value->id)
                                ->select('admin.name as answer_name','person_confirm_answers.answers','person_confirm_answers.complete')->first();

                if($answer_name){
                    $value->answer_name = $answer_name->answer_name;
                    $value->answers = $answer_name->answers;
                 }else{
                    $value->answer_name =""; 
                    $value->answers = '';
                 }
               
            }else{
                $value->answer_name ="";  
                $value->answers = '';
            }
            
        }
        if($status != 0){
            $identify->setPath($status);
        }
        $template = DB::table('person_confirm_template')->get();
        foreach ($template as $key => $value) {
            $template1[$value->id] = $value->item_name;
        }
        return view("Admin::employee.customersupport.identifydoc", ['identify'=>$identify,
                                                                'arr_state'=> $arr_state,
                                                                'admin_id'=>$admin_id,
                                                                'admin_name' =>$admin_name,
                                                                'template' => $template1,
                                                                'status'=>$status]);

    }
       /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   getIdentifydoc
    *   @return     :
    */
    public function getidentifybyid($id)
    {
        $result = DB::table('person_confirm')->where('person_confirm.id',$id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }
       /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   getDownload
    *   @return     :
    */
    public function getDownload(Request $request)
    {
        $file= public_path()."/".$request->link;
        $name = $request->name;
        $headers = array(
          'Content-Type: application/pdf',
        );
        $link = str_replace("/", "AND&", $request->link);
        return redirect('/employee/customersupport/downloadfile/'.$link.'/'.$name);
    }
        /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   downloadurl
    *   @return     :
    */
    public function downloadurl($link, $name)
    {
        Log::info('Download file'.$link.$name);
        $link = str_replace("AND&","/",$link);
        $file = public_path()."/".$link;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return \Response::download($file, $name, $headers);
    }
         /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   getPersonconfirmtemplatebyid
    *   @return     :
    */
    public function getPersonconfirmtemplatebyid($id)
    {
        $result = DB::table('person_confirm_template')->where('person_confirm_template.id',$id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }
         /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   addPersonconfirmanswers
    *   @return     :
    */
    public function addPersonconfirmanswers(Request $request){
        $template_id = $request->template_id;
        $user_id = $request->user_id;
        $person_confirm_id = $request->person_confirm_id;
        $admin_id = $request->admin_id;
        $template = DB::table('person_confirm_template')->where('id', $template_id)->first();
        $result =  DB::table('person_confirm')->where('id',$person_confirm_id)
                                              ->update(['state'=>1,'allow'=>$template->complete]);

        $result2 = DB::table('person_confirm_answers')->insert(array( 'person_confirm_id' => $person_confirm_id, 
                                                                      'answer_id' => $admin_id,
                                                                      'complete' => $template->complete,
                                                                      'answers' => $template->text ));

        $e_mail  = DB::table('users')->where('id',$user_id)->first()->e_mail;
        $user_name = DB::table('users')->where('id',$user_id)->first()->displayname;

        $target = '本人確認書類対応';
        $state = '承認';
        $created_at = date("Y-m-d");

        $result3 = DB::table('master_mail')->insert(array( 'admin_id' => $admin_id, 
                                                           'user_id' => $user_id,
                                                           'target' => $target,
                                                           'state' => $state, 
                                                           'title' => $template->text,
                                                           'created_at' => $created_at));

        $data = array('e_mail'=>$e_mail, 'state'=>$state,'target'=>$target,'created_at'=>$created_at,'user_name'=>$user_name
        ,'content'=>$template->text, 'type'=>1);
        
        $job = (new MasterMail($data))->delay(60);
        $this->dispatch($job);
        return redirect('admin/employee/customersupport/identifydoc/');
    }
         /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   addPersonconfirmanswers2
    *   @return     :
    */
    public function addPersonconfirmanswers2(Request $request){
        $person_confirm_id = $request->person_confirm_id1;
        $admin_id = $request->admin_id1;
        $answers = $request->answers;
        $allow = $request->allow;

        DB::table('person_confirm')->where('id',$person_confirm_id)->update(['state'=>$allow,'allow'=>$allow]);
        DB::table('person_confirm_answers')->insert(array( 'person_confirm_id' => $person_confirm_id, 
                                                           'answer_id' => $admin_id,
                                                           'answers' => $answers,
                                                           'complete' => $allow));

        $user_id = DB::table('person_confirm')->where('id',$person_confirm_id)->first()->user_id;
        $userdata = DB::table('users')->where('id', $user_id)->first();

        // $mail_data['mail_address_to'] = $userdata->e_mail;
        // $mail_data['mail_name_to'] = $userdata->displayname;
        // $mail_data['subject'] = 'samurai：本人確認完了メール';
        // $text = "

        // {$mail_data['mail_name_to']}様の本人確認が完了いたしました。<br>
        // 本人確認書類の提出を頂きましてありがとうございます。<br><br>
        // 下記からログインし、ご確認いただけます。<br><br>

        // <a href=\"https://samurai-match.jp/\">https://samurai-match.jp/</a>
        // ";
        Mail::queue(new \App\Mail\PersonConfirm($userdata));

        // Mail::send('Admin::employee.customersupport.mailtemp', ['text' => $text], function($message) use ($mail_data)
        // {
        //     $message->from( env("MAIL_USERNAME", "info@samurai-match.jp"), env("MAIL_FROMNAME", "SAMURAI事務局"));

        //     $message->to($mail_data['mail_address_to'], $mail_data['mail_name_to'])->subject($mail_data['subject']);
        // });

        return redirect('admin/employee/customersupport/identifydoc/');
    }
          /**
    *   Created by  :   Quang Thắng 9/10/2018 
    *   Description :   getIdentifyphrase
    *   @return     :
    */
    public function getIdentifyphrase()
    {
        $limit = 10;
        $displaystatusstring = array('0' =>'未承認' , '1' => '承認');
        $result = DB::table('person_confirm_template')->paginate($limit);
        return view("Admin::employee.customersupport.identifyphrase",[ 'result'=>$result,
                                                                        'displaystatusstring' => $displaystatusstring]);
    }
      /**
    *   Created by  :   Quang Thắng 9/10/2018 
    *   Description :   updateIdentifyphrase
    *   @return     :
    */
    public function updateIdentifyphrase(Request $request) {
        $edit_type = $request->edit_type;
        $complete = $request->complete;
        $item_name  = $request->item_name;
        $title = $request->title;
        $text = $request->text;
        // echo $complete;
        if($edit_type == 0){
            $result = DB::table('person_confirm_template')->insert(array(  'item_name' => $item_name, 
                                                                'complete' => $complete,
                                                                'title' => $title,
                                                                'text' => $text));
        }else{
            $temp_id = $request->template_id;
            $result = DB::table('person_confirm_template')->where('id',$temp_id)
                                               ->update(['item_name'=>$item_name,'complete'=>$complete,'title'=>$title,'text'=>$text]);
        }    
        return redirect('admin/employee/customersupport/identifyphrase/');
    }
       /**
    *   Created by  :   Quang Thắng 9/10/2018 
    *   Description :   getIdentifyphrasebyid
    *   @return     :
    */
    public function getIdentifyphrasebyid($id)
    {
        $result = DB::table('person_confirm_template')->where('person_confirm_template.id',$id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }  
      /**
    *   Created by  :   Quang Thắng 8/10/2018 
    *   Description :   delIdentifyphrase
    *   @return     :
    */
    public function delIdentifyphrase(Request $request)
    {
        $del = $request->yes;
        $result = DB::table('person_confirm_template')->whereIn('person_confirm_template.id',$del)->delete();
        if($result){
            return redirect('admin/employee/customersupport/identifyphrase/');
        }
        
    }  
    // getViolator
    public function getViolator($status=0)
    {
        $admin_id = session('id'); // $exist_flag->login_id;
        $admin_name = session('admin_name'); // $exist_flag->name;
        $limit = 10;
        $arr_state = array('0' => "未承認" , "1"=> "承認" );
        $getAccountStatus = array('0' => '停止','1' =>'解除' );

        if ($status == 0){
            $violator = DB::table('report')->join('users','users.id','=','report.report_id')
                                           ->select('report.id','users.displayname as report_name','users.displayname as user_name','users.permission','users.manage_flag as report_user_manage_flag','report.report_id','report.created_date','report.state','report.message','report.user_id')->paginate($limit);
        }elseif($status == 1) {
            $violator = DB::table('report')->join('users','users.id','=','report.report_id')
                                           ->select('report.id','users.displayname as report_name','users.displayname as user_name','users.permission','users.manage_flag as report_user_manage_flag','report.report_id','report.created_date','report.state','report.message','report.user_id')->where('report.state',1)->paginate($limit);
        }elseif($status == 2) {
            $violator = DB::table('report')->join('users','users.id','=','report.report_id')
                                           ->select('report.id','users.displayname as report_name','users.displayname as user_name','users.permission','users.manage_flag as report_user_manage_flag','report.report_id','report.created_date','report.state','report.message','report.user_id')->where('report.state',0)->paginate($limit);
        }
        foreach ($violator as $key => $value) {
            $first =DB::table('report_answers')->where('report_id', $value->id)->first();
            if ($first)
                $value->correspond = DB::table('admin')->where('id',$first->admin_id)->first()->name;
            else
                $value->correspond = '';

            $value->answers = json_decode(DB::table('report_answers')->join('admin','admin.id','=','report_answers.admin_id')
                ->where('report_id',$value->id)->select('report_answers.*','admin.name as answer_name')->get(), true);
            
        }
        if($status != 0){
            $violator->setPath($status);
        }
        $template = DB::table('report_template')->get();
        foreach ($template as $key => $value) {
            $template1[$value->id] = $value->item_name;
        }
        return view("Admin::employee.customersupport.violator", ['violator'=>$violator,
                                                                'arr_state'=> $arr_state,
                                                                'admin_id'=>$admin_id,
                                                                'admin_name' =>$admin_name,
                                                                'template' => $template1,
                                                                'getAccountStatus' => $getAccountStatus,
                                                                'status'=>$status]);

    }

          /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   getViolatorbyid
    *   @return     :
    */
    public function getViolatorbyid($id)
    {
        $result = DB::table('report')->rightJoin('users','users.id','=','report.report_id')
                                     ->select('report.id','users.displayname as report_name','users.displayname as user_name','users.permission','users.manage_flag as report_user_manage_flag','report.report_id','report.created_date','report.state','report.message','report.user_id')->where('report.id',$id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }
          /**
    *   Created by  :   Quang Thắng 4/10/2018 
    *   Description :   getViolatortemplatebyid
    *   @return     :
    */
    public function getViolatortemplatebyid($id)
    {
        $result = DB::table('report_template')->where('report_template.id',$id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }
      /**
    *   Created by  :   Quang Thắng 10/10/2018 
    *   Description :   updateViolation
    *   @return     :
    */
    public function updateViolation(Request $request) {
       $report_id = $request->report_id;
        $text=  $request->text;
        $admin_id = $request->admin_id;
        $template_id = $request->template_id;
        $complete = $request->complete;

        if ($complete == 0)
            $permission = 1;
        else
            $permission = 0;

        DB::table('report')->where('id',$report_id)->update(['state'=>1]);

        $report_user_id = DB::table('report')->where('id',$report_id)->first()->report_id;

        DB::table('users')->where('id',$report_user_id)->update(['permission'=>$permission]);

        DB::table('report_answers')->insert(array( 'report_id' => $report_id, 
                                                           'admin_id' => $admin_id,
                                                           'permission' => $permission,
                                                           'answers' => $text));


        $user_id = $report_user_id;

        $users = DB::table('users')->where('id',$user_id)->first();

        $e_mail ="";
        $user_name ="";
        if($users){
            $e_mail = $users->e_mail;
            $user_name = $users->displayname;
        }

        $target = '違反申告対応';
        $state = '承認';
        $created_at = date("Y-m-d");

        DB::table('master_mail')->insert(array( 'admin_id' => $admin_id, 
                                                'user_id' => $user_id,
                                                'target' => $target,
                                                'created_at' => $created_at,
                                                'title' => $text,
                                                'state' => $state));

        $data = array('e_mail'=>$e_mail, 'state'=>$state,'target'=>$target,'created_at'=>$created_at,'user_name'=>$user_name
        ,'content'=>$text, 'type'=>2);
         // $data = array('e_mail'=>"jonny89do@gmail.com", 'state'=>$state,'target'=>$target,'created_at'=>$created_at,'user_name'=>$user_name
        // ,'content'=>$text, 'type'=>2);
        $job = (new MasterMail($data))->delay(60);
        $this->dispatch($job);

        return redirect('admin/employee/customersupport/violator/');
    }
    
      /**
    *   Created by  :   Quang Thắng 10/10/2018 
    *   Description :   updateViolation2
    *   @return     :
    */
    public function updateViolation2(Request $request) {
        $report_id = $request->report_id2;
        $allow=  $request->allow;
        $admin_id = $request->admin_id2;
        $answers = $request->answers;

        DB::table('report_answers')->insert(array( 'report_id' => $report_id, 
                                                'admin_id' => $admin_id,
                                                'permission' => $allow,
                                                'answers' => $answers));

        $report_user_id = DB::table('report')->where('id',$report_id)->first()->report_id;

        DB::table('report')->where('id',$report_id)->update(['state'=>1]);

        DB::table('users')->where('id',$report_user_id)->update(['permission'=>$allow]);

        return redirect('admin/employee/customersupport/violator/');
    }
       /**
    *   Created by  :   Quang Thắng 9/10/2018 
    *   Description :   getViolatorphrase
    *   @return     :
    */
    public function getViolatorphrase()
    {
        $limit = 10;
        $displaystatusstring = array('0' =>'未承認' , '1' => '承認');
        $result = DB::table('report_template')->paginate($limit);
        return view("Admin::employee.customersupport.violatorphrase",[ 'result'=>$result,
                                                                        'displaystatusstring' => $displaystatusstring]);
    }
       /**
    *   Created by  :   Quang Thắng 9/10/2018 
    *   Description :   updateIdentifyphrase
    *   @return     :
    */
    public function updateViolatorphrase(Request $request) {
        $edit_type = $request->edit_type;
        $complete = $request->complete;
        $item_name  = $request->item_name;
        $title = $request->title;
        $text = $request->text;
        // echo $complete;
        if($edit_type == 0){
            $result = DB::table('report_template')->insert(array(  'item_name' => $item_name, 
                                                                'complete' => $complete,
                                                                'title' => $title,
                                                                'text' => $text));
        }else{
            $temp_id = $request->template_id;
            $result = DB::table('report_template')->where('id',$temp_id)
                                               ->update(['item_name'=>$item_name,'complete'=>$complete,'title'=>$title,'text'=>$text]);
        }    
        return redirect('admin/employee/customersupport/violatorphrase/');
    }
       /**
    *   Created by  :   Quang Thắng 9/10/2018 
    *   Description :   getViolatorphrasebyid
    *   @return     :
    */
    public function getViolatorphrasebyid($id)
    {
        $result = DB::table('report_template')->where('report_template.id',$id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }  
      /**
    *   Created by  :   Quang Thắng 8/10/2018 
    *   Description :   delViolatorphrase
    *   @return     :
    */
    public function delViolatorphrase(Request $request)
    {
        $del = $request->yes;
        $result = DB::table('report_template')->whereIn('report_template.id',$del)->delete();
        if($result){
            return redirect('admin/employee/customersupport/violatorphrase/');
        }
        
    }  
       /**
    *   Created by  :   Quang Thắng 8/10/2018 
    *   Description :   getManageadvertise
    *   @return     :
    */
    public function getManageadvertise(Request $request)
    {
        
        $keyword = $request->keyword;
        $status = array();
        $date_flag = 1;
        $limit = 10;
        if($request->startyear != "" && $request->startmonth != "" && $request->startday != "" && $request->endyear != "" && $request->endmonth != "" && $request->endday != "" ){
            $update_start = $request->startyear."-".$request->startmonth.'-'.$request->startday;
            $update_end = $request->endyear."-".$request->endmonth.'-'.$request->endday;
            $date_flag == 0;
        }

        $status_list = array('0' => 0 , '1' => 1, '2' => 2,'3' => 3,'4'=>4);
        $result = array();
        $re_link = 'admin/employee/customersupport/manageadvertise';
        if(isset($request->search)){
            if($request->status == 4){
            $status = $status_list;
            }else{
                $status[$request->status] = $status_list[$request->status];
            }
            if ($date_flag == 0) {

            $result  = DB::table('seller_policy')->where('seller_policy.created_at', '>=',$update_start)->where('seller_policy.created_at', '<=',$update_end)
                ->whereIn('ad_status', $status)
                ->join('policy','policy.id','=','seller_policy.policy_id')
                ->join('seller', 'seller.id', '=','seller_policy.seller_id')
                ->where('policy.name', 'LIKE', '%'.$keyword.'%')
                ->select('policy.name as policy_name','seller.*','seller_policy.*')->orderBy('seller_policy.created_at', 'desc')->paginate($limit);
            }
            else if ($date_flag == 1) {
                $result  = DB::table('seller_policy')
                    ->whereIn('ad_status', $status)
                    ->join('policy','policy.id','=','seller_policy.policy_id')
                    ->join('seller', 'seller.id', '=','seller_policy.seller_id')
                    ->where('policy.name', 'LIKE', '%'.$keyword.'%')
                    ->select('policy.name as policy_name','seller.*','seller_policy.*')->orderBy('seller_policy.created_at', 'desc')->paginate($limit);
            }
            $link = '?sub_status='.$request->sub_status.'&keyword='.$request->keyword.'&startyear='.$request->startyear.'&startmonth='.$request->startmonth.'&startday='.$request->startday.'&endyear='.$request->endyear.'&endmonth='.$request->endmonth.'&endday='.$request->endday.'&status='.$request->status.'&search=検索する';
            $result->setPath($link);
            $re_link .= $link; 
        }
        $getstatusstring = array('0' => '掲載依頼' , '1' => '掲載中', '2' => '掲載不可','3' => '掲載終了');
        return view("Admin::employee.customersupport.manageadvertise",['result' =>$result,
                                                                        'getstatusstring' =>$getstatusstring,
                                                                        'status' => $status,
                                                                        're_link' =>$re_link]);
    }
       /**
    *   Created by  :   Quang Thắng 10/10/2018 
    *   Description :   changestatusitem
    *   @return     :
    */
    public function changeStatusitem(Request $request){
        $id = $request->id;
        $status = $request->status;
        $result = DB::table('seller_policy')->where('id',$id)->update(['ad_status'=> $status]);
        return $result;

    }
       /**
    *   Created by  :   Quang Thắng 10/10/2018 
    *   Description :   changeStatusitemall
    *   @return     :
    */
    public function changeStatusitemall(Request $request){
        $arr_id = $request->yes;
        $status = $request->status1;
        $re_link = $request->re_link;
        print_r($arr_id);
        die;
        switch ($status) {
            case 0:
                DB::table('seller_policy')->whereIn("id", $arr_id)->update(['ad_status'=>0]);
                return redirect($re_link);
                break;
            case 1:
                DB::table('seller_policy')->whereIn("id", $arr_id)->update(['ad_status'=>1]);
                return redirect($re_link);
                break;
            case 2:
                DB::table('seller_policy')->whereIn("id", $arr_id)->update(['ad_status'=>2]);
                return redirect($re_link);
                break;
            case 3:
                DB::table('seller_policy')->whereIn("id", $arr_id)->update(['ad_status'=>3]);
                return redirect($re_link);
                break;
            case 4:
                DB::table('seller_policy')->whereIn("id", $arr_id)->delete();
                return redirect($re_link);
                break;
            default:
                break;
        }
        return redirect('admin/employee/customersupport/manageadvertise');

    }
       /**
    *   Created by  :   Quang Thắng 11/10/2018 
    *   Description :   advertiseEdit
    *   @return     :
    */
    public function advertiseEdit(Request $request){

        $id= $request->id;
        $limit = 10;
        $result = DB::table('seller')->join('seller_policy','seller_policy.seller_id','=','seller.id')
                                     ->join('policy','policy.id','=','seller_policy.policy_id')
                                     ->select('seller_policy.id','seller_policy.policy_id','policy.name as policy_name', 'end_days', 'available_months', 'ad_status','ad_status_self', 'display_status','paid', 'seller.title','seller.image_url','seller.content','seller.url','seller.image_name','seller.charge')->where('seller.user_id', $id)->paginate($limit);
        return view("Admin::employee.customersupport.advertiseedit",['result'=> $result]);
    }
       /**
    *   Created by  :   Quang Thắng 11/10/2018 
    *   Description :   advertiseMessage
    *   @return     :
    */
    public function advertiseMessage(Request $request){

        $id= $request->id;
        $result =DB::table('seller')
            ->join('users','users.id','=','seller.user_id')
            ->where('seller.id', $id)
            ->select('seller.*','users.image','users.company_name','users.location','users.self_intro','users.phone_number','users.municipality','users.displayname','users.id as user_id')
            ->get();

        // get message    
        $user_id = session('id');
        $from_ids = array();
        foreach ($result as $key => $value) {
           $from_ids[$key] = $value->user_id;
        }
        
        $type = 2;
        $result2 = DB::table('message_seller')
            ->whereIn('message_seller.from_id', $from_ids)
            ->where('message_seller.to_id', $user_id)
            ->where('type', $type)
            ->orWhere(function ($query) use ($user_id, $from_ids, $type)
            {
                $query->whereIn('message_seller.to_id', $from_ids)
                    ->where('message_seller.from_id', $user_id)
                    ->where('type', $type);
            })
            ->join('users','users.id','=','message_seller.from_id')
            ->select('message_seller.*', 'users.id as user_id', 'users.displayname','users.image')
            ->get();

        //print_r($result2); die;   
        return view("Admin::employee.customersupport.advertisemessage",['result'=> $result,
                                                                        'result2'=> $result2,
                                                                        'user_id' => $user_id,
                                                                        'from_ids'=> $from_ids]);
    }
       /**
    *   Created by  :   Quang Thắng 13/10/2018 
    *   Description :   sendMessage
    *   @return     :
    */
    public function sendMessage(Request $request){
        $from_id = $request->from_id;
        $message = $request->message;
        $to_ids = $request->to_ids;
        $type = $request->type;
        $policy_id = $request->policy_id;
        $update_date = date("Y-m-d");
        $arr_to_ids = json_decode($to_ids, false);
        $output_ids = [];
        $count_file = $request->count_file;
        $path = [];
        $totalArray = [];
        
        foreach ($arr_to_ids as $key => $value) {
            // insert message_seller
            $id = DB::table('message_seller')->insertGetId(array('from_id'=>$from_id,'policy_id'=>$policy_id,'to_id'=>$value,'update_date'=>$update_date,'type'=>$type, 'message'=>$message));
            // echo $count_file;
            // die;
            for ($k = 0; $k< $count_file; $k++) {
                $file= $request->file('fileToUpload'.$k);
                // print_r($file);
                // die;
                $staticfinish = date('Y_m_d');
                //Move Uploaded File
                $expire_date = DB::table('users')->where('id','=',$value)->first();
                $expire_date = $k.$expire_date->expire_date;
                $destinationPath = 'assets/attach/'.$staticfinish;

                $filename = md5($expire_date).".".$file->getClientOriginalExtension();
                $uploadedFileName = UploadFile::upload($destinationPath, $file, $filename);
                $destinationPath_ = 'assetsAND&attachAND&'.$staticfinish;
                $destinationPath_ = $destinationPath_."AND&".$filename;
                $tempArray = [];
                $tempArray[] = $filename;
                $tempArray[] = $destinationPath_;
                $totalArray[] = $tempArray;
            }
            // update file message_seller
            DB::table('message_seller')->where("id", $id)->update(['file'=>json_encode($totalArray,JSON_UNESCAPED_UNICODE)]);
        }
        

        return array("result"=>"success");
    }
    // getSubsidylist
    public function getSubsidylist()
    {
        return view("Admin::employee.data.subsidylist");
    }

    // getSubsidyagency
    public function getSubsidyagency()
    {
        return view("Admin::employee.data.subsidyagency");
    }

    // getsubSidyadd
    public function getsubSidyadd()
    {
        return view("Admin::employee.data.subsidyadd");
    }

    // getDocument
    public function getDocument()
    {
        return view("Admin::employee.data.document");
    }

    // getRegistration
    public function getRegistration()
    {
        return view("Admin::employee.data.registration");
    }

    // getAffiliate
    public function getAffiliate()
    {
        return view("Admin::employee.other.affiliate");
    }

    // getPayment
    public function getPayment()
    {
        return view("Admin::employee.other.payment");
    }
    
    // getPaydata
    public function getPaydata()
    {
        return view("Admin::employee.other.paydata");
    }
    
    // getCompanies
    public function getCompanies()
    {
        return view("Admin::employee.other.companies");
    }
    
    // getData
    public function getData()
    {
        return view("Admin::employee.other.data");
    }
    
    /**
    *   Created by  :   vanluuit 10/10/2018 
    *   Description :   get View Search Seminardata
    *   @return     :
    */
    public function getSeminardata(Request $request)
    {
        $startdate  =   createDate($request->startyear, $request->startmonth, $request->startday);
        $enddate    =   createDate($request->endyear, $request->endmonth, $request->endday);
        $keyword = $request->keyword;
        if(empty($startdate)) {
            $startdate = '2017-01-01';
            $request->startyear = '2017';
            $request->startmonth = '1';
            $request->startday = '1';
        }
        if(empty($enddate)) {
            $enddate = '2018-12-31';
            $request->endyear = '2018';
            $request->endmonth = '12';
            $request->endday = '31';
        }

        $seminars = DB::table('seminar_registered');
        if(!empty($keyword)) {
            $seminars = $seminars->where('event_name', 'LIKE', '%'.$keyword.'%');
        }
        if(!empty($startdate)) {
            $seminars = $seminars->where('date', '>=', $startdate);
        }
        if(!empty($startdate)) {
            $seminars = $seminars->where('date', '>=', $startdate);
        }
        if(!empty($enddate)) {
            $seminars = $seminars->where('date', '<=', $enddate);
        }
        $seminars = $seminars->paginate(10);
        $total = $seminars->count();
        foreach ($seminars as $key => $seminar) {
            $seminars[$key]->total = DB::table('seminar')->where('seminar_registered_id', '=', $seminar->id)->where('publication_setting',1)->count();
        }
        return view("Admin::employee.other.seminardata", ['request'=>$request, 'seminars'=>$seminars, 'total'=>$total]);
    }
    /**
    *   Created by  :   vanluuit 10/10/2018 
    *   Description :   post change  publication_setting
    *   @return     :
    */
    public function postSeminardata(Request $request)
    {
        $checkseminar = $request->checkseminar;
        $publication_setting = $request->publication_setting-1;
        if(!empty($checkseminar)) {
            foreach ($checkseminar as $key => $value) {
                DB::table('seminar_registered')->where('id', $value)->update(['publication_setting' => $publication_setting]);
            }
        }
        return redirect('admin/employee/other/seminardata');
    }
     /**
    *   Created by  :   vanluuit 10/10/2018 
    *   Description :   get Seminaradd
    */
    public function getSeminaradd(Request $request)
    {
        
        return view("Admin::employee.other.seminaradd");
    }
     /**
    *   Created by  :   vanluuit 10/10/2018 
    *   Description :   get Seminaradd
    */
    public function postSeminaradd(Request $request)
    {
        $data['event_name'] = $request->event_name;
        $data['date'] = $request->date;
        $data['time_start'] = (float)$request->time_start;
        $data['time_end'] = (float)$request->time_end;
        $data['position1'] = $request->position1;
        $data['position2'] = $request->position2;
        $data['address'] = $request->address;
        $data['particip_count'] = $request->particip_count;
        $data['particip_cost'] = $request->particip_cost;
        $data['lecturer'] = $request->lecturer;
        $data['sponsor'] = $request->sponsor;
        $data['inquiry_name'] = $request->inquiry_name;
        $data['inquiry'] = $request->inquiry;
        $data['event_detail'] = $request->event_detail;
        $data['image_name'] = $request->image_name;
        $data['url'] = $request->url;
        $data['publication_setting'] = $request->publication_setting-1;
        if(!empty($request->image_name)) {
            $uploadedFile = $request->file('imagefile');
            $path = 'assets/employee/other/seminardata';
            $fileName = $request->image_name;
            $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
            $data['image_url'] = $uploadedFileName;

        }
        $id = DB::table('seminar_registered')->insertGetId($data);
        log::info("updated_id".$id);
        AdminEditInfo::add_info('セミナーの詳細', '新規登録');
        return redirect('admin/employee/other/seminardata');
    }

     /**
    *   Created by  :   vanluuit 10/10/2018 
    *   Description :   get Seminaredit
    */
    public function getSeminaredit(Request $request)
    {
        $id = $request->id;
        $seminar = DB::table('seminar_registered')->where('id','=', $id)->first();
        return view("Admin::employee.other.seminaredit", ['seminar'=>$seminar]);
    }
     /**
    *   Created by  :   vanluuit 10/10/2018 
    *   Description :   get Seminaredit
    */
    public function postSeminaredit(Request $request)
    {
        $id = $request->id;
        $seminar = DB::table('seminar_registered')->where('id','=', $id)->first();
        $data['event_name'] = $request->event_name;
        $data['date'] = $request->date;
        $data['time_start'] = (float)$request->time_start;
        $data['time_end'] = (float)$request->time_end;
        $data['position1'] = $request->position1;
        $data['position2'] = $request->position2;
        $data['address'] = $request->address;
        $data['particip_count'] = $request->particip_count;
        $data['particip_cost'] = $request->particip_cost;
        $data['lecturer'] = $request->lecturer;
        $data['sponsor'] = $request->sponsor;
        $data['inquiry_name'] = $request->inquiry_name;
        $data['inquiry'] = $request->inquiry;
        $data['event_detail'] = $request->event_detail;
        $data['image_name'] = $request->image_name;
        $data['url'] = $request->url;
        $data['publication_setting'] = $request->publication_setting-1;
        
        if(!empty($request->image_name)) {
            if($seminar->image_name != $request->image_name) {
                if($request->hasFile('imagefile')) {
                    UploadFile::remove($seminar->image_url);
                    $uploadedFile = $request->file('imagefile');
                    $path = 'assets/employee/other/seminardata';
                    $fileName = $request->image_name;
                    $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
                    $data['image_url'] = $uploadedFileName;
                }
            }
        }else{
            UploadFile::remove($seminar->image_url);
            $data['image_url']="";
        }
        
        $id = DB::table('seminar_registered')->where('id',$id)->update($data);
        AdminEditInfo::add_info('セミナーの詳細', 'セミナー編集');
        return redirect('admin/employee/other/seminardata');
    }
    
     /**
    *   Created by  :   vanluuit 11/10/2018 
    *   Description :   get Seminarapplicant
    */
    public function getSeminarapplicant(Request $request)
    {
        $id = $request->id;
        if(empty($request->id)) {
            $id = DB::table('seminar_registered')->first()->id;
        }
        $result = DB::table('seminar_registered')->where('id',$id)->first();
        $result->present_count = DB::table('seminar')->where('seminar_registered_id',$id)->count();
        $data = DB::table('seminar')->where('seminar_registered_id',$id)->paginate(10);
        $total = DB::table('seminar')->where('seminar_registered_id',$id)->count();
        $next = DB::table('seminar_registered')->where('id','>',$id)->first();
        $prev = DB::table('seminar_registered')->where('id','<',$id)->first();
        return view("Admin::employee.other.seminarapplicant", ['total'=>$total, 'data'=>$data,'result'=>$result, 'nextid'=>@$next->id, 'previd'=>@$prev->id]);
    }
     /**
    *   Created by  :   vanluuit 11/10/2018 
    *   Description :   post Seminarapplicant
    */
    public function postSeminarapplicant(Request $request)
    {
        $id = $request->id;
        if(empty($request->id)) {
            $id = DB::table('seminar_registered')->first()->id;
        }
        $yes = $request->yes;
        $status = $request->status;
        if(!empty($yes)) {
            DB::table('seminar')->whereIn('id', $yes)->update(['publication_setting' => $status]);
        }
        AdminEditInfo::add_info('セミナー管理画面', 'セミナーの公開設定を行いました。');
        return redirect('admin/employee/other/seminarapplicant/'.$id);
    }

     /**
    *   Created by  :   vanluuit 11/10/2018 
    *   Description :   get Applicantdetail
    */
    public function getApplicantdetail(Request $request)
    {
        $id = $request->id;
        $seminar = DB::table('seminar')->where('id', $id)->first();
        return view("Admin::employee.other.applicantdetail", ['seminar'=>$seminar]);
    }

     /**
    *   Created by  :   vanluuit 11/10/2018 
    *   Description :   post Applicantdetail
    */
    public function postApplicantdetail(Request $request)
    {
        $id = $request->id;
        $data['business_name'] = $request->business_name;
        $data['business_url'] = $request->business_url;
        $data['position_name'] = $request->position_name;
        $data['e_mail'] = $request->e_mail;
        $data['phone_number'] = $request->phone_number;
        $data['content'] = $request->content;
        $data['company_name'] = $request->company_name;
        $seminar = DB::table('seminar')->where('id', $id)->update($data);
        AdminEditInfo::add_info('セミナー管理画面', 'セミナーid:'.$id.'の編集を行いました。');
        return redirect('admin/employee/other/seminarapplicant');
    }

     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   get Advertisement
    */
    public function getAdvertisement()
    {
        $result = DB::table('admin_advertisement')->select('id','image_name','url')->get();
        return view("Admin::employee.system.advertisement",['result'=>$result]);
    }

     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   post Advertisement
    */
    public function postAdvertisement(Request $request)
    {
        $image_names = $request->image_name;
        foreach ($image_names as $key => $image_name) {
            $data = [];
            $advertisement = DB::table('admin_advertisement')->where('id',$key)->first();
            $data['url'] = $request->url[$key];
            if(!empty($image_name)) {
                if($advertisement->image_name != $image_name) {
                    if($request->hasFile('imagefile'.$key)) {
                        UploadFile::remove($advertisement->image_url);
                        $uploadedFile = $request->file('imagefile'.$key);
                        $path = 'assets/attach/'.date('Y_m_d');
                        $fileName = $key.md5(date('Y-m-d-his')).'.'.$uploadedFile->getClientOriginalExtension();
                        $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
                        $data['image_url'] = $uploadedFileName;
                        $data['image_name'] = $fileName;
                    }
                }
            }else{
                UploadFile::remove($advertisement->image_url);
                $data['image_url']="";
                $data['image_name']="";
            }
            $id =  DB::table('admin_advertisement')->where('id',$key)->update($data);
        }
        return redirect('admin/employee/system/advertisement');
    }

     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   get Uservoice
    */
    public function getUservoice()
    {
        $result = DB::table('admin_user_sound')->orderBy('order','asc')->paginate(10);
        return view("Admin::employee.system.uservoice", ['result'=>$result]);
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   post Uservoiceedit
    */
    public function postUservoice(Request $request)
    {
        $title = $request->title;
        $order = $request->order;
        $publication_setting = $request->publication_setting;
        foreach ($title as $key => $value) {
            $data['title'] = $value;
            $data['order'] = $order[$key];
            $data['publication_setting'] = $publication_setting[$key];
            $id = DB::table('admin_user_sound')->where('id', $key)->update($data);
        }
        return redirect('admin/employee/system/uservoice');
    }
     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   get Uservoiceadd
    */
    public function getUservoiceadd(Request $request)
    {

        return view("Admin::employee.system.uservoiceadd");
    }
     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   post Uservoiceadd
    */
    public function postUservoiceadd(Request $request)
    {
        $data['manage_flag'] = $request->manage_flag;
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        if(isset($request->type1)) $data['publication_setting']=1;
        if(isset($request->type0)) $data['publication_setting']=0;
        if($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $path = 'assets/attach/'.date('Y_m_d');
            $fileName = md5(date('Y-m-d-his')).'.'.$uploadedFile->getClientOriginalExtension();
            $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
            $data['image_url'] = $uploadedFileName;
            $data['image_name'] = $fileName;
        }
        $id = DB::table('admin_user_sound')->insertGetId($data);
        DB::table('admin_user_sound')->where('id', $id)->update(['order'=>$id]);
        return redirect('admin/employee/system/uservoice');
    }
     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   get Uservoiceedit
    */
    public function getUservoiceedit(Request $request)
    {
        $id = $request->id;
        $result = DB::table('admin_user_sound')->where('id', $id)->first();
        if(!$result->image_url) $result->image_url = 'assets/common/images/img-icon.png';
        return view("Admin::employee.system.uservoiceedit", ['result'=>$result]);
    }
     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   post Uservoiceedit
    */
    public function postUservoiceedit(Request $request)
    {
        $id = $request->id;
        $result = DB::table('admin_user_sound')->where('id', $id)->first();
        $data['manage_flag'] = $request->manage_flag;
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        if(isset($request->type1)) $data['publication_setting']=1;
        if(isset($request->type0)) $data['publication_setting']=0;
        if($request->hasFile('file')) {
            UploadFile::remove($result->image_url);
            $uploadedFile = $request->file('file');
            $path = 'assets/attach/'.date('Y_m_d');
            $fileName = md5(date('Y-m-d-his')).'.'.$uploadedFile->getClientOriginalExtension();
            $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
            $data['image_url'] = $uploadedFileName;
            $data['image_name'] = $fileName;
        }
        $id = DB::table('admin_user_sound')->where('id', $id)->update($data);
        return redirect('admin/employee/system/uservoice');
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   get Uservoiceedit
    */
    public function getUservoicedelete(Request $request)
    {
        $id = $request->id;
        $result = DB::table('admin_user_sound')->where('id', $id)->first();
        if($result) {
            UploadFile::remove($result->image_url);
            $id = DB::table('admin_user_sound')->where('id', $id)->delete();
        }
        return redirect('admin/employee/system/uservoice');
    }
    
     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   get Uservoice
    */
    public function getAlim()
    {
        $result = DB::table('admin_alim')->orderBy('id','desc')->paginate(10);
        return view("Admin::employee.system.alim", ['result'=>$result]);
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   post Alimedit
    */
    public function postAlim(Request $request)
    {
        $title = $request->title;
        $publication_setting = $request->publication_setting;
        foreach ($title as $key => $value) {
            $data['title'] = $value;
            $data['publication_setting'] = $publication_setting[$key];
            $id = DB::table('admin_alim')->where('id', $key)->update($data);
        }
        return redirect('admin/employee/system/alim');
    }
     /**
    *   Created by  :   vanluuit 12/10/2018 
    *   Description :   get Alimadd
    */
    public function getAlimadd(Request $request)
    {

        return view("Admin::employee.system.alimadd");
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   post Alimadd
    */
    public function postAlimadd(Request $request)
    {
        $data['created_date'] = $request->created_date;
        if(empty($request->created_date)) {
            $data['created_date'] = date('Y-m-d');
        }
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        if(isset($request->type1)) $data['publication_setting']=1;
        if(isset($request->type0)) $data['publication_setting']=0;
        if($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $path = 'assets/attach/'.date('Y_m_d');
            $fileName = md5(date('Y-m-d-his')).'.'.$uploadedFile->getClientOriginalExtension();
            $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
            $data['image_url'] = $uploadedFileName;
            $data['image_name'] = $fileName;
        }
        $id = DB::table('admin_alim')->insertGetId($data);
        return redirect('admin/employee/system/alim');
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   get Alimedit
    */
    public function getAlimedit(Request $request)
    {
        $id = $request->id;
        $result = DB::table('admin_alim')->where('id', $id)->first();
        if(!$result->image_url) $result->image_url = 'assets/common/images/img-icon.png';
        return view("Admin::employee.system.alimedit", ['result'=>$result]);
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   post Alimedit
    */
    public function postAlimedit(Request $request)
    {
        $id = $request->id;
        $result = DB::table('admin_alim')->where('id', $id)->first();
        $data['created_date'] = $request->created_date;
        if(empty($request->created_date)) {
            $data['created_date'] = date('Y-m-d');
        }
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        if(isset($request->type1)) $data['publication_setting']=1;
        if(isset($request->type0)) $data['publication_setting']=0;
        if($request->hasFile('file')) {
            UploadFile::remove($result->image_url);
            $uploadedFile = $request->file('file');
            $path = 'assets/attach/'.date('Y_m_d');
            $fileName = md5(date('Y-m-d-his')).'.'.$uploadedFile->getClientOriginalExtension();
            $uploadedFileName = UploadFile::upload($path, $uploadedFile, $fileName);
            $data['image_url'] = $uploadedFileName;
            $data['image_name'] = $fileName;
        }
        $id = DB::table('admin_alim')->where('id', $id)->update($data);
        return redirect('admin/employee/system/alim');
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   get Alimedit
    */
    public function getAlimdelete(Request $request)
    {
        $id = $request->id;
        $result = DB::table('admin_alim')->where('id', $id)->first();
        if($result) {
            UploadFile::remove($result->image_url);
            $id = DB::table('admin_alim')->where('id', $id)->delete();
        }
        return redirect('admin/employee/system/alim');
    }

    // getSuggest
    public function getSuggest()
    {
        return view("Admin::employee.system.suggest");
    }

     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   get Industry
    */
    public function getIndustry()
    {
        $result = DB::table('trades')->orderBy('order', 'asc')->get();
        return view("Admin::employee.system.industry", ['result'=>$result]);
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   post Industry
    */
    public function postIndustry(Request $request)
    {
        $id = $request->id;
        $data['trade'] = $request->trade;
        $data['order'] = $request->order;
        if(!$id) {
            $result = DB::table('trades')->where('trade', $request->trade)->first();
            if(!$result) {
                $tradesarray = DB::table('trades')->where('order', '>=',$request->order)->select('id')->orderBy('order', 'asc')->get();
                if($tradesarray) {
                    foreach ($tradesarray as $key => $trade) {
                        DB::table('trades')->where('id', $trade->id)->update(['order'=>$request->order+$key+1]);
                    }
                } else {
                    $data['order'] = DB::table('trades')->get()->count()+1;
                }
                DB::table('trades')->insert($data);
            }
        }else{
            $result = DB::table('trades')->where('trade', $request->trade)->whereNotIn('id', [$id])->first();
            $result_od = DB::table('trades')->where('id', $id)->first()->order;
            // echo $result_od;die();
            if(!$result) {
                $tradesarray = DB::table('trades')->where('order', '<=',$request->order)->where('order', '>',$result_od)->select('id', 'order')->orderBy('order', 'asc')->get();
                if($tradesarray) {
                    foreach ($tradesarray as $key => $trade) {
                        DB::table('trades')->where('id', $trade->id)->update(['order'=>$trade->order - 1]);
                    }
                }
                $max = DB::table('trades')->get()->count()+1;
                if($max < $request->order) {
                    $data['order'] = $max;
                }
                
                DB::table('trades')->where('id', $id)->update($data);
            }
            
        }
        return redirect('admin/employee/system/industry');
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   change status Industry
    */
    public function postIndustrystatus(Request $request)
    {
        $ids = $request->display;
        $status = $request->status;
        if($status==0) {
            foreach ($ids as $key => $id) {
                DB::table('trades')->where('id', $id)->delete();
                AdminEditInfo::add_info('システム管理 - >業種管理', '業種 id '.$id.'を削除しました。');
            }
            $result = DB::table('trades')->orderBy('order', 'asc')->get();
            foreach ($result as $or => $value) {
                DB::table('trades')->where('id',$value->id)->update(['order'=>$or+1]);
            }
        }else{
            if($status == 1) {
                $text = 'を公開設定しました。';
            }else{
                $text = 'を未公開設定しました。';
            }
            foreach ($ids as $key => $id) {
                DB::table('trades')->where('id', $id)->update(['display'=>$status]);
                AdminEditInfo::add_info('システム管理 - >業種管理', '業種 id '.$id.$text);
            }
        }
        return redirect('admin/employee/system/industry');
    }


     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   get tag
    */
    public function getTag()
    {
        $result = DB::table('tags')->orderBy('order', 'asc')->get();
        return view("Admin::employee.system.tag", ['result'=>$result]);
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   post tag
    */
    public function postTag(Request $request)
    {
        $id = $request->id;
        $data['tag'] = $request->tag;
        $data['order'] = $request->order;
        if(!$id) {
            $result = DB::table('tags')->where('tag', $request->tag)->first();
            if(!$result) {
                $tagsarray = DB::table('tags')->where('order', '>=',$request->order)->select('id')->orderBy('order', 'asc')->get();
                if($tagsarray) {
                    foreach ($tagsarray as $key => $tag) {
                        DB::table('tags')->where('id', $tag->id)->update(['order'=>$request->order+$key+1]);
                    }
                } else {
                    $data['order'] = DB::table('tags')->get()->count()+1;
                }
                DB::table('tags')->insert($data);
            }
        }else{
            $result = DB::table('tags')->where('tag', $request->tag)->whereNotIn('id', [$id])->first();
            $result_od = DB::table('tags')->where('id', $id)->first()->order;
            // echo $result_od;die();
            if(!$result) {
                $tagsarray = DB::table('tags')->where('order', '<=',$request->order)->where('order', '>',$result_od)->select('id', 'order')->orderBy('order', 'asc')->get();
                if($tagsarray) {
                    foreach ($tagsarray as $key => $tag) {
                        DB::table('tags')->where('id', $tag->id)->update(['order'=>$tag->order - 1]);
                    }
                }
                $max = DB::table('tags')->get()->count()+1;
                if($max < $request->order) {
                    $data['order'] = $max;
                }
                
                DB::table('tags')->where('id', $id)->update($data);
            }
            
        }
        return redirect('admin/employee/system/tag');
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   change status tag
    */
    public function postTagstatus(Request $request)
    {
        $ids = $request->display;
        $status = $request->status;
        if($status==0) {
            foreach ($ids as $key => $id) {
                DB::table('tags')->where('id', $id)->delete();
                AdminEditInfo::add_info('システム管理 - >業種管理', '業種 id '.$id.'を削除しました。');
            }
            $result = DB::table('tags')->orderBy('order', 'asc')->get();
            foreach ($result as $or => $value) {
                DB::table('tags')->where('id',$value->id)->update(['order'=>$or+1]);
            }
        }else{
            if($status == 1) {
                $text = 'を公開設定しました。';
            }else{
                $text = 'を未公開設定しました。';
            }
            foreach ($ids as $key => $id) {
                DB::table('tags')->where('id', $id)->update(['display'=>$status]);
                AdminEditInfo::add_info('システム管理 - >業種管理', '業種 id '.$id.$text);
            }
        }
        return redirect('admin/employee/system/tag');
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   get Category
    */
    public function getCategory(Request $request)
    {
        $subid = $request->subid;
        // $category = Category::with(['subcategory'])->first();
        $categorys = Category::All();
        if(!$subid) $subid = $categorys[0]->id;
        $category = Category::where('id', $subid)->first();
        $smallCategory = $subcategory = SubCategory::with(['category'])->where('category_id', $subid)->get();

        return view("Admin::employee.system.category", ['category'=>$category,'categorys'=>$categorys, 'smallCategory'=>$smallCategory]);
    }
     /**
    *   Created by  :   vanluuit 16/10/2018 
    *   Description :   post Category
    */
    public function postCategory(Request $request)
    {
        $id = $request->id;
        $data['category_name'] = $request->category;
        $exist = DB::table('categories')->where('category_name', $request->category)->first();
        if($exist) return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'failed']);
        if(!$id) {
            $data['display'] = 1;
            DB::table('categories')->insert($data);
        }else{
            DB::table('categories')->where('id', $id)->update($data);
        }
        AdminEditInfo::add_info('システム管理 - >カテゴリー', '新しいカテゴリを追加しました。');
        return redirect('admin/employee/system/category/'.$id);

    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   change status category
    */
    public function postCategorystatus(Request $request)
    {
        $ids = $request->ids;
        $status = $request->status;
        if($status==0) {
            foreach ($ids as $key => $id) {
                DB::table('categories')->where('id', $id)->delete();
                DB::table('sub_category')->where('category_id', $id)->update(['display'=>0]);
                AdminEditInfo::add_info('システム管理 - >業種管理', '業種 id '.$id.'を削除しました。');
            }
        }else{
            if($status == 1) {
                $display = 1;
            }else{
                $display = 0;
            }
            foreach ($ids as $key => $id) {
                $rs = DB::table('categories')->where('id', $id)->update(['display'=>$display]);
                if($rs) AdminEditInfo::add_info('システム管理 - >カテゴリー', '大きな カテゴリー 公開の設定');
            }
        }
        return redirect('admin/employee/system/category');
    }
     /**
    *   Created by  :   vanluuit 16/10/2018 
    *   Description :   post sub Category
    */
    public function postSubCategory(Request $request)
    {
        $id = $request->id;
        $subid = $request->subid;
        $data['sub_name'] = $request->subcategory;
        $data['detail_value'] = $request->subcategoryvalue;
        $data['category_id'] = $subid;
        $cate = DB::table('categories')->where('id', $subid)->first();
        $exist = DB::table('sub_category')->where('sub_name', $request->subcategory)->first();
        if($exist) return back()->withInput()->with('flash',['class'=>'failed-msg', 'mes'=>'failed']);
        if(!$id) {
            $data['display'] = 1;
            $rs = DB::table('sub_category')->insert($data);
        }else{
            $rs = DB::table('sub_category')->where('id', $id)->update($data);
            if($rs) AdminEditInfo::add_info('システム管理 - >カテゴリー', 'カテゴリー:'.$cate->category_name.'新しいカテゴリを追加しました');
        }
        
        return redirect('admin/employee/system/category/'.$subid);
    }

     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   change status sub category
    */
    public function postSubCategorystatus(Request $request)
    {
        $ids = $request->ids;
        $subid = $request->subid;
        $status = $request->status;
        if($status==0) {
            foreach ($ids as $key => $id) {
                DB::table('sub_category')->where('id', $id)->delete();
                AdminEditInfo::add_info('システム管理 - >カテゴリー', 'カテゴリー'.$id.'を削除しました。');
            }
        }else{
            if($status == 1) {
                $display = 1;
            }else{
                $display = 0;
            }
            foreach ($ids as $key => $id) {
                $rs = DB::table('categories')->where('id', $id)->update(['display'=>$display]);
                if($rs) AdminEditInfo::add_info('システム管理 - >カテゴリー', 'カテゴリー'.$id.'質問形式のカテゴリー公開の設定');
            }
        }
        return redirect('admin/employee/system/category/'.$subid);
    }

     /**
    *   Created by  :   vanluuit 16/10/2018 
    *   Description :   get Question
    */
    public function getQuestion(Request $request)
    {
        $cate = [];
        $datashows = [];
        $quests = [];
        $id = $request->id;
        $categorys = Category::with(['subcategory'])->get();
        foreach ($categorys as $key => $category) {
            $cate[$category->id] = $category->category_name;
            // $datalist[$category->category_name] = Question::with()
        }
        if($id){
            $sub = SubCategory::where('id', $id)->first();
            if(!$sub) return redirect('admin/employee/system/question');
            $category_id = $sub->category_id;
        }else{
            $category_id = $categorys[0]->id;
            $sub = [];
        }
        
        $subcategorys = SubCategory::where('category_id', $category_id)->get();
        // $checksubcate = [];
        // foreach ($subcategorys as $key => $subcategory) {
        //     $checksubcate[$subcategory->id] = $subcategory->sub_name;
        // }
        $datalists = SubCategory::with(['category'])->where('detail_question','<>',"")->get();
        foreach ($datalists as $keyL => $datalist) {
            if(!in_array($datalist->category->category_name, $datashows)) {
                $datashows[$datalist->category->id] = $datalist->category->category_name;
            }
            $quests[$datalist->category->id][] = $datalist;
        }
        // print_r($quests);die();
        return view("Admin::employee.system.question", ['sub'=>$sub, 'quests'=>$quests, 'datashows'=>$datashows, 'cate'=>$cate,'categorys'=>$categorys, 'subcategorys'=>$subcategorys]);
    }
     /**
    *   Created by  :   vanluuit 16/10/2018 
    *   Description :   post Question
    */
    public function postQuestion(Request $request)
    {
        $id = $request->subcategory;
        // dd($id );
        $data['detail_question'] = $request->question;
        if(!$id){
            return redirect('admin/employee/system/question');
        }
        $id_last = DB::table('sub_category')->where('id',$id)->update($data);
        if($id_last) {
            DB::table('user_category')->where('sub_category_id',$id)->delete();
        }
        AdminEditInfo::add_info('システム管理 - >カテゴリー', 'カテゴリーを編集しました。');
        return redirect('admin/employee/system/question/');
    }
     /**
    *   Created by  :   vanluuit 15/10/2018 
    *   Description :   change status Question
    */
    public function postQuestionstatus(Request $request)
    {
        $ids = $request->ids;
        $status = $request->status;
        if($status==0) {
            foreach ($ids as $key => $id) {
                $questioncate = SubCategory::with(['category'])->where('id',$id)->first();
                if($questioncate->category->category_name == "販路・需要開拓") {
                    DB::table('sub_category')->where('id', $id)->update(['detail_question', ""]);
                }else{
                    DB::table('sub_category')->where('id', $id)->delete();
                }
                AdminEditInfo::add_info('システム管理 - >カテゴリー', '質問形式のカテゴリの削除');
            }
        }else{
            if($status == 1) {
                $display = 1;
            }else{
                $display = 0;
            }
            foreach ($ids as $key => $id) {
                $rs = DB::table('sub_category')->where('id', $id)->update(['display'=>$display]);
                if($rs) AdminEditInfo::add_info('システム管理 - >カテゴリー', '質問形式のカテゴリー未公開の設定');
            }
        }
        return redirect('admin/employee/system/question/');
    }

    
    public function ajax_get_sub_category(Request $request){
        $category_id = $request->category_id;
        $subcategorys = SubCategory::where('category_id', $category_id)->get();
        $checksubcate = [];
        foreach ($subcategorys as $key => $subcategory) {
            $checksubcate[$subcategory->id] = $subcategory->sub_name;
        }
        echo json_encode($checksubcate);die();
    }

      /**
    *   Created by  :   Quang Thắng 15/10/2018 
    *   Description :   getPayinfo
    */
    public function getPayinfo(Request $request)
    {
    
        if(isset($request->submit)){
            $quick_invitation_option = $request->quick_invitation_option;
            $featured_option = $request->featured_option;
            $private_option = $request->private_option;
            $completely_private_option = $request->completely_private_option;
            $notification_to_100_option = $request->notification_to_100_option;
            $notification_to_cert_option = $request->notification_to_cert_option;
            $mypage_display_option = $request->mypage_display_option;
            $free_charge_duration = $request->free_charge_duration;
            $payroll_money = $request->payroll_money;
            $advertise1 = $request->advertise1;
            $advertise3 = $request->advertise3;
            $advertise5 = $request->advertise5;
            $advertise10 = $request->advertise10;
            $advertise20 = $request->advertise20;
            $advertise30 = $request->advertise30;
            $affiliate_profit = $request->affiliate_profit;
            $site_profit = $request->site_profit;

            AdminEditInfo::add_info('システム管理有料情報管理画面', '有料情報関連の内容を編集しました。');

            DB::table('admin_payroll')->update(['quick_invitation_option'=>$quick_invitation_option,
                'featured_option'=>$featured_option,'private_option'=>$private_option,
                'completely_private_option'=>$completely_private_option,'notification_to_100_option'=>$notification_to_100_option,
                'notification_to_cert_option'=>$notification_to_cert_option,'mypage_display_option'=>$mypage_display_option,
                'free_charge_duration'=>$free_charge_duration,'payroll_money'=>$payroll_money,
                'advertise1'=>$advertise1,'advertise3'=>$advertise3,'advertise5'=>$advertise5,
                'advertise10'=>$advertise10,'advertise20'=>$advertise20,'advertise30'=>$advertise30,
                'affiliate_profit'=>$affiliate_profit,'site_profit'=>$site_profit]);

            AdminEditInfo::add_info('有料情報設定管理', '有料オプションを更新しました。');
            //return array('result'=>'success');
            //back()- withinput();
        }
        $result = DB::table('admin_payroll')->first();
        return view("Admin::employee.system.payinfo", ['result' => $result]);
    }

      /**
    *   Created by  :   Quang Thắng 15/10/2018 
    *   Description :   getNotification
    */
    public function getNotification($keyword = 'すべて')
    {
        
        $array = [];
        $array[] = 'info@samurai-match.jp';
        $limit = 10;
        $result_list_keywords = DB::table('admin_system_notification')->select('title')->distinct()->get();
        $checked = $keyword;
        if ($keyword == 'すべて') {
            $result = DB::table('admin_system_notification')->paginate($limit);
        }
        else {
            $result = DB::table('admin_system_notification')->where('title',$keyword)->paginate($limit);
        }
        return view("Admin::employee.system.notification",['result'=>$result,'keywords'=>$result_list_keywords,'checked'=>$checked,'array'=>$array]);
    }

      /**
    *   Created by  :   Quang Thắng 15/10/2018 
    *   Description :   getNotificationbyid
    */
    public function getNotificationbyid(Request $request){
        $result = DB::table('admin_system_notification')->where('id',$request->id)->first();
        $result = json_decode(json_encode($result, JSON_NUMERIC_CHECK),true);
        return $result;
    }
      /**
    *   Created by  :   Quang Thắng 15/10/2018 
    *   Description :   updateNotification
    */
    public function updateNotification(Request $request) {
        $item_name = $request->item_name;
        $to_id = $request->sender_id;
        $title = $request->title;
        $source = $request->sender_mail;
        $text = $request->text;
        $edit_type = $request->edit_type;
        if($request->submit1 != ''){

        
            if ($edit_type == 0) {
                DB::table('admin_system_notification')->insert(array('item_name'=>$item_name,'to_id'=>$to_id,'title'=>$title,'source'=>$source,'text'=>$text));
            }
            else if ($edit_type == 1) {
                $id = $request->id;
                if($source == '1'){
                    $source = "";
                }
                DB::table('admin_system_notification')
                    ->where('id',$id)
                    ->update(['to_id'=>$to_id,'title'=>$title,'source'=>$source,'text'=>$text]);
            }
        }
        return redirect()->back();
    }
      /**
    *   Created by  :   Quang Thắng 15/10/2018 
    *   Description :   getBlog
    */
    public function getBlog(Request $request)
    {
        $search_name = $request->keyword;
        $search_name ="1";
        //die;
        $option = 0;
        if(isset($request->form_option)){
            $option = $request->form_option;  
        }
        $limit =10;
        $statusstring=array(0=>"非公開", 1=>"公開");
        if ($option == 0 || $option == 1) {
            $result = DB::table('blog')->join('users','users.id','=','blog.user_id')
                ->select('blog.*','users.displayname as user_name')
                ->where('blog.title', 'LIKE', '%'.$search_name.'%')
                ->paginate($limit);
        }
        else{
            $result = DB::table('blog')->join('users','users.id','=','blog.user_id')
                ->select('blog.*','users.displayname as user_name')
                ->where('blog.title', 'LIKE', '%'.$search_name.'%')
                ->where('blog.publication_setting', 1)
                ->paginate($limit);
        }
        $link = "/admin/employee/system/blog?keyword=".$search_name."&form_option=".$option;
        if($option != 0){
            $result->setPath($link);
        }
        Log::info('Get staff blog data Total number of items:'.$result->total());
        return view("Admin::employee.system.blog",['result'=>$result,'statusstring'=>$statusstring,'link'=>$link,'option'=>$option]);
    }
      /**
    *   Created by  :   Quang Thắng 15/10/2018 
    *   Description :   changeOptionblog
    */
    public function changeOptionblog(Request $request)
    {
        if (count($request->yes) > 0) {
            $ids = $request->yes;
            $option = $request->option1;

            if ($option == 0) {
                $str = '';
                for ($k = 0; $k< count($ids); $k++) {
                    DB::table('blog')->where('id',$ids[$k])->update(['publication_setting'=>1]);
                    $str.=" ".$ids[$k];
                }

                AdminEditInfo::add_info('システム管理ブログの管理画面', 'ブログ id '.$str.'を公開設定しました。');
            }
            else if ($option == 1) {
                $str = '';
                for ($k = 0; $k< count($ids); $k++) {
                    DB::table('blog')->where('id',$ids[$k])->update(['publication_setting'=>0]);
                    $str.=" ".$ids[$k];
                }

                AdminEditInfo::add_info('システム管理ブログの管理画面', 'ブログ id '.$str.'をプライベート設定しました。');
            }
            else if ($option == 2) {
                $str = '';
                for ($k = 0; $k< count($ids); $k++) {
                    DB::table('blog')->where('id',$ids[$k])->delete();
                    $str.=" ".$ids[$k];
                }

                AdminEditInfo::add_info('システム管理ブログの管理画面', 'ブログ id '.$str.'を削除しました。');
            }
            Log::info('Blog Management'.$option);
            return redirect('admin/employee/system/blog/');
            }
    }
    

    
}
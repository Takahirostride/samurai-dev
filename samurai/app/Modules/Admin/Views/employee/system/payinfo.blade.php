@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>システム管理</a></li>
    </ul>
</div>
@endsection
@section('content')
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <ul>
	                                <!-- <li><a href="{{URL::to('/admin/employee/system/advertisement')}}">広告表示管理</a></li> -->
	                                <li><a href="{{URL::to('/admin/employee/system/alim')}}">お知らせ</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/suggest')}}">おススメの助成金</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/industry')}}">業種</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/tag')}}">タグ管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/category')}}">カテゴリー管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/question')}}">企業情報質問内容管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/uservoice')}}">利用者の声</a></li>
	                                <li class="active"><a href="{{URL::to('/admin/employee/system/payinfo')}}">有料情報管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/notification')}}">通知管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/blog')}}">ブログ管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>有料情報設定管理</span></div>
                            {{ Form::open(array('url' => 'admin/employee/system/payinfo', 'method' =>'POST')) }}>
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">有料オプション</legend>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>急募オプション</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('quick_invitation_option',$result->quick_invitation_option, array("class" => "form-control","name" =>"quick_invitation_option",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>注目オプション</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('featured_option',$result->featured_option, array("class" => "form-control","name" =>"featured_option",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>非公開オプション</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                
                                                {{Form::number('private_option',$result->private_option, array("class" => "form-control","name" =>"private_option",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>完全非公開オプション</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('completely_private_option',$result->completely_private_option, array("class" => "form-control","name" =>"completely_private_option",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>士業100人への一斉通知オプション</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('notification_to_100_option',$result->notification_to_100_option, array("class" => "form-control","name" =>"notification_to_100_option",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>認定士業への一斉通知オプション</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('notification_to_cert_option',$result->notification_to_cert_option, array("class" => "form-control","name" =>"notification_to_cert_option",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>マイページ表示オプション</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                               {{Form::number('mypage_display_option',$result->mypage_display_option, array("class" => "form-control","name" =>"mypage_display_option",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">有料会員</legend>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>有料会員</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                
                                                {{Form::number('payroll_money',$result->payroll_money, array("class" => "form-control","name" =>"payroll_money",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>無料期間</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('free_charge_duration',$result->free_charge_duration, array("class" => "form-control","name" =>"free_charge_duration",  "min"=>"0", "required"=>""))}}
                                                <span class="form-control-feedback">月</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">販売者料金</legend>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>掲載数　１</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                
                                                {{Form::number('advertise1',$result->advertise1, array("class" => "form-control","name" =>"advertise1",  "min"=>"0" , "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>掲載数　3</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                
                                                {{Form::number('advertise3',$result->advertise3, array("class" => "form-control","name" =>"advertise3",  "min"=>"0" , "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>掲載数　5</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('advertise5',$result->advertise5, array("class" => "form-control","name" =>"advertise5",  "min"=>"0" , "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>掲載数　10</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('advertise10',$result->advertise10, array("class" => "form-control","name" =>"advertise10",  "min"=>"0" , "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>掲載数　20</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                
                                                {{Form::number('advertise20',$result->advertise20, array("class" => "form-control","name" =>"advertise20",  "min"=>"0" , "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>掲載数　30</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('advertise30',$result->advertise30, array("class" => "form-control","name" =>"advertise30",  "min"=>"0" , "required"=>""))}}
                                                <span class="form-control-feedback">円</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">アフィリエイト</legend>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>利益率</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('affiliate_profit',$result->affiliate_profit, array("class" => "form-control","name" =>"affiliate_profit",  "min"=>"0", "max"=>"100" , "required"=>""))}}
                                                <span class="form-control-feedback">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">サイト利用料</legend>
                                    <div class="row" style="margin-top: 5px;margin-bottom: 5px">
                                        <div class="col-sm-3">
                                            <h5>利益率</h5>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group has-feedback">
                                                {{Form::number('site_profit',$result->site_profit, array("class" => "form-control","name" =>"site_profit", "min"=>"0", "max"=>"100",'step'=>"0.01" , "required"=>""))}}
                                                <span class="form-control-feedback">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div style="margin-top:50px; margin-bottom: 30px;">
                                     {{Form::submit('保存する', array("class"=>"submit-blue-btn", 'value'=>'保存する', 'name'=>'submit','onclick'=> 'return check_validate_payinfo()'))}}
                                </div>
                            {{ Form::close() }}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        function check_validate_payinfo(){
            if($('input[name="quick_invitation_option"]').val()){
                if($('input[name="quick_invitation_option"]').val()<0){
                    //alert("plz fill 急募オプション correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 急募オプション correct!");
                return false;
            }

            if($('input[name="featured_option"]').val()){
                if($('input[name="featured_option"]').val()<0){
                    //alert("plz fill 注目オプション correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 注目オプション correct!");
                return false;
            }

            if($('input[name="private_option"]').val()){
                if($('input[name="private_option"]').val()<0){
                    //alert("plz fill 非公開オプション correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 非公開オプション correct!");
                return false;
            }

            if($('input[name="completely_private_option"]').val()){
                if($('input[name="completely_private_option"]').val()<0){
                    //alert("plz fill 完全非公開オプション correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 完全非公開オプション correct!");
                return false;
            }

            if($('input[name="notification_to_100_option"]').val()){
                if($('input[name="notification_to_100_option"]').val()<0){
                    //alert("plz fill 士業100人への一斉通知オプション correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 士業100人への一斉通知オプション correct!");
                return false;
            }

            if($('input[name="notification_to_cert_option"]').val()){
                if($('input[name="notification_to_cert_option"]').val()<0){
                    //alert("plz fill 認定士業への一斉通知オプション correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 認定士業への一斉通知オプション correct!");
                return false;
            }

            if($('input[name="mypage_display_option"]').val()){
                if($('input[name="mypage_display_option"]').val()<0){
                    //alert("plz fill マイページ表示オプション correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill マイページ表示オプション correct!");
                return false;
            }
            //option2
            if($('input[name="payroll_money"]').val()){
                if($('input[name="payroll_money"]').val()<0){
                    //alert("plz fill 有料会員 correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 有料会員 correct!");
                return false;
            }
            if($('input[name="free_charge_duration"]').val()){
                if($('input[name="free_charge_duration"]').val()<0){
                    //alert("plz fill 無料期間 correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 無料期間 correct!");
                return false;
            }
            //option3
            if($('input[name="advertise1"]').val()){
                if($('input[name="advertise1"]').val()<0){
                    //alert("plz fill 掲載数　１ correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 掲載数　１ correct!");
                return false;
            }
            if($('input[name="advertise3"]').val()){
                if($('input[name="advertise3"]').val()<0){
                    //alert("plz fill 掲載数　3 correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 掲載数　3 correct!");
                return false;
            }
            if($('input[name="advertise5"]').val()){
                if($('input[name="advertise5"]').val()<0){
                    //alert("plz fill 掲載数　5 correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 掲載数　5 correct!");
                return false;
            }
            if($('input[name="advertise10"]').val()){
                if($('input[name="advertise10"]').val()<0){
                    //alert("plz fill 掲載数　１0 correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 掲載数　１0 correct!");
                return false;
            }
            if($('input[name="advertise20"]').val()){
                if($('input[name="advertise20"]').val()<0){
                    //alert("plz fill 掲載数　20 correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 掲載数　20 correct!");
                return false;
            }
            if($('input[name="advertise30"]').val()){
                if($('input[name="advertise30"]').val()<0){
                    //alert("plz fill 掲載数　30 correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 掲載数　30 correct!");
                return false;
            }


            if($('input[name="affiliate_profit"]').val()){
                if($('input[name="affiliate_profit"]').val()<0||$('input[name="affiliate_profit"]').val()>100){
                    //alert("plz fill アフィリエイト correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill アフィリエイト correct!");
                return false;
            }
            if($('input[name="site_profit"]').val()){
                if($('input[name="site_profit"]').val()<0||$('input[name="site_profit"]').val()>100){
                    //alert("plz fill 利益率 correct!");
                    return false;
                }
            }   
            else{
                //alert("plz fill 利益率 correct!");
                return false;
            }
            return true;
        }
    </script>
@endsection
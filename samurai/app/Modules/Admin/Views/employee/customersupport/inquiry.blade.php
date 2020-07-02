@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>顧客対応管理</a></li>
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
	                                <li><a href="{{('/admin/employee/customersupport/contact')}}">お問い合わせ対応設定</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/identifydoc')}}">本人確認書類管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/identifyphrase')}}">本人確認書類対応設定</a></li> -->
	                                <li><a href="{{('/admin/employee/customersupport/violator')}}">違反者管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/violatorphrase')}}">違反者対応設定</a></li> -->
	                                <li><a href="{{('/admin/employee/customersupport/manageadvertise')}}">広告掲載管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>お問い合わせ管理</span></div>
                            <div class="section-3 col-md-12" style="padding-left:0px;">
                                <div class="section3-full" style="padding-left:0px;">
                                    <div class="section3-full-scroll" style="padding-left:8px;">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="angularsl" id="status">
                                                    {{Form::select('sub_status', array('0' => 'すべて', '1' => '対応済み', '2' => '未対応'), $status )}} 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-5 col-md-12" style="display:block;overflow:auto;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="min-width:150px;">件名</th>
                                            <th style="min-width:150px;">送信者</th>
                                            <th style="min-width:150px;">メールアドレス</th>
                                            <th style="min-width:150px;">日時</th>
                                            <th style="min-width:150px;">ステータス</th>
                                            <th style="min-width:150px;">対応者</th>
                                            <th style="max-width:250px;">コメント</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($inquiry as $value)
                                            <tr class="odd tr_click" id="{{ $value->id }}" role="button" tabindex="0">
                                                <td style="min-width:150px;">{{ $value->faq_title }}</td>
                                                <td style="min-width:150px;">{{ $value->displayname }}</td>
                                                <td style="min-width:150px;">{{ $value->e_mail }}</td>
                                                <td style="min-width:150px; word-break: keep-all;">{{ date('Y年m月d日 H時i分', strtotime($value->created_at)) }}</td>
                                                <td style="min-width:150px;">{{$displaystatusstring[$value->state]}}</td>
                                                <td style="max-width:150px;">{{ $value->answer_name }}</td>
                                                <td style="max-width:150px;">{{ $value->faq_content }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                    {!! $inquiry->links() !!}
                            </div>

                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-9" style="background:#fff;">
                                        <div class="gridcell-left">
                                            <div class="row" style="margin-left:0px;margin-right:0px;">
                                                <div class="col-md-4" style="background:#fff;">
                                                    <div class="angularsl">
                                                     {{Form::select('templete', $template, null)}} 
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gridcell-left">
                                            {{ Form::open(array('url' => 'admin/employee/customersupport/addfaq_answers', 'method' =>'POST')) }}
                                            <!-- Title -->
                                            <p style="font-size:14px;"><span id="faq_title">未選択</span> &nbsp;</p>
                                            <!-- Date -->
                                            <div class="row">
                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                                <p class="col-md-2" style="font-size:14px;width:24%;text-align:center;padding-left:0px;padding-right:0px;" id="create-date" >○○年○○月○○日</p>
                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                            </div>

                                            <!-- ID -->
                                            <div class="row">
                                                <p class="col-md-12" style="font-size:14px;"><span id="displayname"></span>
                                                    <span id="user_id">未選択</span></p>
                                            </div>

                                            <!-- time -->
                                            <div class="row">
                                                <p style="font-size:14px;width:200px;float:right;text-align:right;padding-left:0px;padding-right:30px;"><span id="time-string">○○:○○</span>(時間)</p>
                                            </div>

                                            <!-- Content -->
                                            <div class="row" style="height: 100px;">
                                                <p class="col-md-12 overflow-visible" style="font-size:14px;padding-left:30px; padding-right:30px;" id="contents">未選択</p>
                                            </div>

                                            <!-- Current Date -->
                                            <div class="row">
                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                                <p class="col-md-2" style="font-size:14px;width:24%;text-align:center;padding-left:0px;padding-right:0px;">
                                                {{date('Y年m月d日')}}
                                                </p>
                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                            </div>

                                            <!-- Content -->
                                            <div class="row" style="height: 120px;">
                                                {{Form::textarea('text','', array("class"=> "col-md-12 overflow-visible", 'cols'=>0, 'rows'=>0))}} 
                                                {{Form::hidden('admin_id', $admin_id)}}
                                                {{Form::hidden('faq_id')}}
                                                {{Form::hidden('e_mail')}}
                                                {{Form::hidden('displayname')}}
                                                {{Form::hidden('user_id')}}
                                            </div>
                                        </div>
                                        <div class="gridcell-left">
                                             {{Form::submit('送信する', array("class"=>"submit-blue-btn", 'value'=>'送信する', 'name'=>'submit1','onclick'=> 'return check_field1()'))}}
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                    <div class="col-md-3" style="padding-left:15px;padding-top:25px;">
                                        {{ Form::open(array('url' => 'admin/employee/customersupport/updateStatefaq', 'method' =>'POST')) }}
                                        <p>対応者</p>
                                        <p>{{ $admin_name }}</p>
                                        <p>ステータス変更</p>
                                        <p>
                                            <div class="angularsl">
                                                {{Form::select('status', array('0' => '未対応', '1' => '対応済み'))}} 
                                            </div>
                                        </p>
                                        <p>コメント</p>
                                        <p>{{Form::textarea('Text1','', array("class"=> "col-md-12 overflow-visible", 'cols'=>0, 'rows'=>10))}}</p>
                                        {{Form::hidden('admin_id1', $admin_id)}}
                                        {{Form::hidden('faq_id1')}}
                                        {{Form::submit('変更する', array("class"=>"submit-blue-btn", 'value'=>'変更する', 'name'=>'submit2','onclick'=> 'return check_field2()'))}}
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
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
        $(document).ready(function(){
            $(document).on('click', '#status .showoption div', function(){
            var parent_id = $(this).parent().parent().attr('id');
            var status_id = $('#'+parent_id).find('select').val();
            console.log(status_id);
            var url = '/admin/employee/customersupport/inquiry/';
            if(status_id == 0){
                window.location=url;
            }else{
                window.location=url+status_id;
            }                
            })
            $('.tr_click').click(function(){
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/employee/customersupport/getInquirybyid/'+id,
                    dataType: 'JSON',
                    success: function(json) {
                        var d = new Date(json.created_at);
                        var time = d.getHours() + ":" + d.getMinutes();
                        d = d.getFullYear() +'年' + (d.getMonth()+1)+"月"+d.getDate()+ "日" ;
                        $('#faq_title').text(json.faq_title);
                        $('#time-string').text(time);
                        $('#create-date').text(d);
                        $('#user_id').text(json.user_id);
                        $('#contents').text(json.faq_content);
                        $('input[name="faq_id"]').val(id);
                        $('input[name="faq_id1"]').val(id);
                        $('input[name="e_mail"]').val(json.e_mail);
                        $('input[name="displayname"]').val(json.displayname);
                        $('input[name="user_id"]').val(json.user_id);
                        console.log(json.displayname);
                    }
                });
            }) 
        })
       function check_field1(){
                if($('textarea[name="text"]').val() != '' && $('input[name="admin_id"]').val() != '' 
                      && $('input[name="faq_id"]').val() != '' && $('input[name="user_id"]').val() != '' 
                      && $('input[name="e_mail"]').val() != '' ){
                    console.log($('input[name="admin_id"]').val());
                    return true;
                }else{
                    alert('コメントを正確に入力してください')
                    return false
                }
            }
        function check_field2(){
            if($('textarea[name="Text1"]').val() != '' && $('input[name="faq_id1"]').val() != '' ){
                    return true;
                }else{
                    alert('コメントを正確に入力してください')
                    return false
                }
        }
    </script>
@endsection
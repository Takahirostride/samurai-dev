@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>その他管理</a></li>
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
	                                <li><a href="{{('/admin/employee/other/affiliate')}}">アフィリエイター管理</a></li>
	                                <li><a href="{{('/admin/employee/other/payment')}}">支払管理</a></li>
	                                <li><a href="{{('/admin/employee/other/paydata')}}">支払管理データ総括</a></li>
	                                <li><a href="{{('/admin/employee/other/companies')}}">仕事提携可能会社一覧</a></li>
	                                <li><a href="{{('/admin/employee/other/data')}}">仕事提携可能会社データ総括</a></li>
	                                <li><a href="{{('/admin/employee/other/seminardata')}}">セミナーデータ一覧</a></li>
	                                <li class="active"><a href="{{('/admin/employee/other/seminarapplicant')}}">セミナー申込者一覧</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <label style="font-size:22px;margin-top:30px;">申込者詳細データ</label>
                        </div>
                        {{ Form::open(['url' => '/admin/employee/other/applicantdetail', 'method' => 'POST', 'class' => 'form-horizontal']) }}
                        <div class="site-content">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <form class="form-horizontal">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">氏名</p>
                                            </div>
                                            <div class="add-container" style="margin-left:0px;margin-right:0px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">氏名</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                {{Form::hidden('id', $seminar->id)}}
                                                                <b>{{$seminar->first_name}}</b>&nbsp;&nbsp;<b>{{$seminar->last_name}}</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">氏名カナ</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <b>{{$seminar->hanzi_first_name}}</b>&nbsp;&nbsp;<b>{{$seminar->hanzi_last_name}}</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="form-group" style="margin-top:20px;">
                                            <p class="col-sm-3">企業情報</p>
                                        </div>
                                        <div class="add-container" style"margin-left:0px;margin-right:0px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="gridcell-left">
                                                        <p style="font-size:14px;">企業名</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                    <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                        <div class="col-md-12" style="padding-left:15px;">
                                                            {{Form::text('business_name', $seminar->business_name, ['class'=>'form-control', 'placeholder'=>'都道府県・都市名'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="gridcell-left">
                                                        <p style="font-size:14px;">企業URL</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                    <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                        <div class="col-md-12" style="padding-left:15px;">
                                                            {{Form::text('business_url', $seminar->business_url, ['class'=>'form-control', 'placeholder'=>'都道府県・都市名'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="gridcell-left">
                                                        <p style="font-size:14px;">役職名</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                    <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                        <div class="col-md-12" style="padding-left:15px;">
                                                            {{Form::text('position_name', $seminar->position_name, ['class'=>'form-control', 'placeholder'=>'詳細場所'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="gridcell-left">
                                                        <p style="font-size:14px;">メールアドレス</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                    <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                        <div class="col-md-12" style="padding-left:15px;">
                                                            {{Form::text('e_mail', $seminar->e_mail, ['class'=>'form-control', 'placeholder'=>'住所'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="gridcell-left">
                                                        <p style="font-size:14px;">電話番号</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                    <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                        <div class="col-md-12" style="padding-left:15px;">
                                                            {{Form::text('phone_number', $seminar->phone_number, ['class'=>'form-control', 'placeholder'=>'住所'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4" style="height:120px;">
                                                    <div class="gridcell-left">
                                                        <p style="font-size:14px;position: relative;top:40%;">事業内容、自己紹介</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                    <div class="gridcell-right" style="height:120px;padding-right:15px;">
                                                        <div class="col-md-12" style="padding-left:15px;">
                                                            {{Form::textarea('content', $seminar->content, ['class'=>'form-control', 'rows'=>'5'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <div class="form-group" style="margin-top:20px;">
                                            <p class="col-sm-3">その他</p>
                                        </div>
                                        <div class="add-container" style"margin-left:0px;margin-right:0px;">
                                            <div class="row">
                                                <div class="col-md-4" style="height:120px;">
                                                    <div class="gridcell-left">
                                                        <p style="font-size:14px;position: relative;top:40%;">紹介者（社）名・どこで知ったか</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                    <div class="gridcell-right" style="height:120px;padding-right:15px;">
                                                        <div class="col-md-12" style="padding-left:15px;">
                                                            {{Form::textarea('company_name', $seminar->company_name, ['class'=>'form-control', 'rows'=>'5'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                        <form class="form-horizontal">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">その他</p>
                                            </div>
                                            <div class="add-container" style"margin-left:0px;margin-right:0px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">削除する</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <input type="checkbox" ng-model="displaydeleteflag.flag">削除する
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                -->
                            </div>

                            <div style="margin-top:50px;">
                               
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    {{Form::submit('保存する', ['class'=>'submit-blue-btn', 'id'=>'checksubmit'])}}
                                 </div>
                                 
                              <div class="col-md-3">
                              <input type="reset" class="submit-blue-btn" value="削除する">
                              </div>
                              <div class="col-md-3"></div>
                                
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#checksubmit').on('click', function () {
            if(!$('input[name="business_name"]').val()) {
                dialog('<b>ポップアップ</b>','<b style="font-size:25px">企業名</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('input[name="business_url"]').val()) {
                dialog('<b>ポップアップ</b>','<b style="font-size:25px">企業URL</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('input[name="position_name"]').val()) {
                dialog('<b>ポップアップ</b>','<b style="font-size:25px">役職名</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('input[name="e_mail"]').val()) {
                dialog('<b>ポップアップ</b>','<b style="font-size:25px">メールアドレス</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if($('input[name="phone_number"]').val() <= 0) {
                dialog('<b>ポップアップ</b>','<b style="font-size:25px">電話番号</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('textarea[name="content"]').val()) {
                dialog('<b>ポップアップ</b>','<b style="font-size:25px">事業内容、自己紹介</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('textarea[name="company_name"]').val()) {
                return false;
                dialog('<b>ポップアップ</b>','<b style="font-size:25px">紹介者（社）名・どこで知ったか</b>フィールドを正確に記入してください！', '確認');
            }
            
        });
    </script>
@endsection
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
	                                <li class="active"><a href="{{('/admin/employee/other/seminardata')}}">セミナーデータ一覧</a></li>
	                                <li><a href="{{('/admin/employee/other/seminarapplicant')}}">セミナー申込者一覧</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                    <div class="site-content">
                        <label style="font-size:22px;margin-top:30px;">セミナー詳細データ</label>
                    </div>

                    <div class="site-content">
                        {{ Form::open(['url' => '/admin/employee/other/seminaradd', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                        <div class="add-container">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">セミナーID</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right" style="height:40px;">
                                        <p style="font-size:14px;">自動で割り当てる</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">イベント名</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::text('event_name', request()->event_name, ['class'=>'form-control'])}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3" style="height:272px;">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">日付</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        <div class="row">
                                        <div class="col-md-7" style="z-index: 0;">
                                            <div class="datepicker" id="datepicker1"></div> 
                                            {{Form::hidden('date', request()->date, ['id'=>'showdayinput'])}}
                                            
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">時間</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right" style="height:40px;">
                                        <div class="row">
                                        <div class="col-md-4" style="z-index: 1;">
                                            <div class="angularsl">
                                                {{Form::select('time_start', config('combobox.timelist'), request()->time_start)}}
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="text-align:center;">~</div>
                                        <div class="col-md-4" style="z-index: 1;">
                                            <div class="angularsl">
                                                {{Form::select('time_end', config('combobox.timelist'), request()->time_end)}}
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">場所１</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::text('position1', request()->position1, ['class'=>'form-control', 'placeholder'=>'都道府県・都市名'])}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">場所２</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::text('position2', request()->position2, ['class'=>'form-control', 'placeholder'=>'詳細場所'])}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">住所</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::text('address', request()->address, ['class'=>'form-control', 'placeholder'=>'住所'])}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">参加者定員</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::number('particip_count', 0, ['class'=>'form-control'])}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">参加費</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::number('particip_cost', 0, ['class'=>'form-control'])}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3" style="height:160px;">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;position: relative;top:40%;">講師</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::textarea('lecturer', request()->lecturer, ['class'=>'form-control', 'rows'=>7])}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3" style="height:160px;">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;position: relative;top:40%;">主催</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::textarea('sponsor', request()->sponsor, ['class'=>'form-control', 'rows'=>7])}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">問い合わせ先名</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::text('inquiry_name', request()->inquiry_name, ['class'=>'form-control'])}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3" style="height:120px;">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;position: relative;top:40%;">問い合わせ先</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::textarea('inquiry', request()->inquiry, ['class'=>'form-control', 'rows'=>5])}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3" style="height:300px;">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;position: relative;top:40%;">イベント詳細</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right">
                                        {{Form::textarea('event_detail', request()->event_detail, ['class'=>'form-control', 'rows'=>14])}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3" style="height:163px;">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">画像</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right" style="height:163px;">
                                        <div class="col-md-8" style="padding-left: 0px; padding-right: 0px; top: 30%; position: absolute;">
                                            <div class="row">
                                                <div class="input-group">
                                                    <div class="has-feedback" style="margin-bottom:0px;">
                                                        {{Form::text('image_name', request()->image_name, ['class'=>'form-control', 'readonly'=>'readonly', 'placeholder'=>'表示画像', 'id'=>'thumbnail'])}}
                                                        <span id="clear_file" class="form-control-feedback" style="pointer-events: auto;"><i class="fa fa-close" style="padding-top:7px;"></i></span>
                                                    </div>
                                                    <div class="input-group-btn">
                                                        <label for=file class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
                                                        <input id=file type="file" name="imagefile" class="hidefile" data-showname="thumbnail" style="display: none;" accept="image/*"/>
                                                    </div>
                                                </div>
                                            </div> 
                                            {{Form::text('url', request()->url, ['class'=>'form-control'])}}
                                        </div>   
                                        <div class="col-md-3" style="float: right;"> 
                                            <div class="text-right">
                                                <div style="width:180px; height:160px; float: right;" class="imagecenter">
                                                    <img src style="max-width: 185px;max-height:145px;" class="img-thumbnail">
                                                </div>
                                            </div>                             
                                        </div>
                                    </div>    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="gridcell-left">
                                        <p style="font-size:14px;">公開設定</p>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="gridcell-right" style="height:40px;">
                                        {{Form::radio('publication_setting', 2, true)}}掲載中 &nbsp; &nbsp; &nbsp;
                                       {{Form::radio('publication_setting', 3, false)}}掲載終了 &nbsp; &nbsp; &nbsp;
                                        {{Form::radio('publication_setting', 1, false)}}非掲載 &nbsp; &nbsp; &nbsp;
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div style="margin-top:50px;">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                              {{Form::submit('保存する', ['class'=>'submit-blue-btn', 'id'=>'checksubmit'])}}
                             </div>
                             
                          <div class="col-md-3">
                          <button class="submit-blue-btn" type="reset">削除する</button>
                          </div>
                          <div class="col-md-3"></div>
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
        $(document).on('change', '#file', function(){
            $('#clear_file').show();
        });
        $(document).on('click', '#clear_file', function(){
            $('#clear_file').hide();
            $('#thumbnail').val('');
        });
        $('#datepicker1').datepicker({
            language : 'ja',
            inline: true,
            sideBySide: true,
            todayHighlight: true,
            format: "yyyy-mm-dd",
        }).on('changeDate', function(){
            var value = $('#datepicker1').datepicker('getFormattedDate');
            $('#showdayinput').val(value);
        });

        $('#checksubmit').on('click', function () {
            if(!$('input[name="event_name"]').val()) {
                dialog('<b>ポップアップ</b>','<b>イベント名</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('select[name="time_start"]').val()) {
                dialog('<b>ポップアップ</b>','<b>時間</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('select[name="time_end"]').val()) {
                return false;
                dialog('<b>ポップアップ</b>','<b>時間</b>フィールドを正確に記入してください！', '確認');
            }
            if(!$('input[name="position1"]').val()) {
                dialog('<b>ポップアップ</b>','<b>場所１</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('input[name="position2"]').val()) {
                dialog('<b>ポップアップ</b>','<b>場所２</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('input[name="address"]').val()) {
                dialog('<b>ポップアップ</b>','<b>住所</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if($('input[name="particip_count"]').val() <= 0) {
                dialog('<b>ポップアップ</b>','<b>参加者定員</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if($('input[name="particip_cost"]').val() <= 0) {
                dialog('<b>ポップアップ</b>','<b>参加費</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('textarea[name="lecturer"]').val()) {
                dialog('<b>ポップアップ</b>','<b>講師</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('textarea[name="sponsor"]').val()) {
                dialog('<b>ポップアップ</b>','<b>主催</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('textarea[name="inquiry"]').val()) {
                dialog('<b>ポップアップ</b>','<b>問い合わせ先</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('input[name="inquiry_name"]').val()) {
                dialog('<b>ポップアップ</b>','<b>問い合わせ先名</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
            if(!$('textarea[name="event_detail"]').val()) {
                dialog('<b>ポップアップ</b>','<b>イベント詳細</b>フィールドを正確に記入してください！', '確認');
                return false;
            }
        });

    </script>
@endsection
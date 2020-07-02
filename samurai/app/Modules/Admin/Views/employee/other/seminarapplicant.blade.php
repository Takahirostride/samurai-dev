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
                            <div class="section-1">
                                <div class="success-msg">
                                    <span>新規スタッフを登録しました。</span>
                                </div>
                            </div>

                            <div class="section-2 col-md-12">

                                <div class="row">
                                    <div class="col-sm-1" style="margin-top:20px;padding-right:0px;">
                                        <a href="{{URL::to('/admin/employee/other/seminarapplicant/')}}/{{$previd}}"><span class="glyphicon glyphicon-triangle-left" style="font-size:30px;margin-top:80px;float:right;"></span></a>
                                    </div>
                                    <div class="col-sm-10" style="padding-left:0px;padding-right:0px;">
                                        <div class="add-container" style "margin-left:0px;margin-right:0px;"="">

                                            <div class="row" style="height:180px;">
                                                <div class="col-md-2" style="background:#fff;height:180px;padding-left:0px;padding-right:0px;">
                                                    <div class="gridcell-left" style="padding-left:0px;">
                                                        <p style="font-size:18px;margin-top:25px;text-align:center;"><b style="font-size:28px;" class="ng-binding">{{\Carbon\Carbon::parse($result->date)->format('m.d')}}</b>（月）</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1" style="background:#fff;padding-left:0px;padding-right:0px;height:180px;">
                                                    <div class="gridcell-left" style="padding-left:0px;">
                                                        <p style="font-size:18px;margin-top:70px;text-align:center;" class="ng-binding">{{$result->address}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-9" style="background:#fff;padding-left:0px;height:180px;">
                                                    <div class="gridcell-right" style="height:180px;">
                                                        <p style="font-size:18px;margin-top:10px;color:#0E71B5;font-weight:600;" class="ng-binding">{{$result->event_name}}</p>
                                                        <p style="font-size:16px;margin-top:10px;margin-bottom:0px;" class="ng-binding">
                                                            場所：{{$result->position1}}&nbsp;{{$result->position2}}
                                                        </p>
                                                        <p style="font-size:16px;margin-bottom:0px;" class="ng-binding">
                                                            時間：{{$result->time_start}}時~{{$result->time_end}}時
                                                        </p>
                                                        <p style="font-size:16px;margin-bottom:0px;" class="ng-binding">
                                                            参加者：{{$result->present_count}}人/{{$result->particip_count}}人
                                                        </p>
                                                        <p style="font-size:16px;margin-bottom:0px;" class="ng-binding">
                                                            参加費：{{$result->particip_cost}}
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1" style="margin-top:20px;padding-left:0px;">
                                        <a href="{{URL::to('/admin/employee/other/seminarapplicant/')}}/{{$nextid}}"><span class="glyphicon glyphicon-triangle-right" style="font-size:30px;margin-top:80px;"></span></a>
                                    </div>
                                </div>
                            </div>
                            {{ Form::open(['url' => '/admin/employee/other/seminarapplicant', 'method' => 'POST', 'class' => 'form-horizontal', 'id'=>'change_status']) }}
                            <div class="section-3 col-md-12">
                                <h4 style="margin-bottom:20px;width:100%;">申込者一覧</h4>
                                <div class="section3-full">
                                    <div class="section3-full-scroll" style="padding-top:0px;">
                                        <div class="row" style="margin-top:30px;">
                                            <div class="col-sm-3">
                                            	<div class="angularsl">
                                                    <select name="status"> 
                                                        <option value="1">申込中</option> 
                                                        <option value="0">キャンセル</option> 
                                                        <option value="2">削除</option>  
                                                    </select>
                                                </div>  
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="submit" name="submit" class="submit-blue-btn change_status" value="適用">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pos-right ng-binding">{{count($data)}}件表示  /  {{$total}}件</div>
                                </div>
                            </div>

                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="checkall" class="checkall">
                                            </th>
                                            <th style="min-width:120px;">ステータス</th>
                                            <th style="min-width:120px;">氏名</th>
                                            <th style="min-width:120px;">氏名カナ</th>
                                            <th style="min-width:120px;">企業名</th>
                                            <th style="min-width:120px;">企業URL</th>
                                            <th style="min-width:150px;">役職名</th>
                                            <th style="min-width:150px;">メールアドレス</th>
                                            <th style="min-width:120px;">電話番号</th>
                                            <th style="min-width:220px;">事業内容、自己紹介</th>
                                            <th style="min-width:360px;">紹介者（社）名・どこで知ったか</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($data))
                                        @foreach($data as $k => $val)
                                        <tr class="@if($k%2 ==0) odd @endif">
                                            <td><input type="checkbox" name="yes[]" class="yes" value="{{$val->id}}"></td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{config('combobox.statusseminarlist')[$val->publication_setting]}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->first_name}}&nbsp;{{$val->last_name}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->hanzi_first_name}}&nbsp;{{$val->hanzi_last_name}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->business_name}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->business_url}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->position_name}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->e_mail}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->phone_number}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->content}}</td>
                                            <td class="linktr" data-href="{{URL::to('/admin/employee/other/applicantdetail/')}}/{{$val->id}}">{{$val->company_name}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ Form::close() }}
                            <div class="pagination">
                                {{ $data->appends(request()->query())->links('pagination.admin') }} 
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
        $(document).on('change','.checkall', function(){
            if($(this).is(":checked")) {
                $.each($("input.yes"), function(){            
                    $(this).prop('checked', true);
                });
            }else{
                $.each($("input.yes"), function(){            
                    $(this).prop('checked', false);
                });
            }
        });
        $(document).on('click','.change_status', function(){
            $check = false;
            $.each($("input.yes"), function(){            
                if($(this).is(":checked")) {
                    $check = true;
                }
            });
            if(!$check) {
                // alert("plz select one more subsidy!");
                return false;
            }
        });
    </script>
@endsection
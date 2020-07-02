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
                            <div class="section-1">
                                <div class="success-msg">
                                    <span>新規スタッフを登録しました。</span>
                                </div>
                            </div>

                            <div class="section-2 col-md-12">
                                {{ Form::open(['url' => '/admin/employee/other/seminardata', 'method' => 'GET', 'class' => 'form-horizontal']) }}
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">キーワード</p>
                                                <div class="col-sm-7">
                                                    {{Form::text('keyword', $request->keyword, ['class'=>'form-control', 'placeholder'=>'支払コード'])}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <p class="col-sm-3">開催日</p>
                                                <div class="col-sm-3" style="padding-right:0px;">
                                                    {{Form::number('startyear',$request->startyear, ['class'=>'form-control', 'min'=>'2017', 'max'=>'2100'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('startmonth',$request->startmonth, ['class'=>'form-control', 'min'=>'1', 'max'=>'12'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('startday',$request->startday, ['class'=>'form-control', 'min'=>'1', 'max'=>'31'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">~</p>
                                                <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('endyear',$request->endyear, ['class'=>'form-control', 'min'=>'2017', 'max'=>'2100'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('endmonth',$request->endmonth, ['class'=>'form-control', 'min'=>'1', 'max'=>'12'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('endday',$request->endday, ['class'=>'form-control', 'min'=>'1', 'max'=>'31'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-top:50px;">
                                        {{Form::submit('検索する', ['class'=>'submit-blue-btn'])}}
                                    </div>
                                {{ Form::close() }}
                            </div>
                            {{ Form::open(['url' => '/admin/employee/other/seminardata', 'method' => 'POST', 'class' => 'form-horizontal', 'id'=>'change_status']) }}
                                <div class="section-3 col-md-12">
                                    <h4 style="margin-bottom:20px;width:100%;">登録セミナーデータ</h4>
                                    <div class="row" style="margin-bottom:20px;margin-top:20px;">
                                        <div class="col-sm-12">
                                            <a style="float:left; !important; margin-left:2em;" class="submit-blue-searchright" href="{{('/admin/employee/other/seminaradd')}}">新規登録</a>
                                        </div>
                                    </div>
                                    <div class="section3-full">
                                        <div class="section3-full-scroll" style="padding-top:0px;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input class="cheall" name="cheall" value="88" type="checkbox">すべて &nbsp; &nbsp; &nbsp;
                                                    <input class="che" name="che" value="0" type="checkbox">非掲載 &nbsp; &nbsp; &nbsp;
                                                    <input class="che" name="che" value="1" type="checkbox">掲載中 &nbsp; &nbsp; &nbsp;
                                                    <input class="che" name="che" value="2" type="checkbox">掲載終了 &nbsp; &nbsp; &nbsp;
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:30px;">
                                                <div class="col-sm-3">
                                                	<div class="angularsl">
                                                        <select name="publication_setting"> 
                                                            <option value="1">非掲載</option> 
                                                            <option value="2">掲載中</option> 
                                                            <option value="3">掲載終了</option>  
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="submit" name="submit" class="submit-blue-btn change_status" value="適用">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pos-right">{{count($seminars)}}件表示 / {{$total}}件</div>
                                    </div>
                                </div>
                                <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <!--<th><input type="checkbox" name="no" ng-checked="existallcheckeditem()" ng-click="clickallcheckeditem()"></th>-->
                                                <th></th>
                                                <th style="min-width:120px;">ステータス</th>
                                                <th>セミナーID</th>
                                                <th>セミナー名</th>
                                                <th>開催日</th>
                                                <th>開催場所</th>
                                                <th>講師</th>
                                                <th>申込状況</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($seminars))
                                                @foreach($seminars as $val)
                                                <tr>
                                                    <td><input class="checkseminar" type="checkbox" name='checkseminar[]' value="{{$val->id}}" data-val="{{$val->publication_setting}}"></td>
                                                    <td class="linktr" data-href="{{URL::to('/admin/employee/other/seminaredit/')}}/{{$val->id}}">{{config('combobox.statuslist')[$val->publication_setting]}}</td>
                                                    <td class="linktr" data-href="{{URL::to('/admin/employee/other/seminaredit/')}}/{{$val->id}}">{{$val->id}}</td>
                                                    <td class="linktr" data-href="{{URL::to('/admin/employee/other/seminaredit/')}}/{{$val->id}}">{{$val->event_name}}</td>
                                                    <td class="linktr" data-href="{{URL::to('/admin/employee/other/seminaredit/')}}/{{$val->id}}">{{$val->date}}</td>
                                                    <td class="linktr" data-href="{{URL::to('/admin/employee/other/seminaredit/')}}/{{$val->id}}">{{$val->position1}}</td>
                                                    <td class="linktr" data-href="{{URL::to('/admin/employee/other/seminaredit/')}}/{{$val->id}}">{{$val->lecturer}}</td>
                                                    <td class="linktr" data-href="{{URL::to('/admin/employee/other/seminarapplicant/')}}/{{$val->id}}"><a href="/admin/employee/other/seminarapplicant/{{$val->id}}">{{$val->total}}(現在の申込者数)/{{$val->particip_count}}(定員)</a></td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            {{ Form::close() }}
                            <div class="pagination">
                                {{ $seminars->appends(request()->query())->links('pagination.admin') }} 
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
            $(document).on('click','.che', function(){
                var obj = $(this).val()
                let favorite = [];
                $.each($("input[name='che']:checked"), function(){            
                    favorite.push($(this).val());
                });
                
                $.each($("input.checkseminar"), function(){            
                    if(favorite.indexOf($(this).attr('data-val')) >= 0) {
                        $(this).prop('checked', true);
                    }else{
                        $(this).prop('checked', false);
                    }
                });
            });
            $(document).on('change','.cheall', function(){
                console.log($(this).is(":checked"));
                if($(this).is(":checked")) {
                    $.each($("input.checkseminar"), function(){            
                        $(this).prop('checked', true);
                    });
                }else{
                    $.each($("input.checkseminar"), function(){            
                        $(this).prop('checked', false);
                    });
                }
            });
            $(document).on('click','.change_status', function(){
                $check = false;
                $.each($("input.checkseminar"), function(){            
                    if($(this).is(":checked")) {
                        $check = true;
                    }
                });
                if(!$check) {
                    alert("plz select one more subsidy!");
                    return false;
                }

            });
    </script>
@endsection
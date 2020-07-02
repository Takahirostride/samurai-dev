@extends('layouts.admin')

@section('header_bottom')
    @includeIf('partials.admin.header_master')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">マスター管理</a><span>&gt;</span></li>
        <li><a>システム管理</a></li>
    </ul>
</div>
@endsection
@section('content')
<!-- ngView: -->
<div>
    <div class="content">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li><a href="{{('/admin/master/profile')}}">システム設定</a></li>
                                <li class="active"><a href="{{('/admin/master/employeeedit')}}">スタッフ登録</a></li>
                                <li><a href="{{('/admin/master/loginhistory')}}">ログイン履歴</a></li>
                                <li><a href="{{('/admin/master/edithistory')}}">編集履歴</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            @includeIf('partials.admin.flash')
                            @if(!empty(@$data->staff_id)) 
                                {{ Form::open(['url' => '/admin/master/employeeedit', 'method' => 'POST', 'class' => 'form-horizontal', 'data-toggle'=>'validator', 'id'=>'profile_validate']) }}
                            @else 
                                {{ Form::open(['url' => '/admin/master/employeeeadd', 'method' => 'POST', 'class' => 'form-horizontal', 'data-toggle'=>'validator', 'id'=>'profile_validate']) }}
                            @endif
                            <div class="section-2 col-md-12">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group" style="margin-top:30px;">
                                        <p class="col-sm-4">スタッフID</p>
                                        <p class="c">
                                            @if(!empty(@$data->staff_id)) 
                                                {{@$data->staff_id}} 
                                                {{Form::hidden('staff_id', @$data->staff_id)}}
                                            @else 
                                                自動で割り当てる 
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group" style="margin-top:20px;">
                                        <p class="col-sm-4">氏名</p>
                                        <div class="col-sm-5">
                                            {{Form::text('name', @$data->name, ['class'=>'form-control', 'placeholder'=>'氏名', 'required'=>'required'])}}
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top:20px;">
                                        <p class="col-sm-4">管理者権限</p>
                                        <div class="col-sm-6">
                                            {{Form::radio('permission', 1, false)}}master&nbsp; &nbsp; &nbsp;
                                            {{Form::radio('permission', 2, false)}}運営者 &nbsp; &nbsp; &nbsp;
                                            {{Form::radio('permission', 3, false)}}編集者
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top:20px;">
                                        <p class="col-sm-4">ログインID</p>
                                        <div class="col-sm-5">
                                            {{Form::text('login_id', @$data->login_id, ['class'=>'form-control', 'placeholder'=>'8文字以上', 'required'=>'required', 'minlength'=>8])}}
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top:20px;">
                                        <p class="col-sm-4">ログインパスワード</p>
                                        <div class="col-sm-5">
                                            {{Form::text('password', '', ['class'=>'form-control', 'placeholder'=>'8文字以上', 'required'=>'required', 'minlength'=>8, 'type'=>'password', 'id'=>'inputPassword'])}}
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top:20px;">
                                        <p class="col-sm-4">(確認)</p>
                                        <div class="col-sm-5">
                                            {{Form::text('passwordverify', '', ['class'=>'form-control', 'required'=>'required', 'minlength'=>8, 'type'=>'password', 'data-match'=>'#inputPassword'])}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:50px;">
                                {{Form::submit('登録する', ['class'=>'submit-blue-btn'])}}
                            </div>
                            {{ Form::close() }}
                            <h4 style="background-color:#F4F4F4;margin-left:10px;">スタッフ一覧</h4>

                            <div class="row" style="margin-bottom:20px;">
                                <div class="col-sm-12">
                                    {{ Form::open(['url' => '/admin/master/employeeedit', 'method' => 'GET', 'class' => 'form-horizontal searchPart']) }}
                                        <!-- <i class="glyphicon glyphicon-search"></i> -->
                                        <button type="reset"  style="margin-left:10px;" class="submit-blue-search">クリア</button>
                                        <button type="submit" class="submit-blue-search">検索</button>
                                        <input type="text" name="search" placeholder="" name="searchkeyword">
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="section-4 col-md-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>表示・編集</th>
                                            <th>登録日</th>
                                            <th>スタッフID</th>
                                            <th>名前</th>
                                            <th>権限</th>
                                            <th>ログインID</th>
                                            <th>ログインパスワード</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($staffs))
                                            @foreach($staffs as $val)
                                                <tr>
                                                    <td>
                                                        <a href="{{URL::to('/admin/master/employeeedit')}}/{{$val->id}}" style="margin-right:10px;" class="submit-edit-button"></a>
                                                        <a href="{{URL::to('/admin/master/employeeedelete')}}/{{$val->id}}" class="submit-delete-button"></a>
                                                    </td>
                                                    <td>{{$val->created_date}}</td>
                                                    <td>{{$val->staff_id}}</td>
                                                    <td>{{$val->login_id}}</td>
                                                    <td>{{config('combobox.permission')[$val->permission]}}</td>
                                                    <td>{{$val->name}}</td>
                                                    <td>**********</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
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
        function search(){
            var from_year = $('input[name="from_year"]').val();
            var from_month = $('input[name="from_month"]').val();
            var from_day = $('input[name="from_day"]').val();
            var to_year = $('input[name="to_year"]').val();
            var to_month = $('input[name="to_month"]').val();
            var to_day = $('input[name="to_day"]').val();
            $.ajax({
                url: '/admin/master/ajaxbalancedata?from_year='+from_year+'&from_month='+from_month+'&from_day='+from_day+'&to_year='+to_year+'&to_month='+to_month+'&to_day='+to_day,
                dataType: 'JSON',
                success: function(json) {
                    // console.log(json.advert_use_amount);
                    $('input[name="hire_accept_count"]').val(json.hire_accept_count);
                    $('input[name="deposit_count"]').val(json.deposit_count);
                    $('input[name="deposit_amount"]').val(json.deposit_amount);
                    $('input[name="deposit_nonpay_amount"]').val(json.deposit_nonpay_amount);
                    $('input[name="deposit_payed_amount"]').val(json.deposit_payed_amount);
                    $('input[name="deposit_pay_rate"]').val(json.deposit_pay_rate);
                    $('input[name="subsidy_count"]').val(json.subsidy_count);
                    $('input[name="subsidy_amount"]').val(json.subsidy_amount);
                    $('input[name="subsidy_nonpay_amount"]').val(json.subsidy_nonpay_amount);
                    $('input[name="subsidy_payed_amount"]').val(json.subsidy_payed_amount);
                    $('input[name="subsidy_pay_rate"]').val(json.subsidy_pay_rate);
                    $('input[name="freeuser_count"]').val(json.freeuser_count);
                    $('input[name="payuser_count"]').val(json.payuser_count);
                    $('input[name="payuser_fee_amount"]').val(json.payuser_fee_amount);
                    $('input[name="payoption_count"]').val(json.payoption_count);
                    $('input[name="payoption_amount"]').val(json.payoption_amount);
                    $('input[name="advert_use_count"]').val(json.advert_use_count);
                    $('input[name="advert_use_amount"]').val(json.advert_use_amount);
                }
            });
        }
    </script>
@endsection
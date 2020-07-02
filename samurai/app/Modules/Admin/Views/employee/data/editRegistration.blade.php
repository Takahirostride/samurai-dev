@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
    @include('Admin::partials.breadcrumb',['pagename'=>'施策データ管理'])
@endsection
@section('content')
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        @include('Admin::employee.data.sidebar')
                    </div>
<div class="col-md-9 pull-right">
<div class="site-content">
    <label style="font-size:22px;margin-top:30px;">案件詳細データ</label>
</div>                        
<div class="site-content">
    <div class="edit_regis olcbBlue">
        {!! Form::open(['url'=>route('admin.employee.data.updateRegistration',$post)]) !!}
            <p class="tit_form">公開設定</p>   
            <div class="tbrow">
                <div class="row">
                    <div class="col-md-3">
                        <div class="gridcell-left">
                            <p style="font-size:14px;">公開設定</p>
                        </div>
                    </div>
                    <div class="col-md-9" style="padding-left:0px;padding-right:0px;">
                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                            <div class="col-md-12" style="padding-left:15px;">
                                @php
                                    $check = $post->display == 0 ? true : false;
                                @endphp
                                {!! Form::checkbox('display',1,$check) !!}募集掲載不可
                            </div>
                        </div>
                    </div>
                </div>                
            </div>     

            <div class="box-submit">
                <input type="submit" name="submit" class="submit-blue-btn" value="設定変更">
            </div>

        {!! Form::close() !!}
        <form action="#" class="tbrow">
            <div class="row">
                <div class="col-md-3">
                    <div class="gridcell-left">
                        <p style="font-size:14px;">メール</p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="gridcell-right">
                        <div class="col-md-12">
                            <button type="button" class="submit-blue-left" style="width:100px;">メールする</button>
                        </div>
                    </div>
                </div>
            </div>            
        </form>
        <form>
            <p class="tit_form">ユーザー情報</p>
            <div class="tbrow">
            <div class="row">
                <div class="col-md-3">
                    <div class="gridcell-left">
                        <p style="font-size:14px;">ユーザーID</p>
                    </div>
                </div>
                <div class="col-md-9" style="padding-left:0px;padding-right:0px;">
                    <div class="gridcell-right">
                        <div class="col-md-12">
                            <b>{{$post->user_id}}</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="gridcell-left">
                        <p style="font-size:14px;">ユーザー名</p>
                    </div>
                </div>
                <div class="col-md-9" style="padding-left:0px;padding-right:0px;">
                    <div class="gridcell-right" style="height:40px;padding-right:15px;">
                        <div class="col-md-12" style="padding-left:15px;">
                            <b>{{$post->user->displayname ? $post->user->displayname : $post->user->username }}</b>
                        </div>
                    </div>
                </div>
            </div>  
            </div>          
        </form>
        <form>
            <p class="tit_form">募集案件詳細</p>
            <div  class="tbrow">
            <div class="row">
                <div class="col-md-3">
                    <div class="gridcell-left">
                        <p style="font-size:14px;">案件ID</p>
                    </div>
                </div>
                <div class="col-md-9" style="padding-left:0px;padding-right:0px;">
                    <div class="gridcell-right" style="height:40px;padding-right:15px;">
                        <div class="col-md-12" style="padding-left:15px;">
                            <b>すべて</b>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="olwr-tb">
            <table style="margin-bottom: 10px; border-bottom: 1px solid #000;"> 
                <tbody> 
                    <tr> 
                        <td rowspan="1" style="width: 20%">
                            <b>依頼タイトル</b>
                        </td>                                     
                        <td colspan="2" style="width: 100%">
                            <b>{{$post->title}}</b>
                        </td>                                     
                    </tr>
                    <tr> 
                        <td rowspan="1" style="width: 20%"> 
                            <b>依頼の目的・背景</b>
                        </td>                                     
                        <td colspan="2" style="max-width: 100%">
                            <b>{{$post->content}}</b>
                        </td>
                    </tr>
                    <tr> 
                        <td rowspan="1" style="width: 20%">
                            <b>重視する点</b>
                        </td>                                     
                        <td colspan="2" style="width: 100%">
                            <b>{{ $post->mainPointName() }}</b>
                        </td>                                     
                    </tr>
                    <tr> 
                        <td rowspan="1" style="width: 20%"> 
                            <b>補足説明</b>
                        </td>                                     
                        <td colspan="2" style="max-width: 100%">
                            @foreach ($post->sub_content as $ct)
                                <b>
                                    <span class="date">{{ ol_get_datetime_string($ct['date']) }}</span>
                                    <br>
                                    <span>{{ ol_unicode_decode($ct['content']) }}</span>
                                    <br>
                                </b>
                            @endforeach
                        </td>
                    </tr>
                    <tr> 
                        <td rowspan="1" style="width: 20%">
                            <b>添付ファイル</b>
                        </td>                                     
                        <td colspan="2" style="width: 100%">
                            <p style="margin-top: 10px">
                                @foreach ($post->file as $file)
                                    <a href="{{ ol_get_link_file($file[1]) }}" class="oldown" download>{{ $file[0] }}</a>
                                @endforeach
                            </p>
                        </td>
                    </tr>
                    <tr> 
                        <td rowspan="1" style="width: 20%">
                            <b>募集の締め切り</b>
                        </td>                                     
                        <td colspan="2" style="width: 100%">
                            <b>{{ol_get_date_string($post->complete_date)}}</b>
                        </td>                                     
                    </tr>
                    <tr> 
                        <td rowspan="1" style="width: 20%">
                            <b>依頼業務</b>
                        </td>                                     
                        <td colspan="2" style="width: 100%">
                            @if($post->document_business_price)
                            <b>書類代行　　　{{$post->document_business_price}}<span>{{ $post->documentBusinessTypeName() }}</span></b>
                            @endif
                            </br>
                            @if($post->request_business_price)
                            <b>申請代行　　　{{$post->request_business_price}}<span>{{ $post->requestBusinessTypeName() }}</span></b><br>
                            @endif
                        </td>                                     
                    </tr>
                    <tr> 
                        <td rowspan="1" style="width: 20%">
                            <b>着手金</b>
                        </td>                                     
                        <td colspan="2" style="width: 100%">
                            <b>{{$post->deposit_money}}円以下希望</b>
                        </td>                                     
                    </tr>
                </tbody>
            </table> 
            </div>  
            <div class="payroll">
                @include('Admin::employee.data.admin_payroll',['pay_option'=>$post->pay_option])
            </div>                    
        </form>
        <div class="bl_policy container">
            <div class="tbrow">
                <div class="row">
                    <div class="col-md-3">
                        <div class="gridcell-left">
                            <p style="font-size:14px;">施策ID</p>
                        </div>
                    </div>
                    <div class="col-md-9" style="padding-left:0px;padding-right:0px;">
                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                            <div class="col-md-12" style="padding-left:15px;">
                                <b>{{$post->policy_id}}</b>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            @if($post->policy)
            <div class="policy-show">
                <p style="font-size:30px;">{{$post->policy->name}}</p>
                <div class="row" style="margin-top:10px;margin-bottom:10px">
                    <p class="h1-left-border" style="border-left: 5px solid rgb(240, 164, 17);"><b>登録機関</b></p>
                    <p style="margin-top: 10px">{{ ($post->policy->subMinitry)?$post->policy->subMinitry->city_name : '' }}</p>
                </div>
                <div class="row" style="margin-top:10px;margin-bottom:10px">
                    <p class="h1-left-border" style="border-left: 5px solid rgb(240, 164, 17);"><b>目的</b></p>
                    <p style="margin-top: 10px">{!! $post->policy->target !!}</p>
                </div>
                <div class="row" style="margin-top:10px;margin-bottom:10px">
                    <p class="h1-left-border" style="border-left: 5px solid rgb(240, 164, 17);"><b>対象者の詳細</b></p>
                    <p style="margin-top: 10px">{!! $post->policy->info!!}</p>
                </div>
                <div class="row" style="margin-top:10px;margin-bottom:10px">
                    <p class="h1-left-border" style="border-left: 5px solid rgb(240, 164, 17);"><b>支援内容・支援規模</b></p>
                    <p style="margin-top: 10px">{!! $post->policy->support_content!!}<br/>{!!$post->policy->support_scale!!}</p>
                </div>
                <div class="row" style="margin-top:10px;margin-bottom:10px">
                    <p class="h1-left-border" style="border-left: 5px solid rgb(240, 164, 17);"><b>募集期間</b></p>
                    <p style="margin-top: 10px">{!! $post->policy->subscript_duration!!}</p>
                </div>
                <div class="row" style="margin-top:10px;margin-bottom:10px">
                    <p class="h1-left-border" style="border-left: 5px solid rgb(240, 164, 17);"><b>対象期間</b></p>
                    <p style="margin-top: 10px">{{$post->policy->object_duration}}</p>
                </div>
                <div class="row" style="margin-top:10px;margin-bottom:10px">
                    <p class="h1-left-border" style="border-left: 5px solid rgb(240, 164, 17);"><b>その他</b></p>
                    <p style="margin-top: 10px">
                        @foreach ($post->policy->register_pdf as $element)
                            @php
                                if(count($element) < 2){continue;}
                            @endphp
                            <a href="{{ $element[1] }}">{{ $element[0] }}</a>
                        @endforeach                        
                    </p>
                </div>
                            
            </div>
            @endif
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

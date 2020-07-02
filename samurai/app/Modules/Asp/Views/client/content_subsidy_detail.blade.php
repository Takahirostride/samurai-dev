@php
if(!isset($policy)){return false;}
@endphp
<div class="row">
    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
        <h2 class="stitle1">{{ $policy->name }}</h2>
        <p class="stitle2">{{ $policy->name_serve }}</p>        
    </div>
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        <div class="p-action">
        @include('Asp::client.btn_mail_subsidy')        
         @include('Asp::layouts.partial_file.btn_favorite_subsidy_text',['element'=>$policy]) 
        </div>       
    </div>

</div>
<div class="plc-company">
<div class="row">
    <div class="col-md-4">
        登録機関:{{ $policy->companyName() }}
    </div>
    <div class="col-md-4">
        更新日: {{ $policy->update_date }}
    </div>
    <div class="col-md-4">
        掲載終了予定日：{{ ol_get_date_string($policy->subscript_duration_detail) }}
    </div>

</div>                
</div>
<ul class="tag-list">
@foreach ($policy->tags as $ite)
    <li>
        <span>{{ $ite->tag }}</span>
    </li>
@endforeach
</ul>          
<div class="sdetail">
<p class="sdetail-title">概要</p>
<p>{!! nl2br($policy->target) !!}</p>
<p class="sdetail-title">支援内容</p>
<p>{!! nl2br($policy->support_content) !!}</p>
@if(!empty($policy->support_scale))
<p class="sdetail-title">支援規模</p>
@endif
<p>{!! nl2br($policy->support_scale) !!}</p>
<p class="sdetail-title">募集期間</p>
<p>{{ $policy->subscript_duration }}</p>
@if(!empty($policy->object_duration))
<p class="sdetail-title">対象期間</p>
<p>{!! nl2br($policy->object_duration) !!}</p>
@endif
<p class="sdetail-title green">対象者の詳細</p>
<p>{!! nl2br($policy->info) !!}</p>
<p class="sdetail-title green">対象地域</p>
<div class="list-region">
    @foreach ($policy->policyReg as $reg)
        <span class="item">{{ $reg->regionName() }}</span>
    @endforeach                    
</div>
@if(!empty($policy->adopt_result))
<p class="sdetail-title">採択結果</p>
<p>{!! nl2br($policy->adopt_result) !!}</p>
@endif
@if(!empty($policy->register_pdf) && !empty($policy->register_pdf1))
<p class="sdetail-title">資料</p>
    @include('Asp::layouts.partial_file.policy_pdf',['pdfs'=>$policy->register_pdf])
    @include('Asp::layouts.partial_file.policy_pdf',['pdfs'=>$policy->register_pdf1])  
@endif                 
<p class="sdetail-title">お問い合わせ</p>
<p>{!! nl2br($policy->inquiry) !!}</p>                               
</div><!-- end .sdetail -->

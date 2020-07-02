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
<div class="site-content noborder">
    <h3 class="tit-page">施策詳細データ</h3>
</div>                        
<div class="site-content noborder">
    <div class="olcbBlue olradBlue">
    {!! Form::open(['url'=>route('admin.employee.data.subsidy_update',$policy),'class'=>'fr-validator','id'=>'fr-edit-policy']) !!}
    <div class="active" id="blstep1">
        <div class="add-container tbrow" >
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">施策ID</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right" style="height:40px;">
                    <p style="font-size:14px;">{{ $policy->id }}</p>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">クローリングページURL</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right" style="height:40px;">
                    <p style="font-size:14px;"><a href="{{ $policy->scraping_url }}" target="_blank">{{ $policy->scraping_url }}</a></p>
                </div>
            </div>
        </div>            
        <div class="row">
            <div class="col-md-3" style="height:272px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;">更新日</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <p>{{ $policy->update_date }}</p>   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">施策名<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <div class="form-group">
                       {!! Form::text('name',$policy->name,['class'=>'form-control','required']) !!} 
                       <div class="help-block with-errors"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">施策名（サブ）</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    {!! Form::text('name_serve',$policy->name_serve,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">発行機関<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right" style="height:40px;">
                    <div class="row">
                        <div class="col-md-4 form-group input-label">
                            {!! Form::selectMinitryProvince('minitry_id',$policy->minitry_id,['required','data-children'=>'#sub_minitry_province']) !!}
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4 form-group">
                            {!! Form::selectSubMinitry('sub_minitry_id',$policy->sub_minitry_id,['id'=>'sub_minitry_province']) !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">画像ID<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9">
                {!! Form::uploadImage('image_id',$policy->image_id,['required']) !!}
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3" style="height:220px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">目的<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <div class="form-group">
                        {!! Form::textarea('target',$policy->target,['class'=>'form-control','required']) !!}
                        <div class="help-block with-errors"></div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="height:300px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">カテゴリー<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9" style="height:300px;overflow-y:auto;border-bottom: #000000 1px solid;">
                <div class="help-block with-errors"></div>
                <div id="cat_sel" class="oladd-block">
                    <div class="results">
                        @php
                            $cats = $policy->policyCat->groupBy('category_id')->all();
                        @endphp
                        @foreach ($cats as $key=>$el)
                            <div class="ol_item" data-cat="{{ $key  }}" data-children="{{ $el->implode('sub_category_id',',') }}"></div>
                        @endforeach
                    </div>
                    <div class="controls">
                        <div class="gridcell-right">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::select('cat_list',[],null,['class'=>'form-control cat-list']) !!}
                                <br>
                                <button type="button" class="submit-blue-left ol-add" style="width:100px;">新規追加</button>
                            </div>
                        </div>                        
                        </div>                        
                    </div>
                </div>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">誘致関連施策</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right" style="height:40px;">
                    {!! Form::checkbox('location',1,$policy->location) !!}立地・誘致関連施策
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-3" style="height:162px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;">タグ</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right" style="height:162px;overflow:auto;">
                    <div class="row">
                        <div class="form-group">
                        <div class="tagdonate bl_tags" id="checkbox-tags">
                        @php
                                $tag_def = $policy->tags ? $policy->tags->pluck('id')->all() : [];
                        @endphp    
                        @foreach ($tags as $k_tag=>$tag)
                            <label class="graybutton" style="width: auto;"><input type="checkbox" name="tags[]" class="btn-cb" value="{{ $k_tag }}" {{ in_array($k_tag,$tag_def) ? 'checked' : '' }}><span>{{ $tag }}</span></label>
                        @endforeach
                        </div> 
                        <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>          
        <div class="row">
            <div class="col-md-3" style="height:122px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">対象者の詳細<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <div class="form-group">
                        {!! Form::textarea('info',strip_tags($policy->info),['class'=>'form-control','required'])!!}
                        <div class="help-block with-errors"></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="height:162px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;">業種<span class="required">*</span></p>
                    <button type="button" class="submit-blue-left check_all" data-check="traccheck" style="width:100px;">全選択</button>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right" style="height:162px;overflow:auto;">
                    <div class="row">
                        <div class="tagdonate bl_tags" id="checkbox-trade">
                        @php
                                $trade_df = $policy->trades ? $policy->trades->pluck('id')->all() : [];
                            @endphp    
                        @foreach ($trades as $k_tag=>$tag)
                            <label class="graybutton" style="width: auto;"><input type="checkbox" name="trades[]" class="btn-cb traccheck" value="{{ $k_tag }}" {{ in_array($k_tag,$trade_df) ? 'checked' : '' }}><span>{{ $tag }}</span></label>
                        @endforeach
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div> 
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3" style="height:160px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">対象地域<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9" style="height:160px;overflow-y:auto;border-bottom: #000000 1px solid;">
                    <div id="region_sel" class="oladd-block">
                        <div class="results">
                            @foreach ($policy->policyReg as $k_ite=>$item)
                                <div class="ol_item gridcell-right">
                                <div class="row">
                                <div class="col-md-4">
                                @if($item->province)    
                                <input type="hidden" name="region[{{ $k_ite }}][province]" value="{{ $item->province->id }}">
                                <span class="name name-province">{{ $item->province->province_name }}</span>
                                @endif
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                @if($item->city)    
                                <input type="hidden" name="region[{{ $k_ite }}][city]" value="{{ $item->city->id }}">
                                <span class="name name-city">{{ $item->city->city_name }}</span>
                                @endif
                                </div>
                                <div class="col-md-3">
                                <span class="glyphicon glyphicon-remove-circle ol-del"></span>
                                </div>
                                </div>
                                </div>                                
                            @endforeach
                        </div>
                        <div class="controls">
                            <div class="gridcell-right">
                                <div class="row">
                                    <div class="col-md-4" style="z-index: 1;">
                                        {!! Form::selectMinitry('province_name',null,['id'=>'province_id_name','data-children'=>'#city_id_name'] ) !!}                                        </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4" style="z-index: 1;">
                                        {!! Form::selectSubMinitry('city_name',null,['id'=>'city_id_name'] ) !!} 
                                    </div>
                                </div>
                                
                            </div>
                            <div class="gridcell-right">
                                <button type="button" class="submit-blue-left ol-add" style="width:100px;">新規追加</button>
                            </div>
                        </div>                                                 
                    </div>
                    <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="height:370px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">対象企業条件</p>
                </div>
            </div>
            <div class="col-md-9" style="height:370px;border-bottom: #000000 1px solid;">
                <div class="gridcell-right">
                    <div class="row">
                        <div class="col-md-5">創業年数</div>
                        <div class="col-md-3">
                            <div class="form-group">
                            {!! Form::number('founding_year_start',$policy->founding_year_start,['class'=>'form-control number','min'=>0,'placeholder'=>'設定なし', 'id'=>'founding_year_start']) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-1" style="text-align:center">~</div>
                        <div class="col-md-3">
                            <div class="form-group" id="founding_year_end_in">
                            {!! Form::number('founding_year_end',$policy->founding_year_end,['class'=>'form-control number','min'=>0,'placeholder'=>'設定なし']) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gridcell-right">
                    <div class="row">
                        <div class="col-md-5">資本金</div>
                        <div class="col-md-3">
                            <div class="form-group">
                            {!! Form::text('capital_start',$policy->capital_start,['class'=>'olNumber form-control number','min'=>0,'placeholder'=>'設定なし','pattern'=>"[0-9,]*"]) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-1" style="text-align:center">~</div>
                        <div class="col-md-3">
                            <div class="form-group">
                            {!! Form::text('capital_end',$policy->capital_end,['class'=>'olNumber form-control number','min'=>0,'placeholder'=>'設定なし','pattern'=>"[0-9,]*"]) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gridcell-right">
                    <div class="row">
                        <div class="col-md-5">従業員数（正社員）</div>
                        <div class="col-md-3">
                            <div class="form-group">
                            {!! Form::text('employees_count_start',$policy->employees_count_start,['class'=>'olNumber form-control number','min'=>0,'placeholder'=>'設定なし','pattern'=>"[0-9,]*"]) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-1" style="text-align:center">~</div>
                        <div class="col-md-3">
                            <div class="form-group">
                            {!! Form::text('employees_count_end',$policy->employees_count_end,['class'=>'olNumber form-control number','min'=>0,'placeholder'=>'設定なし','pattern'=>"[0-9,]*"]) !!}
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>                          
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="height:220px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">支援内容<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <div class="form-group">
                        {!! Form::textarea('support_content',strip_tags($policy->support_content),['class'=>'form-control','required'])!!}
                        <div class="help-block with-errors"></div>
                    </div>                   
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="height:40px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;">取得可能金額設定</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <div class="row">
                        <div class="col-md-4">
                              @php
                                  $amounts = config('policy.amount_list');
                                  $check_ar = $policy->acquire_budget && count($policy->acquire_budget) > 0 ? $policy->acquire_budget[0] :-1;
                              @endphp                            
                            <div class="form-group input-label">
                                <select name="acquire_budget[]" class="form-control" required>
                                    @foreach ($amounts as $ite)
                                        <option value="{{ $ite }}" {{ $ite==$check_ar ? 'selected':'' }}>{{ $ite }}</option>
                                    @endforeach
                                </select> 
                                <span class="required">*</span>
                                <div class="help-block with-errors"></div>                           
                            </div>
                        </div>
                        <div class="col-md-4" style="padding: 0 5px;">
                        @php
                            $acquire_lst = config('policy.acquire_budget_first');
                        @endphp
                        <div class="form-group input-label">
                            <select name="acquire_budget_first" class="form-control" required>
                                <option value="">支援区分</option>
                                @foreach ($acquire_lst as $ite)
                                    <option value="{{ $ite }}" {{ $ite==$policy->acquire_budget_first ? 'selected':'' }}>{{ $ite }}</option>
                                @endforeach
                            </select> 
                            <span class="required">*</span>
                            <div class="help-block with-errors"></div>                           
                        </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               {!! Form::text('acquire_budget_display',$policy->acquire_budget_display,['class'=>'olNumber form-control']) !!} 
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="gridcell-right" id="bl-support-scale">
                    <table class="table oltb">
                        <tr>
                            <td>
                                    <p class="ip-title">下限</p>
                                    <div class="form-group">
                                    {!! Form::number('support_scale_lower_limit',$policy->support_scale_lower_limit,['class'=>'form-control number','min'=>0]) !!}
                                    <div class="help-block with-errors"></div>
                                    </div>
                            </td>
                            <td>
                                    <p class="ip-title">上限</p>
                                    <div class="form-group">
                                    {!! Form::number('support_scale_upper_limit',$policy->support_scale_upper_limit,['class'=>'form-control number','min'=>0]) !!}
                                    <div class="help-block with-errors"></div>
                                    </div>
                            </td>
                            <td>
                                    <p class="ip-title">助成率</p>
                                    <div class="form-group">
                                    {!! Form::text('support_scale_subsidy_duration',$policy->support_scale_subsidy_duration,['class'=>'form-control']) !!}
                                        <div class="help-block with-errors"></div>
                                    </div>    
                            </td>                            
                        </tr>

                    </table>
                </div>                
            </div>
        </div>  
        <div class="row">
            <div class="col-md-3" style="height:196px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">支援規模</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    {!! Form::textareaTiny('support_scale',strip_tags($policy->support_scale),['class'=>'form-control'])!!}
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3" style="height:122px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">対象期間</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    {!! Form::textarea('object_duration',$policy->object_duration,['class'=>'form-control'])!!}
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3" style="height:122px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">募集期間<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <div class="form-group">
                        {!! Form::textarea('subscript_duration',$policy->subscript_duration,['class'=>'form-control','required'])!!}
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3" style="height:272px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;">掲載終了日<span class="required">*</span></p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <div class="row">
                        <div class="col-sm-10">
                            @php
                                $year = $policy->subscript_duration_detail ?$policy->subscript_duration_detail->year : null;
                                $month = $policy->subscript_duration_detail ?$policy->subscript_duration_detail->month : null;
                                $day = $policy->subscript_duration_detail ?$policy->subscript_duration_detail->day : null;
                            @endphp
                            <div id="update_date_block">
                                <div class="form-group box-date year">
                                    {!! Form::number('subscript_duration_detail[year]',$year,['class'=>'form-control','min'=>2000]) !!}
                                    <span class="text">年</span>
                                </div>
                                <div class="form-group box-date">
                                    {!! Form::number('subscript_duration_detail[month]',$month,['class'=>'form-control','min'=>1,'max'=>12]) !!}
                                    <span class="text">月</span>
                                </div>
                                <div class="form-group box-date">
                                    {!! Form::number('subscript_duration_detail[day]',$day,['class'=>'form-control','min'=>1,'max'=>31]) !!}
                                    <span class="text">日</span>
                                </div>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="col-sm-2">
                            <label>{!! Form::checkbox('subscript_duration_option',1,$policy->subscript_duration_option) !!}随時</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">採択結果</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    {!! Form::text('adopt_result',$policy->adopt_result,['class'=>'form-control','require']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="height:122px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">お問い合わせ</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right">
                    <div class="form-group">
                    {!! Form::textarea('inquiry',$policy->inquiry,['class'=>'form-control'])!!}
                    <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="height:560px;">
                <div class="gridcell-left">
                    <p style="font-size:14px;position: relative;top:40%;">資料</p>
                </div>
            </div>
            <div class="col-md-9">
                <div id="bl_register_pdf">
                    {!! Form::uploadPdfMulti('register_pdf',$policy->register_pdf) !!}                        
                </div>
                <div id="bl_register_pdf1">                
                    @foreach (range(0,5) as $k=>$val)
                    @php
                        $ite = empty($policy->register_pdf1[$val]) ? ['name'=>'','url'=>''] : $policy->register_pdf1[$val];
                    @endphp                
                    <div class="gridcell-right input-group">
                        <div class="row">
                            <div class="col-md-5">
                                <input class="form-control upl-name" placeholder="表示ファイル名" name="register_pdf1[{{ $k }}][name]" value="{{ @$ite['name'] }}">
                            </div>
                            <div class="col-md-offset-1 col-md-6">
                                <input class="form-control upl-sv"  placeholder="登録URL" name="register_pdf1[{{ $k }}][url]" value="{{ @$ite['url'] }}">
                            </div>                        
                        </div>
                    </div> 
                    @endforeach                       
                </div>
                           
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">おすすめの施策</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right" style="height:40px;">
                    {!! Form::checkbox('recom_bounty',1,$policy->recom_bounty) !!}設定する &nbsp; &nbsp; &nbsp;
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
                    @php
                        $status = config('policy.status_list');
                        array_pop($status);

                        $s_check = ($policy->publication_setting !== 0 && empty($policy->publication_setting)) ? 1 : $policy->publication_setting;
                        if($policy->subscript_duration_detail != '0000-00-00' && $policy->subscript_duration_option == 0) {
                            if(strtotime(date('Y-m-d H:i:s')) > strtotime($policy->subscript_duration_detail)) {
                                $s_check = 3;
                            }
                        }
                        
                    @endphp
                    @foreach ($status as $k=>$ite)
                        <input type="radio" name="publication_setting" 
                            value="{{ $k }}" 
                            {{ $k==$s_check ? 'checked':'' }}
                        />{{ $ite }} &nbsp; &nbsp; &nbsp;
                    @endforeach
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-3">
                <div class="gridcell-left">
                    <p style="font-size:14px;">登録者ID</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="gridcell-right" style="height:40px;">
                    {{ $policy->agency_id }}
                </div>
            </div>
        </div>                            
        </div>                            
        <div class="box-submit">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <a href="{{ route('admin.employee.data.subsidylist') }}" class="submit-blue-btn btn-back" onClick="window.history.back()">戻る</a>
                </div>
                <div class="col-md-3">
                    <input type="button" class="btn-step2 submit-blue-btn" value="プレビュー">
                </div>
                <div class="col-md-3"></div> 
            </div>                
        </div>
    </div>
    <div class="subsidy-prev" id="blstep2">
        <div class="content">
            <h3 class="title oldata" data-text="name"></h3>
            <p class="desc oldata" data-text="name_serve"></p>
            <div class="tags oldata" data-multicbox="tags"></div>
            <div class="row">
                <div class="col-md-4">
                    <p>登録機関:<span class="oldata" data-select="minitry_id"></span> <span class="oldata" data-select="sub_minitry_id"></span></p>
                </div>
                <div class="col-md-4">
                    <p>更新日:{{ $policy->update_date }}</p>
                </div>
            </div>
            <h4 class="tit-element">目的</h4>
            <div class="area oldata" data-area="target"></div>
            <h4 class="tit-element">対象者の詳細</h4>
            <div class="area oldata" data-area="info"></div>
            <h4 class="tit-element">支援内容</h4>
            <div class="area oldata" data-area="support_content"></div>
            <h4 class="tit-element">支援規模</h4>
            <table class="table oltb">
                <tr>
                    <th>下限</th>
                    <th>上限</th>
                    <th>助成率</th>
                </tr>
                <tr>
                    <td class="oldata" data-text="support_scale_lower_limit"></td>
                    <td class="oldata" data-text="support_scale_upper_limit"></td>
                    <td class="oldata" data-text="support_scale_subsidy_duration"></td>
                </tr>
            </table>
            <div class="area oldata" data-area="support_scale"></div>
            <h4 class="tit-element">募集期間</h4>
            <div class="area oldata" data-area="subscript_duration"></div>
            <h4 class="tit-element">対象地域</h4>
            <div class="oldata" data-multiselect="#region_sel"></div>
            <h4 class="tit-element">採択結果</h4>
            <p class="oldata" data-text="adopt_result"></p>
            <h4 class="tit-element">掲載終了日</h4>
            <p>
                <span class="oldata date" data-date="subscript_duration_detail"></span>
                <span class="oldata" data-checkbox="subscript_duration_option">随時</span>
            </p>
            <h4 class="tit-element">pdfデータ</h4>
            <div class="oldata" data-pdf="#bl_register_pdf"></div>
            <div class="oldata" data-pdf="#bl_register_pdf1"></div>
            <h4 class="tit-element">お問い合せ</h4>
            <div class="area oldata" data-area="inquiry"></div>
        </div>
        <div class="box-submit">
            <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <input type="submit" class="submit-blue-btn" value="保存する"</div>
            </div>
            <div class="col-md-3">
                <input type="button" class="btn-step1 submit-blue-btn" value="戻る"</div>
            <div class="col-md-3"></div> 
            </div>                
        </div>        
    </div>   
    {!! Form::close() !!}                                                    
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
@include('Admin::employee.data.edit_script')
@endsection

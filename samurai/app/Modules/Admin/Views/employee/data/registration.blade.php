@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
    @include('Admin::partials.breadcrumb',['pagename'=>'施策データ管理'])
@endsection
@section('content')
<div class="ng-scope ollayout" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        @include('Admin::employee.data.sidebar')
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content"> 
                            <div class="ft-reg">
                                @include('Admin::partials/form-filter',['button_center'=>true,'filters'=>$filters])
                            </div>                                                       
                            {!! Form::open(['url'=>request()->url(),'method'=>'get']) !!}
                            <div class="subsidy-act olcbBlue">
                                <h4>登録募集施策データ</h4>
                                <ul class="lst-sel" id="subsidy-cbox">
                                    <li>
                                        <input type="checkbox" class="olAll">すべて
                                    </li>
                                    @php
                                        $lst = App\Modules\Admin\Models\Post::DISPLAY_LIST;
                                    @endphp
                                    @foreach ($lst as $key=>$ite)
                                        <li>
                                           <input type="checkbox" class="check_all olCheckData" data-name="posts[]" data-check="{{ $key }}">{{ $ite }} 
                                        </li>
                                        
                                    @endforeach
                                </ul>
                            </div>
                            @include('Admin::partials/form-action',compact('actions'))
                            <div class="section-5 olcbBlue olScrollTop olRowlink col-md-12" style="overflow-x:auto;display:block;">
                                <table class="oltb-exc">
                                    <thead>
                                        <tr>
                                        <th></th>
                                        <th style="min-width:120px;">ステータス</th>
                                        <th style="min-width:80px;">施策ID</th>
                                        <th style="min-width:130px;">施策名</th><!-- 5 -->
                                        <th style="min-width:130px;">施策名Sub</th>
                                        <th style="min-width:150px;">登録機関</th>
                                        <th style="min-width:250px;">分野・カテゴリー</th>
                                        <th style="min-width:250px;">対象地域</th>
                                        <th style="min-width:150px;">更新日</th><!-- 10 -->
                                        <th style="min-width:550px;">目的</th>
                                        <th style="min-width:450px;">対象者の詳細</th>
                                        <th style="min-width:450px;">支援内容</th>
                                        <th style="min-width:190px;">取得可能金額</th>
                                        <th style="min-width:450px;">支援規模</th><!-- 15 -->
                                        <th style="min-width:250px;">募集期間</th>
                                        <th style="min-width:250px;">対象期間</th>
                                        <th style="min-width:80px;">採択結果</th>
                                        <th style="min-width:80px;">登録PDF</th>
                                        <th style="min-width:250px;">お問い合わせ</th>
                                        <th style="min-width:100px;">おすすめの助成金補助金</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values as $value)
                                            <tr data-link="{{ route('admin.employee.data.edit_registration',$value) }}">
                                                <td class="nolink"><input type="checkbox" name="posts[]" value="{{ $value->id }}" data-check="{{ $value->display }}" ></td>
                                                <td>{{$value->displayName()}}</td>
                                                @if(!$value->policy)
                                                <td colspan="19"></td>
                                                @else
                                                <td>{{$value->policy->id}}</td>
                                                <td>{{$value->policy->name}}</td><!-- 5 -->
                                                <td>{{$value->policy->name_serve}}</td>
                                                <td>{{ ($value->policy->subMinitry)?$value->policy->subMinitry->city_name : '' }}</td>
                                                <td>{{$value->policy->categoryName()}}</td>
                                                <td>{{$value->policy->regionName()}}</td>
                                                <td>{{$value->policy->UpdateDateName()}}</td><!-- 10 -->
                                                <td>{{ str_limit(strip_tags($value->policy->target),100,'...') }}</td>
                                                <td>{{ str_limit(strip_tags($value->policy->info),100,'...') }}</td>
                                                <td>{{ str_limit(strip_tags($value->policy->support_content),100,'...') }}</td>
                                                <td>{{ $value->policy->acquireBudgetName() }}</td>
                                                <td>{{ str_limit(strip_tags($value->policy->support_scale),100,'...') }}</td>
                                                <td>{{$value->policy->subscript_duration}}</td><!-- 15 -->
                                                <td>{{$value->policy->object_duration}}</td>
                                                <td>{{$value->policy->adopt_result}}</td>
                                                <td>
                                                    @foreach ($value->policy->register_pdf as $element)
                                                        @php
                                                            if(count($element) < 2){continue;}
                                                        @endphp
                                                        <a href="{{ $element[1] }}">{{ $element[0] }}</a>
                                                    @endforeach
                                                </td>
                                                <td>{{ str_limit(strip_tags($value->policy->inquiry),100,'...') }}</td>
                                                <td>{{ $value->policy->recomBountyName() }}</td>    @endif                                           
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! Form::close() !!}
                            {!! $values->appends(request()->query())->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@include('Admin::employee.data.subsidy_script')
@endsection

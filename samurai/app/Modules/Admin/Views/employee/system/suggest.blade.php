@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>システム管理</a></li>
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
	                                <!-- <li><a href="{{URL::to('/admin
/employee/system/advertisement')}}">広告表示管理</a></li> -->
	                                <li><a href="{{URL::to('/admin
/employee/system/uservoice')}}">利用者の声</a></li>
	                                <li><a href="{{URL::to('/admin
/employee/system/alim')}}">お知らせ</a></li>
	                                <li class="active"><a href="{{URL::to('/admin
/employee/system/suggest')}}">おススメの助成金</a></li>
	                                <li><a href="{{URL::to('/admin
/employee/system/industry')}}">業種</a></li>
	                                <li><a href="{{URL::to('/admin
/employee/system/tag')}}">タグ管理</a></li>
	                                <li><a href="{{URL::to('/admin
/employee/system/category')}}">カテゴリー管理</a></li>
	                                <li><a href="{{URL::to('/admin
/employee/system/question')}}">企業情報質問内容管理</a></li>
	                                <li><a href="{{URL::to('/admin
/employee/system/payinfo')}}">有料情報管理</a></li>
	                                <li><a href="{{URL::to('/admin
/employee/system/notification')}}">通知管理</a></li>
	                                <li><a href="{{URL::to('/admin
/employee/system/blog')}}">ブログ管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">

                        <div class="site-content"> 
                            <div class="ft-subsidy">
                                @include('Admin::partials/form-filter',compact('filters'))
                            </div>                                                       
                            {!! Form::open(['url'=>request()->url(),'method'=>'get']) !!}
                            <div class="subsidy-act">
                                <h4>おすすめの助成金補助金</h4>
                            </div>
                            @include('Admin::partials/form-action',compact('actions'))
                            <div class="section-5 col-md-12" style="overflow-x:auto;display:block;">
                                <table class="oltb-exc">
									<thead>
										<tr>
											<th><input type="checkbox" class="check_all olCheckAll" data-name="posts[]"></th>
											<th></th>
											<th style="min-width:120px;">ステータス</th>
											<th style="min-width:80px;">{!! ol_get_sort_link('id','施策ID') !!}
											</th>
											<th style="min-width:200px;">施策名</th><!-- 5 -->
											<th style="min-width:200px;">施策名Sub</th>
											<th style="min-width:150px;">{!! ol_get_sort_link('sub_minitry_id','発行機関') !!}</th>
											<th style="min-width:250px;">分野・カテゴリー</th>
											<th style="min-width:250px;">対象地域</th>
											<th style="min-width:180px;">更新日</th><!-- 10 -->
											<th style="min-width:550px;">目的</th>
											<th style="min-width:450px;">対象者の詳細</th>
											<th style="min-width:450px;">支援内容</th>
											<th style="min-width:190px;">取得可能金額</th>
											<th style="min-width:450px;">支援規模</th>
											<th style="min-width:250px;">募集期間</th><!-- 16 -->
											<th style="min-width:250px;">対象期間</th>
											<th style="min-width:200px;">採択結果</th>
											<th style="min-width:200px;">登録PDF</th>
											<th style="min-width:250px;">お問い合わせ</th>
											<th style="min-width:100px;">おすすめの助成金補助金</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($values as $value)
										<tr>
											<td><input type="checkbox" name="posts[]" value="{{ $value->id }}"></td>
											<td><a href="{{ route('admin.employee.data.subsidy_edit',$value) }}" class="submit-edit-button"></a></td>
											<td><p>{{$value->statusName()}}</p></td>
											<td><p>{{$value->id}}</p></td>
											<td><p>{{$value->name}}</p></td><!-- 5 -->
											<td><p>{{$value->name_serve}}</p></td>
											<td><p>{{ ($value->subMinitry)?$value->subMinitry->city_name : '' }}</p></td>
											<td><p>{{ $value->categoryName() }}</p></td>
											<td><p>{{ $value->regionName() }}</p></td>
											<td><p>{{ $value->update_date }}</p></td>
											<td><p>{{ str_limit(strip_tags($value->target),100,'...') }}</p></td><!-- 10 -->
											<td><p>{{ str_limit(strip_tags($value->info),100,'...') }}</p></td>
											<td><p>{{ str_limit(strip_tags($value->support_content),100,'...') }}</p></td>
											<td><p>{{ $value->acquireBudgetName() }}</p></td>
											<td><p>{{ str_limit(strip_tags($value->support_scale),100,'...') }}</p></td>
											<td><p>{{ $value->subscript_duration }}</p></td><!-- 15 -->
											<td><p>{{ $value->object_duration }}</p></td>
											<td><p>{{ $value->adopt_result }}</p></td>
											<td><p>
                                                    @foreach ($value->register_pdf as $element)
                                                        @php
                                                            if(count($element) < 2){continue;}
                                                        @endphp
                                                        <a href="{{ $element[1] }}">{{ $element[0] }}</a>
                                                    @endforeach												
											</p></td>
											<td><p>{{ str_limit(strip_tags($value->inquiry),100,'...') }}</p></td>
											<td><p>{{ $value->recomBountyName() }}</p></td>
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
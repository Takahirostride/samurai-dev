@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
    @include('Admin::partials.breadcrumb',['pagename'=>'顧客対応管理'])
@endsection
@section('content')
<div class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        @include('Admin::employee.data.sidebar')
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content"> 
                            <div class="ft-subsidy">
                                @include('Admin::partials/form-filter',['filters'=>$filters,'button_center'=>true])
                            </div>                                                       
                            {!! Form::open(['url'=>request()->url(),'method'=>'get']) !!}
                            <div class="line2"></div>
                            @include('Admin::partials/form-action',compact('actions'))
                            <div class="section-5 olcbBlue olRowlink col-md-12" style="overflow-x:auto;display:block;">
                                <table class="oltb-exc">
                                    <thead>
                                        <tr>
                                            <th>
                                            </th>
                                            <th style="min-width:120px;">ステータス</th>
                                            <th style="min-width:50px;">{!! ol_get_sort_link('id','ＩＤ') !!}</th>
                                            <th style="min-width:200px;">施策名</th><!-- 5 -->
                                            <th style="min-width:120px;">登録機関</th>
                                            <th style="min-width:120px;">更新日</th><!-- 10 -->
											<th style="min-width:120px;">掲載終了日</th>
                                            <th>Is show Asp</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values as $value)
                                            <tr data-link="{{ route('admin.employee.data.subsidy_edit',$value) }}">
                                                <td class="nolink"><input type="checkbox" name="posts[]" value="{{ $value->id }}" data-check="{{ $value->publication_setting }}"></td>
                                                <td>{{ $value->statusName() }}</td>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td><!-- 5 -->
                                                <td>{{ $value->companyName() }}</td>
                                                <td>{{ str_replace(['年','月','日','-'],['/','/','','/'],$value->update_date) }}</td><!-- 10 -->
                                                <td>{{ ol_get_date_string_step($value->subscript_duration_detail)}}</td>
                                                <td>{{ $value->is_new_asp ? $value->is_new_asp : '' }}</td>
                                                
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

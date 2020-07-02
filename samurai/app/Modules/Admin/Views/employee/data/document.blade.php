@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
    @include('Admin::partials.breadcrumb',['pagename'=>'顧客対応管理'])
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
                             <div class="blueheading"><span>アップロード書類管理</span></div>
                            <div class="ft-document">
                                <h4 class="tit_act">アップロード書類一覧</h4>
                                @php
                                    $request = request();
                                @endphp
                                {!! Form::open(['url'=>$request->url(),'method'=>'get','class'=>'searchPart']) !!}
                                        <div style="display: inline;" class="ng-binding">{{ $values->count() }}件表示 / {{ $values->total() }}件</div>
                                        <button type="reset" class="submit-blue-search" style="margin-left:10px;" id="search_reset">クリア</button>
                                        <button type="submit" class="submit-blue-search">検索</button>
                                        <input type="text" name="search" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false" value="{{ $request->query('search',null) }}">
                                {!! Form::close() !!}                                
                            </div>                                                       
                            {!! Form::open(['url'=>request()->url(),'method'=>'get']) !!}
                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
                                <table class="oltb-exc">
                                    <thead>
                                        <tr>
                                            <th>削除</th>
                                            <th>登録日</th>
                                            <th>施策名</th>
                                            <th style="width:100px;">登録機関</th>
                                            <th>士業名</th>
                                            <th>ファイル名</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values as $value)
                                            <tr>
                                                <td><a href="{{ route('admin.employee.data.destroy',$value) }}" onclick="return confirm('Do you want to delete user ?');">
                                                    <button type="button" class="submit-delete-button"></button>
                                                </a></td>
                                                <td>{{ ol_get_date_string($value->created_date) }}</td>
                                                <td>
                                                    @if($value->hire->policy)
                                                        {{ $value->hire->policy->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value->hire->policy->minitry)
                                                        {{ $value->hire->policy->minitry->province_name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value->user)
                                                        {{ $value->user->displayname ? $value->user->displayname : $value->user->username }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($value->file_name)
                                                    <a href="{{ $value->getFilePath() }}" download>{{ $value->file_name }}</a>
                                                    <br>
                                                    @endif
                                                    @foreach ($value->workSub as $element)
                                                        @if($element->file_name)
                                                        <a href="{{ $element->getFilePath() }}" download>{{ $element->file_name }}</a><br>
                                                        @endif
                                                    @endforeach
                                                </td>
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
<script>
(function($){
$(function(){
$('#search_reset').on('click',function(ev){
    ev.preventDefault();
    $(this).siblings('input[name="search"]:first').val('');
    return true;
})    
})    
})(jQuery)    
</script>
@endsection
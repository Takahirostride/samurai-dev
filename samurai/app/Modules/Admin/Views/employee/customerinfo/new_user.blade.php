@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('content')
<div class="customerinfo">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        @include('Admin::employee.customerinfo.sidebar')
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">                            
                            <div class="blueheading customer"><span>新規登録者一覧</span></div>
                            @include('Admin::employee/customerinfo/filter_new_user')
                            @include('Admin::employee/customerinfo/display_result')
                            {!! Form::open(['url'=>request()->url(),'method'=>'get']) !!}
                            <div class="section-5 sectionfull col-md-12" style="overflow-x:auto;display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>登録日</th>
                                            <th>ユーザーID</th>
                                            <th>登録者名</th>
                                            <th>都道府県</th>
                                            <th>登録区分</th>
                                            <th>本人確認書類</th>
                                            <th>ステータス</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values as $value)
                                            <tr>
                                                <td>{{ $value->CreatedAtName()}}</td>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->username }}</td>
                                                <td>{{ $value->userLocation ? $value->userLocation->provinceName():'' }}</td>
                                                <td>{{ $value->manageFlagName() }}</td>
                                                <td>
                                                    @if($value->person_files)
                                                        @php
                                                            $files = json_decode($value->person_files,true);
                                                        @endphp
                                                        @foreach ($files as $file)
                                                            @php
                                                                if(empty($file) || !is_array($file) || count($file)<2){
                                                                    continue;
                                                                }
                                                            @endphp
                                                            <p>
                                                                <a href="{{ ol_get_link_file($file[1]) }}" target="_blank">{{ $file[0] }}</a>
                                                            </p>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(!empty($value->person_id)&&$value->person_allow != 1)
                                                        <a href="{{ route('admin.StaffPolicyController.person_confirm') }}" class="btn btn-yellow olPersonConfirm" data-id="{{ $value->person_id }}" data-value="1">承認</a>
                                                    @endif    
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
$(function($){
    var app_token = $('meta[name="csrf-token"]').attr('content');
    $('.olPersonConfirm').on('click',function(ev){
        ev.preventDefault();
        var $ele = $(this);
        if($ele.hasClass('allow')){ return false;}
        var id = $ele.data('id');
        var value = $ele.data('value');
        if(!id || !value){ return false;}
        $('body').css({cursor:'wait'});
        var dt = {
            _token : app_token,
            id : id,
            value : value
        }
        $.ajax({
            url: $ele.attr('href'),
            type: 'POST',
            data: dt,
        })
        .done(function(res) {
            if(typeof res !== 'object'){ res = JSON.parse(res);}
            if(res.error){
                alert(res.message);
                return false;
            }
            $ele.attr({
                'class':"btn btn-gray allow"
            }).text('承認済');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            $('body').css({cursor:'default'});
        });
        
        return false;
    })    
});    
})(jQuery)    
</script>
@endsection
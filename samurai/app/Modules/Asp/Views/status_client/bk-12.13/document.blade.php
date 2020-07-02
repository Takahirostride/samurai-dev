@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('Asp::status_client.subsidy_nav')
        </div>  
        <div class="col-sm-12"> 
            <div class="lst-hire">
                @include('Asp::status_client.nav_category')
                @include('Asp::status_client.form_sort_document',['element'=>$recruitList])  
                {!! Form::open(['route'=>['asp_client_recruitment_download_preview',$client],'id'=>'fr-download','method'=>'get']) !!}                                     
                <table class="table table-bordered tb-post">
                    <thead>
                        <tr>
                            <th class="td-sl">
                                <span>一括チェック</span>
                                <input type="checkbox" class="cb-cir olCheckAll" data-name="hire_id[]">
                            </th>
                            <th>施策名</th>
                            <th>発行機関</th>
                            <th>支援規模</th>
                            <th>支援内容</th>
                            <th>お気に入り</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recruitList as $ite)
                            @include('Asp::status_client.content_subsidy_document',['hire'=>$ite,'policy_index'=>$loop->index])                                
                        @endforeach
                    </tbody>
                </table>
                {{ $recruitList->appends(request()->query())->links() }}
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-md">出力する</button>
                </div>
                {!! Form::close() !!}                
            </div> 
        </div>
    </div>
    <!-- end .row -->
</div>
@endsection
@push('script')
@include('Asp::layouts.partial_file.modal_sendmail_policy')
<script>
(function($){
$(function(){
 $('#fr-download').on('submit',function(ev){
    var $form = $(this);
    var $policy = $form.find('input[name="hire_id[]"]');
    var error = true;
    $policy.each(function(){
        var $ele = $(this);
        if($ele.is(':checked')){
            error = false;
            return true;
        }
    });
    if(error){
        ev.preventDefault();
        alert('Pleased, select policies!');
        return false;
    }
    return true;
 })    
})    
})(jQuery)    
</script>
@endpush
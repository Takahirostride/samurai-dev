@extends('Asp::layouts.asp')
@section('content')
<div class="container">    
    <div class="row">
        <div class="col-xs-12">   
            @include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'manage_client_invation'])         
            @include('Asp::manage_user.partials.form_invation')
        </div> <!-- end .list-pages -->                
    </div>
    <!-- end .row -->
    <div class="companies">
            @if($companies)
            @include('Asp::manage_user.partials.filter_invation_group',['results'=>$companies])
            <form id="cli-reg-form">
            <table class="table table-bordered table-list-user">
                <thead>
                    <tr>
                        <th>会社名</th>
                        <th>都道府県</th>
                        <th>市区町村</th>
                        <th>メールアドレス</th>
                        <th>招待メール送信日</th>
                        <th>登録日</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        @include('Asp::manage_user.content_company_invation',['element'=>$company])                                     
                    @endforeach
                </tbody>                
            </table>
            </form>
            {{ $companies->appends(request()->query())->links() }} 
            @endif   	
    </div>          	
</div>
@endsection
@push('script')
    @include('Asp::layouts.partial_file.modal_mail_register')
<script>
(function($){
$(function(){
    $(document).on('change', '.filter-member', function() {
        var full_url    = window.location.href;
        var member       = $(this).val();
        var url         = '';
        if (GetURLParameter('member') == null) {
            if (full_url.indexOf('?') > -1) {
                url = full_url+'&member='+member
            } else {
                url = full_url+'?member='+member
            } 
        } else {
            url  =  full_url.replace(GetURLParameter('member')[0]+'='+GetURLParameter('member')[1], GetURLParameter('member')[0]+'='+member)
        }
        window.location.href = url;
    });    
})    
})(jQuery)    
</script>    
@endpush
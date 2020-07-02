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
            @include('Asp::layouts.partial_file.form_filter_sort',['results'=>$companies])
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
    </div>          	
</div>
@endsection
@push('script')
    @include('Asp::layouts.partial_file.modal_mail_register')
@endpush
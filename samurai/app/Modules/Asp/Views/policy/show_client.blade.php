@extends('Asp::layouts.asp')
@section('content')
<div class="container">
@include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'show_client'])    
</div>

<div class="wr-policy">
    <div class="wr-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered subsidy-sum tb-post">
                        <thead>
                            <tr>
                                <th>施策名</th>
                                <th>発行機関</th>
                                <th>支援規模</th>
                                <th>支援内容</th>
                            </tr>
                        </thead>
                        <tbody>
                                @include('Asp::policy.content_subsidy_active',['val'=>$policy,'val_index'=>1])
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>        
    </div>
    <div class="wr-clients">
        <div class="container">
            @include('Asp::layouts.partial_file.form_filter_sort',['results'=>$clients])
            <form id="cli-reg-form">
            <table class="table table-bordered table-list-user tbrow-link">
                <thead>
                    <tr>
                        <th>会社名</th>
                        <th>都道府県</th>
                        <th>市区町村</th>
                        <th>最終ログイン日</th>
                        <th>
                            <div class="text-icon">情報登録日
                                @include('Asp::layouts.icons.tooltip_register')
                            </div>                            
                        </th>
                        <th>
                            <div class="text-icon">SAMURAI<br>会員登録日
                            @include('Asp::layouts.icons.tooltip_sendmail')    
                            </div>
                            <button type="button" class="btn btn-default btn-sendmail btn-lab" id="checkall">
                                <span>一括招待メールを送る</span>
                            </button>
                        </th>
                        <th>メールアドレス</th>
                        <th>提案可能案件</th>
                        <th>進行中の案件</th>
                        <th>担当登録</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $ite)
                    @include('Asp::layouts.partial_file.client_common',['client'=>$ite])                  
                    @endforeach
                </tbody>                
            </table>
            </form>
            {{ $clients->appends(request()->query())->links() }}            
        </div>
        
    </div>
</div>
@endsection
@push('script')
@include('Asp::layouts.partial_file.modal_mail_register')
@endpush
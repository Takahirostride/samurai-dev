@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    @include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'search_client'])
    <div class="row">
        <div class="col-xs-12">
            @include('Asp::search.form_client')
            @include('Asp::layouts.partial_file.form_filter_sort',['results'=>$clients])
            <form id="cli-reg-form">
            <table class="table table-bordered table-list-user">
                <thead>
                    <tr>
                        <th>会社名</th>
                        <th>都道府県</th>
                        <th>市区町村</th>
                        <th>電話番号</th>
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
        </div> <!-- end .list-pages -->                
    </div>
    <!-- end .row -->          	
</div>
@endsection
@push('script')
@include('Asp::layouts.partial_file.modal_sendmail')
@endpush
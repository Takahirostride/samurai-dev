@extends('Asp::layouts.asp')
@section('content')
@php
    $request = request();
@endphp
<div class="container">
    <div class="row">
        <div class="col-xs-12">
         	@include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'manage_client_csv']) 
            <p><a href="{{ route('asp_manage_clients_csv') }}" class="btn btn-csv">CSVインポート</a></p>
            @if(!$request->filled('filename'))
         	@include('Asp::manage_user.form_csv')
            @else
         	@if($companies)
         		<div class="companies">
                    {!! Form::open(['route'=>['asp_manage_clients_csv_register'],'id'=>'fr-csv-register']) !!}
         			<div class="tb-contain tb-sort">
                        <div class="tb-item">
                            <p>インポート結果：{{ count($companies) }}件</p>
                        </div>         				
         			</div>
         			<table class="table table-bordered table-list-user">
         				<thead>
         					<tr>
         						<th>会社名</th>
         						<th>住所（都道府県）</th>
         						<th>住所（市区町村）</th>
         						<th>町名・番地</th>
         						<th>マンション名・ビル名</th>
         						<th>業種</th>
         						<th>設立年月</th>
                                <th>資本金</th>
                                <th>従業員数</th>
         						<th>メールアドレス</th>
         					</tr>
         				</thead>
         				<tbody>
         					@foreach ($companies as $company)
                                @php
                                    if(!is_array($company)){
                                        continue;
                                    }
                                @endphp
         						@include('Asp::manage_user.content_company_csv',['element'=>$company])
         					@endforeach
         				</tbody>
         			</table>
                    <div class="text-center mt30">
                        <input type="hidden" name="csv_path" value="{{ $csv_path }}">
                        <a data-toggle="modal" href='#modal-csv-register' class="btn btn-green">顧客登録</a>
                    </div>
                    {!! Form::close() !!}
         		</div>
         	@endif
            @endif
        </div>
    </div>
</div>
@endsection
@push('script')
@include('Asp::manage_user.modal.modal_csv_register')
@include('Asp::manage_user.modal.modal_csv_complete')
<script>
(function($){
$(function(){
    $('input[name="company"]').on('change',function(ev){
        var $ele = $(this);
        var ele_val = $ele[0].files[0];
        if(ele_val){
            $ele.siblings('.name').text(ele_val.name);
        }
        
    });
    $('#submit-register').on('click',function(ev){
        ev.preventDefault();
        $('#fr-csv-register').trigger('submit');
        return true;
    })
})    
})(jQuery)    
</script>
@endpush            
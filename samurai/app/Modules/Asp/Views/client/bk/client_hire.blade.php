@extends('Asp::layouts.asp')
@section('content')
<div class="container">
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-12 subsidydetail">
                @include('Asp::client.content_subsidy_detail')

            </div>         
        </div> <!-- end .row -->
        <div class="text-center">
        	<a href="{{ route('asp_client_recruitment_download_preview',['id'=>$client->id,'hire_id[]'=>$hire->id]) }}" class="btn btn-orange" >資料を作成する</a>
        </div>                 
    </div> <!-- end .col-xs-12 -->
</div> 
<!-- end .row -->

</div>
@endsection	
@push('script')
@include('Asp::layouts.partial_file.modal_sendmail_policy')
@endpush
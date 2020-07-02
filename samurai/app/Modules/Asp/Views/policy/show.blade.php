@extends('Asp::layouts.asp')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/asp/css/subsidy-print.css') }}">
@endpush
@section('content')
<div class="wr-policy">
        <div class="container" id="preview-page">
            <div class="wr-prev all" id="print-content">
                <div class="prev_ct">
                    <div class="subsidydetail">
                    @include('Asp::client.content_subsidy_detail')
                    </div>                    
                </div>
                <div class="prev_footer text-right view-print">
                    @php
                        $user = auth('asp_user')->user();
                        $signature = $user->signature;
                    @endphp
                    @if($signature)
                        <div class="signature txt-12">
                            <p>{{ $signature->company }}</p>
                            <p><span>{{ $signature->position }}</span><span class="pl15">{{ $signature->name }}</span></p>
                            <p>{{ $signature->address_1 }}</p>
                            <p>{{ $signature->address_2 }}</p>
                            <p>
                                @if($signature->tel)
                                <span>TEL:{{ $signature->tel }}</span>
                                @endif
                                @if($signature->fax)
                                <span class="pl15">FAX:{{ $signature->fax }}</span>
                                @endif                          
                            </p>
                            @if($signature->email)
                            <p>MAIL:{{ $signature->email }}</p>
                            @endif
                        </div>
                    @endif
                </div>                               
            </div>
            <div class="prev_footer text-center no-print">
                <div class="text-center prev_submit">
                    <button type="button" class="btn btn-white" onClick="window.history.back();">戻る</button>
                    <button type="submit" class="btn btn-orange" id="btn-print">印刷する</button>
                </div>
            </div>               
        </div>        
</div>
@endsection
@push('script')
<script>
(function($){
    $(function(){
        $('#btn-print').on('click',function(ev){
            ev.preventDefault();
            window.print();         
            return true;
        });
    })  
})(jQuery)
</script>
@endpush
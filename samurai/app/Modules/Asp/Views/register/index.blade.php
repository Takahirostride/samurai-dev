@extends('Asp::layouts.asp')
@section('content')
@include('Asp::layouts.asp_partials.submenu')
<div class="container">
    <div class="row">
        <div class="col-xs-2">
            @include('Asp::layouts.asp_partials.sidebar')
        </div> <!-- end .col-sm-2 -->
        <div class="col-xs-10">
            <p class="list-heading">samurai登録企業一覧</p>
            <p class="list-pages">{{ $user_clients->total() }}件　（{{ $user_clients->firstItem() }}件～{{ $user_clients->lastItem() }}件表示）</p> 
            {!! Form::open(['id'=>'cli-reg-form']) !!}
            <div class="list-checkall">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="" id="checkall">
                        すべて選択
                    </label>
                    <button type="submit" class="btn btn-primary" data-toggle="modal">送信</button>
                </div>

            </div>                       
            <div class="list-rows smr">                
                <div class="row">
                    @foreach ($user_clients as $cli)
                        @php
                            if(!$cli->users){continue;}
                        @endphp
                        @include('Asp::layouts.asp_partials.content_client_register',['element'=>$cli->users])
                    @endforeach
                </div> <!-- end .row -->                
            </div> <!-- end .list-rows -->
            {!! Form::close() !!}
            {{ $user_clients->appends(request()->query())->links() }}
        </div> <!-- end .list-pages -->
        
        
    </div>
    <!-- end .row -->
          	
</div>
@endsection
@push('script')
@include('Asp::layouts.asp_partials.modal_sendmail')
@endpush
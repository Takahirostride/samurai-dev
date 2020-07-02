@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('Asp::status_client.subsidy_nav')
            @include('Asp::status_client.tab_status')
        </div>  
        @if($recruitList)
        <div class="col-sm-12"> 
            <div class="hires">
                @foreach ($recruitList as $ite)
                    @php
                        $policy = $ite->policy;
                    @endphp
                    <div class="ite_hire">
                        <div class="hire-hd">
                            <span class="btn btn-acc"></span>
                        </div>
                        <div class="hire-ct" id="ite_hire-{{ $loop->index }}">
                            @include('Asp::status_client.content_subsidy_summary',['policy'=>$policy])
                        </div>
                    </div>                        
                @endforeach
                {{ $recruitList->appends(request()->query())->links() }}                
            </div>               
        </div>
        @endif
    </div>
    <!-- end .row -->
</div>
@endsection
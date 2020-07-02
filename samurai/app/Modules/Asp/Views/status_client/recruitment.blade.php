@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'status_client_recuitment'])
            @include('Asp::status_client.subsidy_nav')
            @include('Asp::status_client.tab_status')
        </div> 
        @if($recruitList) 
        <div class="col-sm-12"> 
            <div class="hires" id="lst-hires">
                @foreach ($recruitList as $ite)
                    @php
                        $policy = $ite->policy;
                    @endphp
                    <div class="ite_hire olCollap  {{ $loop->index==0 ? 'active':'' }}">
                        <div class="hire-hd">
                            <span class="btn btn-acc bt-collap"></span>
                        </div>
                        <div class="hire-ct" id="ite_hire-{{ $loop->index }}">
                            @include('Asp::status_client.content_subsidy_summary',['policy'=>$policy])
                            <div class="box_work bl-collap">
                                <h3 class="hd-yellow">タスク進歩状況</h3>
                                    @php
                                        $work_sets = $ite->workSet;
                                    @endphp
                                    @if($work_sets)
                                    <ul class="tallList">
                                        <li>
                                            <div class="avatar"></div>
                                            <p class="name">対応者</p>
                                            <p class="title">作業内容</p>
                                            <p class="date">提出期限</p>
                                        </li>
                                        @foreach ($work_sets as $w_ite)

                                        <li>
                                            @include('Asp::status_client.content_workset',['element'=>$w_ite])
                                        </li>
                                        @endforeach

                                    </ul>
                                    @endif                                
                            </div>
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
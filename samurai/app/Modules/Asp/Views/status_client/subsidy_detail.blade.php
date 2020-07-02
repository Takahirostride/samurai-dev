@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @php
                $client = $hire->getClient();
            @endphp
            @if($client)
            @include('Asp::status_client.subsidy_nav',compact('client'))
            @endif
        </div>  
        <div class="col-sm-12">
            <p>
                <a href="#" onClick="window.history.back()">進んでいる案件</a>
            </p>
            <div class="detail-hire">
                <div class="djob-info">
                    <p>見積依頼</p>
                    <span class="tog-but tog-md" data-block="#policy-sum"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="create-link-box-x" id="policy-sum">
                    @if($hire->policy)
                    @include('Asp::search.content_subsidy_detail',['policy'=>$hire->policy])
                    @endif
                </div>
                <!-- end .dpolicy-item-list -->
                <h4>仕業から来た提案</h4>
                @include('Asp::status_client.content_hire')
            </div>
            <div class="text-center">                
                <div class="listtask-asp">
                    <h3 class="tit-bor">進歩状況</h3>
                    @if(!$hire->workSet->isEmpty())
                        @php
                            $work_sets = $hire->workSet;
                        @endphp
                        <ul class="tallList">
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
    </div>
    <!-- end .row -->
</div>
@endsection
@section('script')
    <script>
        $(document).on('click', '.dropdown-icon', function() {
            var id=$(this).attr('data-id');
            // $('.hide_item').hide();
            $('#'+id).slideToggle();
            $(this).toggleClass('active');
        });
    </script>
@endsection
@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('Asp::status_client.subsidy_nav')
        </div>  
        <div class="col-sm-12">
            <div class="news status">
                <div class="news-header">
                    <h3>顧客のお気に入り案件</h3>
                    <span class="tog-but tog-md" data-block="#status-01"><i class="fas fa-chevron-down"></i></span>
                </div>    
                <div class="news-ct bl-toggle active" id="status-01">
                    <ul class="lst-status">
                        @foreach ($fav_clients as $fav)
                            @php
                                $policy = $fav->policy;
                            @endphp                                
                        <li>
                            <a href="{{ route('asp_policy_show',['id'=>$policy->id]) }}">
                                <span>登録＞</span>
                                <span>「{{ $policy->name }}」</span>
                                <span>をお気に入り登録しました。</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>                    
                </div>
            </div>
            <div class="news status">
                <div class="news-header">
                    <h3>顧客の申請中案件</h3>
                    <span class="tog-but tog-md" data-block="#status-02"><i class="fas fa-chevron-down"></i></span>
                </div>    
                <div class="news-ct bl-toggle active" id="status-02">
                    <table class="table table-bordered " id="show_2">
                        <tbody>
                            <tr>
                                <td style="width: 200px;">案件名</td>
                                <td style="width: 120px">交付金額</td>
                                <td>ステータス</td>
                            </tr>
                            @foreach ($recruitList as $ite)
                                @php
                                    $policy = $ite->policy;
                                    $client = $ite->getClient();
                                    if(!$client){continue;}
                                @endphp
                            <tr>
                                <td><a href="{{ route('asp_status_client_subsidy_detail',['id'=>$ite->id]) }}">{{ $policy->name }}</a></td>
                                <td>{{ $policy->acquire_budget_text() }}</td>
                                <td>
                                    @php
                                        $work_sets = $ite->workSet;
                                    @endphp
                                    @if($work_sets)
                                    <ul class="tallList">
                                        @foreach ($work_sets as $w_ite)

                                        <li>
                                            @include('Asp::status_client.content_workset',['element'=>$w_ite])
                                        </li>
                                        @endforeach

                                    </ul>
                                    @endif
                                </td>
                            </tr>                        
                            @endforeach

                        </tbody>
                    </table>                    
                </div>
            </div>        
        </div>
    </div>
    <!-- end .row -->
</div>
@endsection
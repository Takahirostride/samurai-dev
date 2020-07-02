@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    @include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'asp_home'])
    @include('Asp::home.nav_home')
    <section id="news-top">
        <div class="news">
            <div class="news-header">
                <h2 class="tit-set">顧客の更新ステータスを確認する</h2>
            </div>
            <div class="news-ct bl-toggle active" id="news-01">
                <ul class="lst-status">
                    <li>
                        <span class="stt-date">配信日時</span>
                        <span class="stt-ct">ステータス詳細</span>
                    </li>
                    @foreach ($work_sets as $ite)
                        @php
                            $company = $ite->aspCompany;
                            $hire = $ite->hire;
                            $policy = $hire->policy;
                            if(!$policy){
                                continue;
                            }
                        @endphp
                        <li>
                            <span class="stt-date">{{ $ite->updated_at->format('Y/m/d H:i') }}</span>
                            <span class="stt-ct">
                              <a href="{{ route('asp_status_client_recruitment',['id'=>$company->id]) }}">
                                {!! $ite->getStatusName() !!}
                                </a>                                
                            </span>  
                        </li>
                    @endforeach                                
                </ul>
                <p class="readmore text-center"><a href="{{ route('asp_task_client') }}" class="btn btn-success">一覧を見る</a></p>            
            </div>
        </div>
        <div class="news">
            <div class="news-header">
                <h2 class="tit-set">新規登録顧客に提案できる案件</h2>
            </div>
            <div class="news-ct bl-toggle active" id="news-02">
                <ul class="lst-status">
                    <li>
                        <span class="stt-date">配信日時</span>
                        <span class="stt-ct">ステータス詳細</span>
                    </li>                    
                    @foreach ($client_reg as $client)                              
                        <li>
                            <span class="stt-date">{{ $client->updated_at ? $client->updated_at->format('Y/m/d H:i') :'' }}</span>
                            <span class="stt-ct">
                                <a href="{{ route('asp_status_client_document',$client) }}">
                                <span>「{{ $client->name }}」</span>        
                                <span>が新規で登録されました。提案可能な案件が<span>{{ $client->countRecommend() }}</span>件あります。</span>
                                </a>                                
                            </span>
                        </li>
                    @endforeach                                    
                </ul> 
                <p class="readmore text-center"><a href="{{ route('asp_new_client') }}" class="btn btn-success">一覧を見る</a></p>            
            </div>
        </div>    
        <div class="news">
            <div class="news-header">
                <h2 class="tit-set">新着案件</h2>
            </div>
            <div class="news-ct bl-toggle active" id="news-03">
                <ul class="lst-status">
                    <li>
                        <span class="stt-date">配信日時</span>
                        <span class="stt-ct">ステータス詳細</span>
                    </li>                     
                    @foreach ($new_policies as $policy)                               
                        <li>
                            <span class="stt-date">{{ $policy->updateDateName() }}</span>
                            <span class="stt-ct">
                                <a href="{{ route('asp_policy_clients',[
                                        'id'=>$policy->id]) }}">
                                <span>「{{ $policy->name }}」</span>
                                <span>が登録されました。<span>{{ $policy->clientRecommend() }}</span>社に提案できます。</span>
                                </a>                                
                            </span>
                        </li>
                    @endforeach                                    
                </ul> 
                <p class="readmore text-center"><a href="{{ route('asp_new_subsidy') }}" class="btn btn-success">一覧を見る</a></p>           
            </div>
        </div>    
        <div class="news">
            <div class="news-header">
                <h2 class="tit-set">締め切り間近な案件</h2>
            </div>
            <div class="news-ct bl-toggle active" id="news-04">
                <ul class="lst-status">
                    <li>
                        <span class="stt-date">配信日時</span>
                        <span class="stt-ct">ステータス詳細</span>
                    </li>                     
                    @foreach ($policies as $policy)                               
                        <li>
                            <span class="stt-date">
                                {{ $policy->subscript_duration_detail }}
                            </span>
                            <span class="stt-ct">
                                <a href="{{ route('asp_policy_clients',[
                                        'id'=>$policy->id]) }}">
                                <span>「{{ $policy->name }}」</span>
                                <span>が締め切り間近です。<span>{{ $policy->clientRecommend() }}</span>社が申請可能です。</span>
                                </a>                                
                            </span>

                        </li> 
                    @endforeach                                   
                </ul> 
                <p class="readmore text-center"><a href="{{ route('asp_expire_subsidy') }}" class="btn btn-success">一覧を見る</a></p>            
            </div>
        </div>        
    </section>
    

</div>
@endsection
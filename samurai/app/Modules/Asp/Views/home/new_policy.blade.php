@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <section id="news-top">
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
            </div>
            {{ $new_policies->appends(request()->query())->links() }} 
        </div>
    </section>
@endsection        
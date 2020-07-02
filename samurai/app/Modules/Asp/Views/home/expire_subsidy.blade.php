@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <section id="news-top">
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
                            <span class="stt-date">{{ $policy->subscript_duration_detail }}</span>
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
            </div>
            {{ $policies->appends(request()->query())->links() }}
        </div>         
    </section>
@endsection        
@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <section id="news-top">
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
                            <span class="stt-date">{{ $client->updated_at->format('Y/m/d H:i') }}</span>
                            <span class="stt-ct">
                                <a href="{{ route('asp_status_client_document',$client) }}">
                                <span>「{{ $client->name }}」</span>        
                                <span>が新規で登録されました。提案可能な案件が<span>{{ $client->countRecommend() }}</span>件あります。</span>
                                </a>                                
                            </span>
                        </li>
                    @endforeach                                     
                </ul> 
            </div>
            {{ $client_reg->appends(request()->query())->links() }}
        </div>        
    </section>
@endsection        
@extends('Asp::layouts.asp')
@section('content')
<div class="container">
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
                            $client = $ite->aspCompany;
                            $hire = $ite->hire;
                            $policy = $hire->policy;
                            if(!$policy){
                                continue;
                            }
                        @endphp
                        <li>
                            <span class="stt-date">{{ $ite->updated_at->format('Y/m/d H:i') }}</span>
                            <span class="stt-ct">
                                <a href="{{ route('asp_status_client_recruitment',['id'=>$client->id]) }}">
                                {!! $ite->getStatusName() !!}
                                </a>                                
                            </span>                            
                        </li>
                    @endforeach                                
                </ul>
            </div>
            {{ $work_sets->appends(request()->query())->links() }} 
        </div>
    </section>
@endsection        
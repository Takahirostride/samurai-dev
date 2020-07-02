@extends('Asp::layouts.asp')
@section('content')
<div class="container">       
    @include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'manage_client_hire_history'])
    @include('Asp::manage_user.partials.filter_hire_history',['results'=>$p_logs])
    <table class="table table-bordered table-hover tb-col3 tbrow-link">
        <thead>
            <tr>
                <th>作成日</th>
                <th>施策名</th>
                <th>印刷</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($p_logs as $p_log)
                @php
                    $policy = $p_log->policy;
                    $asp_log = $p_log->aspClientLog;
                @endphp
                <tr class="row-link" data-link="{{ route('asp_client_policy_preview',['id'=>$asp_log->user_id,'policy_id'=>$policy->id]) }}">
                    <td>{{ $p_log->created_at->format('Y/m/d') }}</td>
                    <td>
                        {{ $policy->name }}
                    </td>
                    <td class="noLink">
                        <a href="{{ route('asp_client_recruitment_download_preview',['id'=>$asp_log->user_id,'ids[]'=>$policy->id]) }}" class="btn btn-primary">再出力する</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>  
    {{ $p_logs->appends(request()->query())->links() }}  
</div>
@endsection
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
                    <div class="ite_hire">
                        <div class="hire-hd">
                            <span class="btn btn-acc"></span>
                        </div>
                        <div class="hire-ct" id="ite_hire-{{ $loop->index }}">
                            <table class="table table-bordered tb-job">
                                  <tbody>
                                      <tr>
                                          <th class="td-name">タイトル</th>
                                          <td class="text-center">{{ $ite->job_title }}</td>
                                      </tr>
                                      <tr>
                                          <th class="td-name">依頼詳細</th>
                                          <td class="text-center">{{ $ite->job_content }}</td>
                                      </tr>

                                  </tbody>
                            </table> 
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
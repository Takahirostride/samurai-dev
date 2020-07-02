@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    @include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'search_subsidy'])
    <div class="row">
        <div class="col-sm-12">
            <div class="row subsidy-list">
                <div class="col-sm-12">
                    @include('Asp::search.form_subsidy')
                </div> <!-- end .div.col-sm-12 -->
            </div> <!-- end .row -->
        </div> <!-- end .mainpage --> 
         @if(!empty($results))
        <div class="col-sm-12">            
            @include('Asp::layouts.partial_file.form_sort_subsidy',['element'=>$results])
            <table class="table table-bordered tb-post tbrow-link">
                <thead>
                    <tr>
                        <th>施策名</th>
                        <th>発行機関</th>
                        <th>支援規模</th>
                        <th>支援内容</th>
                        <th>お気に入り</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $item)
                        @include('Asp::search.content_subsidy',['val'=>$item,'val_index'=>$loop->index])
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">              
                {{ $results->appends(request()->query())->links() }}
            </div>            
        </div>
        @endif
    </div>
    <!-- end .row -->
</div>
@endsection
@push('script')
    @include('Asp::search.form_script')
@endpush
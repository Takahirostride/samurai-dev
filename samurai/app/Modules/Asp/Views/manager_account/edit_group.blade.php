@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <p class="bg-danger heading-text">グループ</p>
        @if($group->type==1)
            @include('Asp::manager_account.partials.group_view')
        @else
            @include('Asp::manager_account.partials.group_edit')
        @endif   
        <div class="wrap">
                <div class="tit-bot">
                    <h3 class="bl-inl">グループ参加者</h3>
                    <a href="{{ route('asp_manager_account_create',['group_id'=>$group->id]) }}" class="btn-add"><i class="fa fa-plus"></i><span>メンバーを追加</span></a>
                </div>                
                <div class="row">                    
                    @foreach ($members as $element)
                    <div class="col-sm-2">
                        @include('Asp::manager_account.partials.content_user',['user'=>$element])
                    </div>
                    @endforeach

                </div> <!-- end .row -->
                @php
                    $request = request();
                @endphp                
                {!! $members->appends($request->query())->links() !!}
        </div>            
    <!-- end form -->
</div>
@endsection
@push('script')
    @include('Asp::layouts.modal.modal_notify')
    @include('Asp::manager_account.modal.modal_group_delete')
    <script src="{{ asset('assets/asp/js/asp-group.js') }}"></script>
@endpush
@extends('Asp::layouts.asp')
@section('content')
<div class="container">    
    <!-- end .row -->
    <div class="row" id="olGroupAdd">
        <div class="col-sm-12">
            <p class="bg-danger heading-text">アカウント管理</p>
            <p class="des">
                SAMURAIの泉にログインする、スタッフと所属するグループの追加が可能です。
            </p>
            <div class="lst-group">
            @foreach ($groups as $gr)
            	<h4 class="left-border" data-id="{{ $gr->id }}">
                    <a href="{{ route('asp_manager_account_group_edit',$gr) }}" class="ol-name">{{ $gr->title }}</a>
                </h4>
                @php
                    $user_id = auth('asp_user')->user()->id;
                @endphp
            	<div class="row accounts">
                    @php
                        $members = $gr->member()->orderBy('pivot_role','desc')->take(6)->get();  
                    @endphp                  
            		@foreach ($members as $element)
            			<div class="col-sm-2 col-xs-4">
                        @include('Asp::manager_account.partials.content_user',['user'=>$element])
	            		</div>
            		@endforeach
                    <div class="actions">
                      <a href="{{ route('asp_manager_account_create',['group_id'=>$gr->id]) }}" class="btn-add">
                        <i class="fa fa-plus"></i><span>追加する</span>
                        </a> 
                        @if($gr->type==0)
                        <a href="{{ route('asp_manager_account_group_destroy',$gr) }}" class="btn btn-red olDelGroup"  data-title="{{ $gr->title }}">グループ削除</a>                                                    
                        @endif             
                    </div>
            	</div>	
            @endforeach
            </div>
            {!! $groups->appends(request()->query())->links() !!}
        </div>
        <!-- end .col-sm-8 -->
        <div class="col-sm-12 text-center mt50">
                <a class="btn-add" id="olGroupAddBtn" href="#">
                  <i class="fa fa-plus"></i><span>グループを追加する</span>
                </a>
        </div>
        <!-- end .col-sm-3 -->
    </div>

    <!-- end .row -->
</div>
@endsection
@push('script')
    @include('Asp::manager_account.modal.modal_group_add')
    @include('Asp::manager_account.modal.modal_group_delete')
    @include('Asp::layouts.modal.modal_notify')
    <script src="{{ asset('assets/asp/js/asp-group.js') }}"></script>
@endpush
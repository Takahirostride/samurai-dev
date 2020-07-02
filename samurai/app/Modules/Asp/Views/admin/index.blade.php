@extends('Asp::layouts.asp_admin')
@section('title_page')
管理者ページ
@endsection
@section('content')
<div class="container">
<div class="row">
    <div class="col-sm-12">
        <div>
            <a href="{{ url('asp') }}" class="btn-link"><i class="fa fa-redo-alt fa-3 mgr-15" aria-hidden="true"></i>samuraiページ</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- end .col-sm-12 -->
    <div class="col-sm-12">
        <ul class="masteslist nolisttt text-center">
            <li>
                <div class="boxlink">
                    <p class="mgbt-30">
                        <img src="{{asset('assets/common/images/fa-copy.png')}}" alt="">
                    </p>
                    <p>
                       契約者ページ 
                    </p>
                    <a href="{{route('asp_admin_contract')}}"></a>
                </div> 
                <!-- end .boxlink -->
            </li>
            @if(auth('asp_user')->user()->can('create',App\Modules\Asp\Models\AspUser::class))
            <li>
                <div class="boxlink">
                    <p class="mgbt-30">
                        <img src="{{asset('assets/common/images/fa-avatar.png')}}" alt="">
                    </p>
                    <p>
                       アカウント 
                    </p>
                    <a href="{{ route('asp.users.index') }}"></a>
                </div>
                <!-- end .boxlink -->
            </li>
            @endif
            <li>
                <div class="boxlink">
                    <p class="mgbt-30">
                        <img src="{{asset('assets/common/images/fa-folder.png')}}" alt="">
                    </p>
                    <p>
                       グループ管理 
                    </p>
                    <a href="{{ route('asp.groups.index') }}"></a>
                </div>
                <!-- end .boxlink -->
            </li>
            <li>
                <div class="boxlink">
                    <p class="mgbt-30">
                        <img src="{{asset('assets/common/images/fa-edit.png')}}" alt="">
                    </p>
                    <p>
                       データ管理 
                    </p>
                    <a href="{{route('asp_admin_data')}}"></a>
                </div>
                <!-- end .boxlink -->
            </li>
            <li>
                <div class="boxlink">
                    <p class="mgbt-30">
                        <img src="{{asset('assets/common/images/fa-info.png')}}" alt="">
                    </p>
                    <p>
                       利用履歴 
                    </p>
                    <a href="{{route('asp_admin_history')}}"></a>
                </div>
                <!-- end .boxlink -->
            </li>
        </ul>
        <!-- end .masteslist -->
    </div>
    <!-- end .col-sm-12 -->
</div>
<!-- end .row -->
	
</div>
@endsection
<div class="text-center mypage-left-sidebar">
    <div class="div-style-blue">
        <div  class="imagecenter">
            {{HTML::image($profile_image, '', ['class'=>'img-thumbnail'])}}
        </div>
        <h3 class="ng-binding"><b>{{$user->user_name()}}</b></h3>
    </div>
    <p><a href="{{URL::route('agency.home')}}" class="btn btn-default sidebar-btn btn-grad @if(Route::currentRouteName()=='agency.home')active @endif">
            <strong><i class="fa fa-user"></i> マイページトップ</strong>
        </a></p>
    <p><a href="{{URL::route('agency.profile')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(), ['agency.profile', 'agency.profile.availabletask', 'agency.profile.availablesubsidy', 'agency.profile.rating', 'agency.profile.cost'] ) )active @endif">
            <strong><i class="fa fa-id-card"></i> プロフィール管理</strong>
        </a></p>
    <p><a href="{{URL::route('agency.memberinfo')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(), ['agency.memberinfo', 'agency.memberinfo.mail', 'agency.memberinfo.block', 'agency.memberinfo.regmem'] ) )active @endif">
            <strong><i class="fa fa-cog"></i> 会員情報管理</strong>
        </a></p>
    <p><a href="{{URL::route('agency.recruitment')}}" class="btn btn-default btn-grad sidebar-btn @if(request()->segment(2) == 'recruitment') active @endif">
            <strong><i class="fa fa-tasks"></i> 仕事管理</strong>
        </a></p>
    <p><a href="{{URL::route('agency.checklist')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(), ['agency.checklist', 'agency.followlist.interest', 'agency.followlist.hide', 'agency.followlist.follow', 'agency.followlist.followers'] ) )active @endif">
            <strong><i class="fa fa-star-o"></i> お気に入り</strong>
        </a></p>
    <p><a href="{{URL::route('agency.authentication')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName() , ['agency.authentication','agency.authentication.confidentiality_confirmation','agency.authentication.secretariat_confirmation','agency.authentication.call_confirmation']) )active @endif">
            <strong><i class="fa fa-check-square-o"></i> 各種認証管理</strong>
        </a></p>
    <p><a href="{{URL::route('agency.payment')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(),['agency.payment','agency.payment.support_management', 'agency.payment.withdrawal']))active @endif">
            <strong><i class="fa fa-money"></i> 支払い管理</strong>
        </a></p>
    <p><a href="{{URL::route('agency.affiliate')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(),['agency.affiliate','agency.affiliate.result','agency.affiliate.register']))active @endif">
            <strong><i class="fa fa-group"></i> アフィリエイト管理</strong>
        </a></p>
</div>
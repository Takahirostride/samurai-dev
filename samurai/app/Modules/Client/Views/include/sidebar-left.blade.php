<div class="text-center mypage-left-sidebar">
    <div class="div-style-blue">
        <div  class="imagecenter">
            {{HTML::image($profile_image, '', ['class'=>'img-thumbnail'])}}
        </div>
        <h3 class="ng-binding"><b>{{$user->user_name()}}</b></h3>
    </div>
    <p><a href="{{URL::route('client.home')}}" class="btn btn-default sidebar-btn btn-grad @if(Route::currentRouteName()=='client.home')active @endif">
            <strong><i class="fa fa-user"></i> マイページトップ</strong>
        </a></p>
    <p><a href="{{URL::route('client.profile')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(), ['client.profile', 'client.profile.availabletask', 'client.profile.availablesubsidy', 'client.profile.rating', 'client.profile.cost'] ) )active @endif">
            <strong><i class="fa fa-id-card"></i> プロフィール管理</strong>
        </a></p>
    <p><a href="{{URL::route('client.memberinfo')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(), ['client.memberinfo', 'client.memberinfo.mail', 'client.memberinfo.block', 'client.memberinfo.regmem'] ) )active @endif">
            <strong><i class="fa fa-cog"></i> 会員情報管理</strong>
        </a></p>
    <p><a href="{{URL::route('client.recruitment')}}" class="btn btn-default btn-grad sidebar-btn @if(request()->segment(2) == 'recruitment') active @endif">
            <strong><i class="fa fa-tasks"></i> 仕事管理</strong>
        </a></p>
    <p><a href="{{URL::route('client.checklist')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(), ['client.checklist', 'client.followlist.interest', 'client.followlist.hide', 'client.followlist.follow', 'client.followlist.followers'] ) )active @endif">
            <strong><i class="fa fa-star-o"></i> お気に入り</strong>
        </a></p>
    <p><a href="{{URL::route('client.authentication')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName() , ['client.authentication','client.authentication.confidentiality_confirmation','client.authentication.secretariat_confirmation','client.authentication.call_confirmation']) )active @endif">
            <strong><i class="fa fa-check-square-o"></i> 各種認証管理</strong>
        </a></p>
    <p><a href="{{URL::route('client.payment')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(),['client.payment','client.payment.support_management', 'client.payment.withdrawal']))active @endif">
            <strong><i class="fa fa-money"></i> 支払い管理</strong>
        </a></p>
    <p><a href="{{URL::route('client.affiliate')}}" class="btn btn-default btn-grad sidebar-btn @if(in_array(Route::currentRouteName(),['client.affiliate','client.affiliate.result','client.affiliate.register']))active @endif">
            <strong><i class="fa fa-group"></i> アフィリエイト管理</strong>
        </a></p>
</div>
<div class="profile-av">
	<div class="row">
		<div class="col-sm-4">
			{{HTML::image($profile_image, '', ['class'=>'profile-user-avatar av-avatar'])}}
		</div>
		<div class="col-sm-8">
			<h4 class="main-user-name">{{$user->displayname}} ({{$user->username}})</h4>
			<p class="main-user-id">ユーザーID：{{$user->id}}</p>
			<p class="main-user-total-job">実績：　{{$user->result}}件</p>
			{!! Button::getRatingStar('profile-1', $user->evaluate) !!}
		</div>
	</div>
	<div class="row">
		<label for="" class="col-sm-2" style="margin-top: 7px;">プロフィール画像</label>
		<div class="col-sm-6">
			{{Form::open(['url'=>'client/mypage/uploadAvatar', 'method'=>'POST', 'files'=>true])}}
			<div class="input-group mb20">
                <input type="text" class="form-control" id="fileval" readonly="true">
                <div class="input-group-btn">
                    <button type="submit" id="submit-avatar" class="btn btn-primary">参照</button>
                </div>
                <input id="file" class="mypage-file-avatar" name="avatar" type="file" accept="image/*">
            </div>
			{{Form::close()}}
		</div>
	</div>
</div> <!-- end .profile-av -->
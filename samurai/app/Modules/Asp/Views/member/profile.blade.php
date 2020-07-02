@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <p class="bg-danger heading-text">マイアカウント</p>
    {!! Form::open(['route'=>['asp_update_profile'],'enctype'=>"multipart/form-data",'id'=>'form-account-edit']) !!}
        <div class="row">
            <div class="col-sm-7">
                <h3>SAMURAIアカウント登録・編集</h3>
                @php
                    $member = auth('asp_user')->user();
                @endphp
                <table class="table form-bor middle">
                    <tbody>
                        <tr class="form-group">
                            <td><label for="">アカウント名</label><span class="required">必須</span></td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-5">
                                        {!! Form::text('first_name',$member->first_name,['class'=>'form-control','placeholder'=>'名','required']) !!}
                                    </div>
                                    <div class="col-sm-5">
                                        {!! Form::text('last_name',$member->last_name,['class'=>'form-control','placeholder'=>'名','required']) !!}
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                        @if($member->isMember())
                            <tr class="form-group">
                                <td><label for="">グループ登録・編集</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        	@php
                                                $group = $member->group()->first();
                                            @endphp
                                            {{ $group ? $group->title :'' }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td><label for="">権限</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            @if($group)
                                                {{ $group->pivot->role == 1 ? 'Group manger' : 'Group member' }}
                                            @else
                                               {{ $member->roleName() }} 
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>                        
                        @else
                            <tr class="form-group">
                                <td><label for="">権限</label></td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            {{ $member->roleName() }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        <tr class="form-group">
                            <td><label for="">通知用メールアドレス</label></td>
                            <td>
							{!! Form::email('email',$member->email,['class'=>'form-control']) !!}	
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">ログインID</label><span class="required">必須</span></td>
                            <td>
                            	{{ $member->account }}
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">ログインパスワード</label><span class="required">必須</span></td>
                            <td><input type="password" name="password" value="" class="form-control"></td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">ログインパスワード（確認）</label><span class="required">必須</span></td>
                            <td><input type="password" name="password_confirmation" value="" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end .col-sm-8 -->
            <div class="col-sm-5">
            	@include('Asp::layouts.partials.image_upload',['name'=>'avatar','img_url'=>$member->avatar])
            </div>
            <!-- end .col-sm-3 -->
        </div> <!-- end .row -->
        <div class="row">
        	<div class="col-xs-12">
        		<div class="text-center">
        			<button type="submit" class="btn btn-primary btn-sm">登録する</button>
        			<button type="button" class="btn btn-default goBack btn-sm">戻る</button>
        		</div>
        	</div>
        </div>

        <!-- end .row -->
    </form>
    <!-- end form -->
</div>
@endsection
@push('script')
    @include('Asp::layouts.modal.modal_notify')
    <script src="{{ asset('assets/asp/js/form-account.js') }}"></script>
@endpush
@extends('Asp::layouts.asp_admin')
@section('title_page')グループ@endsection
@section('content')
<div class="container">
    {!! Form::open(['route'=>['asp.groups.update',$group],'method'=>'PUT','enctype'=>"multipart/form-data"]) !!}
        <div class="row">
            <div class="col-sm-12">
                <table class="table form-bor middle">
                    <tbody>
                        <tr class="form-group">
                            <td><label for="">グループ名</label><span class="required">必須</span></td>
                            <td>
                                {!! Form::text('title',$group->title,['class'=>'form-control','required']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> <!-- end .row -->
        <div class="row">
        	<div class="col-xs-12">
        		<div class="text-center">
        			<button type="submit" class="btn btn-primary btn-sm">登録する</button>
        			<button type="button" class="btn btn-default goBack btn-sm">戻る</button>
        		</div>
        	</div>
        </div><!-- end .row -->
    {!! Form::close() !!}    
        <div class="wrap">
                <div class="tit-bot">
                    <h3 class="bl-inl">グループ参加者</h3>
                    @if(auth('asp_user')->user()->can('create',App\Modules\Asp\Models\AspUser::class))
                    <a href="{{ route('asp.users.create',['group_id'=>$group->id]) }}" class="btn-add"><i class="fa fa-plus"></i><span>メンバーを追加</span></a>
                    @endif
                </div>                
                <div class="row">                    
                    @foreach ($members as $element)
                    <div class="col-sm-2">
                        @include('Asp::layouts.partials.content_user',['user'=>$element,'delete'=>true])
                    </div>
                    @endforeach

                </div> <!-- end .row -->
                @php
                    $request = request();
                @endphp                
                {!! $members->appends($request->query())->links() !!}

                {!! Form::open(['url'=>$request->url(),'method'=>'get']) !!}
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="input-group search-btn-gr">
                            <input type="text" name="keyword" value="{{ $request->query('keyword') }}" class="form-control" placeholder="">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">検索する</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                </div>
                {!! Form::close() !!}
        </div>            
    <!-- end form -->
</div>
@endsection
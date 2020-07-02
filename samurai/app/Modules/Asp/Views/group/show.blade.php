@extends('Asp::layouts.asp_admin')
@section('title_page')グループ@endsection
@section('content')
<div class="container">
        <div class="row">
            <div class="col-sm-7">
                <table class="table form-bor middle">
                    <tbody>
                        <tr class="form-group">
                            <td><label for="">グループ名</label></td>
                            <td>
                                {{ $group->title }}
                                @if(auth('asp_user')->user()->can('create',App\Modules\Asp\Models\AspUser::class))
                                <a href="{{ route('asp.users.create') }}" class="btn btn-default">New member</a>
                                @endif                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> <!-- end .row -->
        <div class="row">
            <div class="col-xs-7">
                <legend>グループ参加者</legend>
                <div class="row">                    
                    @foreach ($members as $element)
                    <div class="col-sm-3">
                        @include('Asp::layouts.partials.content_user',['user'=>$element])
                    </div>
                    @endforeach

                </div> <!-- end .row -->
                {!! $members->appends(request()->query())->links() !!}
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="input-group search-btn-gr">
                            <input type="text" class="form-control" placeholder="">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">検索する</button>
                            </span>
                        </div><!-- /input-group -->
                    </div>
                </div>
                
            </div>
        </div>       
    <!-- end form -->
</div>
@endsection
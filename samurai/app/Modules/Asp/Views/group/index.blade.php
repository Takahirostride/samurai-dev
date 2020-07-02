@extends('Asp::layouts.asp_admin')
@section('title_page')グループ設定@endsection
@section('content')
    <div class="container">
        <!-- end .row -->
        <div class="row">
            <div class="col-sm-8">
                <p class="des">
                    SAMURAIの泉にログインする、スタッフと所属するグループの追加が可能です。
                </p>
                <div class="row">
                    @php
                        $route_name = (auth('asp_user')->user()->isMember()) ? 'asp.groups.show' : 'asp.groups.edit';
                    @endphp
                    @foreach ($groups as $k_gr=>$gr)
                        <div class="col-xs-3">
                            <div class="gdbox">
                                <a href="{{ route($route_name,$gr) }}"><i class="fa {{ $k_gr%2==0?'fa-store':'fa-users' }}"></i></a>
                                <p class="gdbox-desc">{{ $gr->title }}</p>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- end .row -->
                {!! $groups->appends(request()->query())->links() !!}
            </div>
            <!-- end .col-sm-8 -->
            <div class="col-sm-4">
                @if(auth('asp_user')->user()->can('create',App\Modules\Asp\Models\AspGroup::class))
                <a class="btn-add pull-right" href="{{ route('asp.groups.create') }}">
                  <i class="fa fa-plus"></i><span>追加する</span>
                </a>
                @endif
            </div>
            <!-- end .col-sm-3 -->
        </div>

        <!-- end .row -->
    </div>
@endsection
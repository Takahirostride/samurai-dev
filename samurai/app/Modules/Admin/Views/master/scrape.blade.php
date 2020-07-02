@extends('layouts.admin')

@section('header_bottom')
    @includeIf('partials.admin.header_master')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">マスター管理</a><span>&gt;</span></li>
        <li><a>TOP</a></li>
    </ul>
</div>
@endsection
@section('content')
<!-- ngView: -->
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li><a href="{{('/admin/master/csvmanagement')}}">csv管理</a></li>
                                <li><a href="{{('/admin/master/uploaded')}}">アップロードファイル管理</a></li>
                                <li class="active"><a href="{{('/admin/master/scrape')}}">クローリング</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <h3>クローリング新着情報</h3>
                        <div class="text-right" style="margin-bottom:15px;">
                            <form action="" method="POST" class="form-inline">
                                <div class="form-group">
                                    {!!Form::select('order-by', ['1'=>'新着順', '2'=>'日付'], request()->order, ['class' => 'form-control order-by']) !!}
                                </div>
                            </form>
                        </div> <!-- end float-right -->
                        <table class="table table-bordered table-hover text-center">
                            <tbody>
                                <tr>
                                    <td>日付</td>
                                    <td>発行機関</td>
                                    <td>施策名</td>
                                    <td>クローリングサイト</td>
                                </tr>
                                @if($policys)
                                @foreach($policys as $policy)
                                <tr class="linktr" data-href="{{route('admin.employee.data.subsidy_edit', ['id'=>$policy->id])}}">
                                    <td style="width: 120px;">{{ \Carbon\Carbon::parse($policy->created_at)->format('Y-m-d')}}</td>
                                    <td>{{$policy->name}}</td>
                                    <td>{{ str_limit($policy->target, 40) }}</td>
                                    <td style="width: 180px;">{{ $policy->scrape_links->name }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $policys->appends(request()->query())->links() }}
                        </div>
                        <h3>クローリングサイト登録</h3>
                        {{ Form::open(['url' => '/admin/master/scrape', 'method' => 'POST', 'class' => 'form-horizontal']) }}
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group1">
                                        <label for="">サイト名</label>
                                        <input type="text" class="form-control" name="namescrap" placeholder="Input field" required="">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group1">
                                        <label for="">クローリングサイトURL</label>
                                        <input type="text" class="form-control" name="url" placeholder="Input field" required="">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group1">
                                        <button type="submit" class="form-control btn btn-scrapadd scrapeline">登録</button>
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                        <h3>クローリングサイト登録</h3>
                        {{ Form::open(['url' => '/admin/master/scrapedata', 'method' => 'GET', 'class' => 'form-horizontal', 'id'=>'formscrape']) }}
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 36px;">
                                        <input type="checkbox" class="checkall olCheckAll" data-check="scrape_id">
                                    </td>
                                    <td>サイト名</td>
                                    <td>クローリングサイトURL</td>
                                    <td>クローリング</td>
                                </tr>
                                @if($scrape_links)
                                @foreach($scrape_links as $scrape_link)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="scrape_id[]" value="{{$scrape_link->id}}" class="scrape_id">
                                    </td>
                                    <td>{{$scrape_link->name}}</td>
                                    <td>{{$scrape_link->url}}</td>
                                    <td class="text-center" style="width: 120px;">
                                        <button type="button" class="btn btn-primary btn-xs scrapeline" href="">クローリング</button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <p class="text-center">
                            <button type="submit" class="btn btn-scrapadd">一括クローリング</button>
                        </p>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        $('input[type="checkbox"]').olCusCheckbox();
    });
    $.fn.olCusCheckbox = function(opts){
        var sets = $.extend({},$.fn.olCusCheckbox.defaults,opts);
        return this.each(function(){
            var $element = $(this);
            var mod = (function(){
                var exp = {};
                exp.init = function(){
                    if($element.hasClass('btn-cb')){ return true;}
                    var cls = sets.radio ? 'olradio':'';
                    $element.wrap('<span class="olcb-blue '+cls+'"></span>');
                    $element.parent().append('<span class="checkmark"><i class="glyphicon glyphicon-ok"></i></span>');
                    listend();
                }
                var listend = function(){
    
                }
                return exp;
            })();
            return mod.init();
        });
    }
    $(document).on('click', '.scrapeline', function(){
        var obj = $(this);
        $('input.scrape_id').prop('checked', false).trigger('change');
        obj.closest('tr').find('input.scrape_id').prop('checked', true).trigger('change');
        $('#formscrape').submit();
    });
</script>
@endsection
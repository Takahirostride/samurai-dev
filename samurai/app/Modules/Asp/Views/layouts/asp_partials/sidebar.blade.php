<div id="asp_sidebar">
    @php
        $request = request();
    @endphp
    {!! Form::open(['url'=>$request->url(),'method'=>'get','id'=>'sidebar-filter']) !!}
            <div class="sidebar-widget">
                <h3 class="sidebar-hd">業種</h3>
                @php
                    $trades = App\Modules\Asp\Models\Trade::listAll();
                    $sl_trade = $request->query('trade',null);
                @endphp
                <ul class="sidebar-cat" id="fl-trades">
                    <li><a href="#" data-id="" class="{{ $sl_trade=='' ?'selected':''}}">すべて</a></li>
                    @foreach ($trades as $key=>$trade)
                        <li><a href="#" data-id="{{ $key }}" class="{{ $sl_trade==$key ?'selected':''}}">{{ $trade }}</a></li>    
                    @endforeach 
                </ul>
            </div> <!-- end .sidebar-widget -->

            <div class="sidebar-widget">
                <h3 class="sidebar-hd">所在地</h3>
                @php
                    $prvs = App\Modules\Asp\Models\Province::listOnlProvince();
                    $sl_prv = $request->query('province',null);
                @endphp
                <select name="provinces"class="form-control">
                    <option value="">すべて</option>
                    @foreach ($prvs as $key=>$prv)
                        <option value="{{ $key }}" {{ $sl_prv==$key ?'selected':'' }}>{{ $prv }}</option>
                    @endforeach
                </select>
            </div> <!-- end .sidebar-widget -->

            <div class="sidebar-widget">
                <h3 class="sidebar-hd">カテゴリー</h3>
                @php
                    $cats =  App\Modules\Asp\Models\Category::listCat();
                    $sl_cat = $request->query('cat',null);
                @endphp
                <select name="categories" class="form-control">
                    <option value="">すべて</option>
                    @foreach ($prvs as $key=>$prv)
                        <option value="{{ $key }}" {{ $sl_cat==$key ?'selected':'' }}>{{ $prv }}</option>
                    @endforeach
                </select>
            </div> <!-- end .sidebar-widget -->	
    {!! Form::close() !!}        
</div>
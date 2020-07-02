@php
    $request = request();
@endphp
{{ Form::open(['url' => route('asp_search_subsidy'), 'method' => 'GET']) }}
    <table class="table table-bordered form-table" id="subsidy-sea">
        <tr>
            <th>カテゴリー</th>
            <td>
                @php
                    $sl_cat = $request->query('category',[]);
                    $sl_subcat = $request->query('categorysubs',[]);
                @endphp
                <div class="row">
                    @foreach($categorys as $index => $category)
                        <div class="col-sm-4">
                            <div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[{{ $category['id'] }}]" value="{{$category['id']}}" sub-id="sub_{{$category['id']}}" {{ in_array($index,$sl_cat)?'checked':'' }}>{{$category['ite_name']}}</label></div>
                        </div>
                    @endforeach
                </div>
                <div class="text-right mgbt-20">
                    <button type="button" data-check="bigcat" class="check_all btn btn-default btn-lg mgr-20">全選択</button>
                    <button type="button" data-check="bigcat" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>
                </div>
                @foreach($categorys as $index => $category)
                @if(@$category['children'])
                <table id="sub_{{$category['id']}}" class="table table-bordered dtable table-condensed dcat-table subcattable">
                    <tbody>
                        <tr>
                            <th colspan="4">{{$category['ite_name']}}</th>
                        </tr>
                        <tr>
                            @php
                                $c_sub=0;
                                $cat_id = $category['id'];
                                $sl_subcat_ite = empty($sl_subcat[$cat_id])?[] : $sl_subcat[$cat_id];
                            @endphp
                            @foreach($category['children'] as $k_sub => $categorysub)
                            <td>
                                <div class="checkbox"><label><input type="checkbox" class="subcat" name="categorysubs[{{ $category['id'] }}][]" value="{{$k_sub}}" id="check_list_bigcat-{{ $k_sub }}" {{ in_array($k_sub,$sl_subcat_ite)?'checked':"" }}>{{$categorysub}}</label></div>
                            </td>
                            @php $num = $c_sub+1;$c_sub++; @endphp
                            @if($num % 4 == 0) </tr><tr> @endif 
                            @endforeach
                        <tr>
                            <td colspan="4" class="dright-el dbg-gray"><div class="checkbox"><label><input type="checkbox" value="sub_{{$category['id']}}" class="check_list_all_sub">全選択</label></div></td>
                        </tr>
                    </tbody>
                </table> <!-- end table category -->
                @endif
                @endforeach

            </td>
        </tr>
        <tr>
            <th>対象地域</th>
            <td>
                @php
                    $sl_region = $request->query('region',0);
                    $sl_cities = $request->query('cities',[]);
                @endphp
                <select class="form-control max-w5 selectregion" name="region" data-cities="{{ implode(',',$sl_cities) }}">
                    <option value="">都道府県を選択してください</option>
                    @if($regions) 
                    @foreach($regions as $k_reg=>$region)
                        <option value="{{$k_reg}}" {{ $k_reg==$sl_region ? 'selected':'' }}>{{$region}}</option>
                    @endforeach
                    @endif
                </select>

                <div class="row mgt-20" id="cities_checkbox">
                    
                </div>
                <div class="mt15 pro-checkbox">
                    <div class="checkbox"><label><input type="checkbox" class="" name="location[]" value="1"  {{ in_array(1,$request->query('location',[]))?'checked':'' }}>誘致関連施策を含む</label></div>

                </div>
            </td>
        </tr>
        <tr>
            <th>キーワード</th>
            <td>
                <input type="text" name="keyword" class="form-control max-w5" value="{{ $request->query('keyword') }}">
                <p class="mt15">※ものづくり、補助金</p>
            </td>
        </tr>
        <tr>
            <th>業種</th>
            <td>
                @if(@$trades)
                @php
                    $sl_trades = $request->query('trades',[]);
                @endphp
                <div class="row">
                @foreach($trades as $k_trade => $trade)
                <div class="col-sm-4">
                    <div class="checkbox"><label><input type="checkbox" class="trades" name="trades[]" value="{{$k_trade}}" id="check_list_bigcat-1" {{ in_array($k_trade,$sl_trades)?'checked':'' }}>{{$trade}}</label></div>
                </div>
                @endforeach
                </div>
                @endif
                <div class="text-right mgbt-20">
                    <button type="button" data-check="trades" class="check_all btn btn-default btn-lg mgr-20">全選択</button>
                    <button type="button" data-check="trades" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>
                </div>
            </td>
        </tr>
    </table>
    <div class="text-center bsearch-btn-s">
        <button id="checksearch" name="searchtype" value="1" type="submit" class="btn btn-primary btn-md">検索</button>
    </div>
{{ Form::close() }}
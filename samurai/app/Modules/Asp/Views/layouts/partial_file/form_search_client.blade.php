    @php
    $request = request();
    @endphp
{!! Form::open(['method'=>'GET','class'=>'fr-clients','id'=>'fr-clients']) !!}
    <table class="table table-bordered table-blue">
        <tbody>
            <tr>
                <th>
                    <span>屋号または名称</span>
                </th>
                <td>
                    <div class="form-group">
                        {!! Form::text('keyword',$request->query('keyword',null),['class'=>'form-control','placeholder'=>'屋号または名称を入力してください']) !!} 
                                               
                    </div>
                </td>
            </tr>
            <tr>
                <th><span>住所１（都道府県）</span></th>
                <td>
                    <div class="form-group">
                        {!! Form::selectMinitry('province',$request->query('province'),[]) !!}
                         <div class="help-block with-errors"></div>                        
                    </div>
                </td>
            </tr>
            <tr>
                <th><span>住所２（市区町村）</span></th>
                <td>
                    <div class="form-group">
                        {!! Form::selectSubMinitry('city',$request->query('city'),['placeholder'=>'選択してください']) !!}
                        <div class="help-block with-errors"></div> 
                                                
                    </div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    <span>業種</span>
                </th>
                <td>
                    @php
                        $qr_trade = $request->query('trade',[]);
                    @endphp
                    <div class="form-group" id="checkbox-trade">
                        <ul class="lst-inl lst-col2" id="cb-trade">
                            @foreach ($trades as $v_trade=>$trade)
                                <li>
                                    <label class="lb-checkbox">
                                        <input type="checkbox" name="trade[]" value="{{ $v_trade }}" {{ in_array($v_trade,$qr_trade) ? 'checked':''  }}>
                                        <span>{{ $trade }}</span>
                                    </label>
                                </li>
                            @endforeach
                            <li>
                                <button type="button" class="btn btn-cbox">
                                    <input type="checkbox" name="trade_all" value="1" class="olCheckAll" data-name="trade[]" {{ $request->query('trade_all',0)==1 ? 'checked':'' }}>
                                    <span>全選択</span>
                                </button>
                            </li>                        
                        </ul>  
                        
                    </div> 
                    <div class="with-errors"></div>               
                </td>
            </tr>
        </tbody>
    </table>
    <div class="text-center bsearch-btn-s">
        <button id="checksearch" name="searchtype" value="1" type="submit" class="btn btn-success btn-md">絞り込む</button>
    </div>
{!! Form::close() !!}
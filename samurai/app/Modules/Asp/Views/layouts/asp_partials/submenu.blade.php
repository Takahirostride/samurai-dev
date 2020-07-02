@php
    $request = request();
@endphp
<div class="container">
    <div class="row">
            <div class="staff-submenu">
                <ul class="s-submenu">
                    <li class="active"><a href="">すべて</a></li>
                    <li class=""><a href="">担当者 1</a></li>
                    <li class=""><a href="">担当者 2</a></li>
                    <li class=""><a href="">担当者 3</a></li>
                    <li class=""><a href="">担当者 4</a></li>
                    <li class=""><a href="">担当者 5</a></li>
                    <li class=""><a href="">担当者 6</a></li>
                </ul>
            </div>
            @php
                $rt_name = $request->url();
            @endphp        
            <div class="staff-submenu-1">
                <div class="col-md-8">
                <ul class="s-submenu-1">
                    <li class="{{ preg_match('/client/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_client') }}">企業を探す</a>
                        <ul>
                            <li class="{{ preg_match('/(client\/favorite)/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_client_index_favorite') }}">保存リストを見る</a></li>
                            <li class="{{ preg_match('/(client\/history)/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_client_index_history') }}">履歴を見る</a></li>
                        </ul>
                    </li>
                    <li class="{{ preg_match('/policy/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_policy_index') }}">施策を探す</a>
                        <ul>
                            <li class="{{ preg_match('/(policy\/favorite)/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_policy_index_favorite') }}">保存リストを見る</a></li>
                            <li class="{{ preg_match('/(policy\/history)/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_policy_history') }}">履歴を見る</a></li>
                        </ul>
                    </li>
                    <li class="{{ preg_match('/samurai\-register/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_register_index') }}">samurai 登録を依頼する</a>
                        <ul>
                            <li class="{{ preg_match('/(register\-samurai\/favorite)/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_register_favorite') }}">保存リストを見る</a></li>
                            <li class="{{ preg_match('/(register\-samurai\/history)/',$rt_name) ? 'active':'' }}"><a href="{{ route('asp_register_history') }}">履歴を見る</a></li>
                        </ul>
                    </li>
                </ul>                    
                </div>
                <div class="col-md-4">
                    {!! Form::open(['url'=>$request->url(),'method'=>'get']) !!}
                        <div class="input-group box-sea">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" name="keyword" value="{{ $request->query('keyword',null) }}">
                        </div>                    
                    {!! Form::close() !!}
                </div>

            </div>
    </div> <!-- end .row -->	
</div>
 @php
    $rt_name = Route::currentRouteName();
@endphp   
    <div class="navbar navbar-bor navbar-home">
            <ul class="nav navbar-nav">
                <li class=""><span>ダッシュボード</a></span>
                <li>
                    <a href="{{ route('asp_home_page') }}" class="{{ $rt_name == 'asp_home_page'?'active':'' }}">担当企業ダッシュボード</a>
                </li>
                <li>
                    <a href="{{ route('asp_home_page_general') }}" class="{{ $rt_name =='asp_home_page_general'?'active':'' }}">全体ダッシュボード</a>
                </li>                
            </ul>
    </div>
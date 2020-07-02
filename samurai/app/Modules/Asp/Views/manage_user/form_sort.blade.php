@php
    if(!isset($results)){ return false;}
@endphp
<table class="table table-bordered tb-sort">
    <thead>
        <tr>
            <th>
                <span class="page-per-page">検索結果: {{$results->total()}}件</span>
                <div class="float-right">
                    <form action="{{ request()->fullUrl() }}" method="GET" class="form-inline olFormFilter">
                        <div class="form-group">
                            <label for="">並び替え: </label>
                            @php
                                $orders=[1=>'ログイン順',2=>'情報登録日',3=>'samurai登録済',4=>'samurai未登録'];
                            @endphp
                            {!!Form::select('order-by',$orders, request()->order, ['class' => 'form-control order-by olip','placeholder'=>'']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">表示件数: </label>
                            {!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page olip']) !!}
                        </div>
                    </form>
                </div> <!-- end float-right -->
            </th>
        </tr>
    </thead>
</table>
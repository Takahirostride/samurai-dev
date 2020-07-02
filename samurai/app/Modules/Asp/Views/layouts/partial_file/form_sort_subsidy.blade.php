@php
    if(!isset($element)){return false;}
@endphp
<div class="tb-contain tb-sort">
    <div class="tb-item tb-xs-item cell-result">
        <span class="page-per-page">検索結果: {{$results->total()}}件</span>
    </div>
    <div class="tb-item tb-xs-item cell-sort">
        <div class="float-right">
            <form action="" method="POST" class="form-inline">
                <div class="form-group">
                    <label for="">並び替え: </label>
                    {!!Form::select('order-by', config('combobox.order_by'), request()->order, ['class' => 'form-control order-by']) !!}
                </div>
                <div class="form-group">
                    <label for="">表示件数: </label>
                    {!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
                </div>
            </form>
        </div> <!-- end float-right -->        
    </div>    
</div>    

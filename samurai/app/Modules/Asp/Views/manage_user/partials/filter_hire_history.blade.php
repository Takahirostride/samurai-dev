@php
    if(!isset($results)){ return false;}
@endphp
<div class="tb-contain tb-sort">
    <div class="tb-item tb-xs-item cell-result">
        <span class="page-per-page">検索結果: {{$results->total()}}件</span>
    </div>
    <div class="tb-item tb-xs-item cell-sort">
                <div class="float-right">
                    <form action="{{ request()->fullUrl() }}" method="GET" class="form-inline olFormFilter">
                        <div class="form-group">
                            <label for="">表示件数: </label>
                            {!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page olip']) !!}
                        </div>
                    </form>
                </div> <!-- end float-right -->        
    </div>
</div>

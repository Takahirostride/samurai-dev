@php
    if(!isset($element)){return false;}
@endphp
<table class="table table-bordered tb-sort">
    <thead>
        <tr>
            <th>
                <span class="page-per-page">検索結果: {{$element->total()}}件</span>
                <div class="float-right">
                    <form action="" method="POST" class="form-inline">
                        <div class="form-group">
                            <label for="">並び替え: </label>
                            @php
                                $opts = [1=>'新着順',2=>'締め切り順',3=>'支援規模順'];
                            @endphp
                            {!!Form::select('order-by',$opts, request()->order, ['class' => 'form-control order-by']) !!}
                        </div>
                        <div class="form-group">
                            <label for="">表示件数: </label>
                            {!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
                        </div>
                    </form>
                </div> <!-- end float-right -->
            </th>
        </tr>
    </thead>
</table>
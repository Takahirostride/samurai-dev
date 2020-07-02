@php
$request = request();
@endphp
{!! Form::open(['method'=>'GET','class'=>'fr-clients']) !!}
    <div class="row mgbt-15">
        <div class="form-group">
            <label class="control-label col-sm-2" for="">屋号または名称 </label>
            <div class="col-sm-10">
                {!! Form::text('keyword',$request->query('keyword',null),['class'=>'form-control','placeholder'=>'例）株式会社SAMURAI']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <div class="form-group">
                <label>更新日</label>
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="form-group">
                <input type="date" name="date_from" value="{{ $request->query('date_from',null) }}" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
            </div>            
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="form-group">
                <input type="date" name="date_to" value="{{ $request->query('date_to',null) }}" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
            </div>            
        </div>

    </div>
    <div class="text-center bsearch-btn-s">
        <button id="checksearch" name="searchtype" value="1" type="submit" class="btn btn-success btn-md">絞り込む</button>
    </div>
{!! Form::close() !!}
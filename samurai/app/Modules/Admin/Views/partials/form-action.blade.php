@php
    if(!isset($actions)){ return false;}
    $opts = array_map(function($ite){ return $ite['title'];},$actions);
@endphp
<div class="col-md-12 bl_actions">
    <div class="row">
        <div class="col-sm-4">
            {!! Form::select('acts',$opts,null,['class'=>'form-control']) !!} 
        </div>
        <div class="col-sm-2">
            <input type="submit" name="submit" class="submit-blue-btn" value="適用">
        </div>
        @if(isset($values))
            <div class="pos-right">{{ $values->count() }}件表示 / {{ $values->total() }}件</div>
        @endif
    </div>	
</div>
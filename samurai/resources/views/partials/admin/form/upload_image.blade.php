@php
  $atb = array_merge([
    'class'=>'form-control upl-sv',
    'readonly',
  ],$atb);
  $atb = ol_array_to_attribute($atb);
@endphp
<div class="gridcell-right olSingleImage">
    <div class="input-group">
        <input type="text" name="{{ $name }}" value="{{ $value }}" {!! $atb !!}/>
        <div class="input-group-btn" style="padding-left: 10px;">
            <label class="btn submit-blue-left" for="upload_image_{{ $name }}" style="width: 100px;">参照</label>
            <input id="upload_image_{{ $name }}" type="file" name="file_{{ $name }}" class="upl-file" style="display: none;" accept="image/*">
        </div>
        <div class="input-group-btn" style="padding-left: 10px;">
            <label class="btn submit-blue-left upl-prv" style="width: 100px;">表示</label>
        </div>                    
    </div>
    <div class="help-block with-errors"></div>
    <div class="modal fade" id="prv_image_{{ $name }}" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->    
</div>
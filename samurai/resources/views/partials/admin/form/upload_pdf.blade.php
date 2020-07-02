@php
  $id = str_replace(['[',']'],'_', $name);
  $value = empty($value)?['','']:$value;
@endphp
<div class="gridcell-right olSinglePdf">
    <div class="input-group">
        <input type="text" name="{{ $name }}[0]" class="form-control upl-name" value="{{ $value[0] }}" readonly/>
        <input type="hidden" name="{{ $name }}[1]" class="form-control upl-sv" value="{{ $value[1] }}"/>
        <div class="input-group-btn" style="padding-left: 10px;">
            <label class="btn submit-blue-left" for="upload_pdf_{{ $id }}" style="width: 100px;">参照</label>
            <input id="upload_pdf_{{ $id }}" type="file" name="file_{{ $name }}" class="upl-file" style="display: none;" accept="application/pdf">
        </div>
        <div class="input-group-btn" style="padding-left: 10px;">
            <button type="button" class="submit-delete-button upl-del"></button>
        </div>                                                
    </div>
</div>
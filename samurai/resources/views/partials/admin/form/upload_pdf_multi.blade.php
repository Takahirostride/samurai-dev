@php
  $id = str_replace(['[',']'],'_', $name);
  $value = empty($value)?[]:$value;
@endphp
<div class="gridcell-right olMultiPdf" data-name="{{ $name }}">
    <div class="tb-contain">
        <div class="tb-cell">
            <div class="results">
                @foreach ($value as $key=>$ite)
                    <div class="input-group" id="olpdf-item-{{ $key }}">
                        <input type="text" name="{{ $name }}[{{ $key }}][name]" class="form-control upl-name" value="{{ array_key_exists('name', $ite) ? $ite['name']:$ite[0] }}" readonly/>
                        <input type="hidden" name="{{ $name }}[{{ $key }}][url]" class="form-control upl-sv" value="{{ array_key_exists('url',$ite) ? $ite['url'] : $ite[1] }}"/>
                        <div class="input-group-btn">
                            <button type="button" class="submit-delete-button upl-del"></button>
                        </div>                                                
                    </div>
                @endforeach               
            </div>            
        </div>
        <div class="tb-cell tb-file">
            <div class="olpdf-file">
                <div class="olpdf-label">
                    <span class="ico glyphicon glyphicon-folder-open"></span>
                    <span>このエリアにドロップしてください</span>
                </div>
                <input type="file" name="olpdf_multi_file" class="upl-file" accept="application/pdf" multiple="multiple">
            </div>            
        </div>
    </div>
</div>
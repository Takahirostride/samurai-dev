@php
    $name = isset($name) ? $name : 'image';
    $img_url = isset($img_url) ? $img_url : '';
    $request = request();
    if($request->old($name)){
        $img_url = $request->old($name);
    }    
    $img_link = !empty($img_url) ? asset($img_url) : asset('assets/common/images/fa-avatar.png');
@endphp
<div class="olSingleImage">
    <div class="text-center mgt-30">
    <div class="avatardiv">
        <img id="avatar-view" class="img-prv" src="{{ $img_link }}" alt="">
    </div>
    </div>
    <div class="mgt-30">
    <div class="inputfile">
        <input type="text" class="upl-sv" name="{{ $name }}" id="filenamed" value="{{ $img_url  }}">
        <span>選択する</span>
        <input class="hidefile upl-file" type="file" data-showname="filenamed" data-view="avatar-view" name="sgl_image">
    </div>
    </div>    
</div>


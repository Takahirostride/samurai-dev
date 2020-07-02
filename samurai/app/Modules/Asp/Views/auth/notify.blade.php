<?php 
if(!isset($errors)&& !session('status')&& !session('error')){
return false;
}
?>
<section class="bl-notify">
    @if(session('status'))
        <div class="alert alert-info alert-dismissible">
        <p>{{ session('status') }}</p>                
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
        <p>{{ session('error') }}</p>                
        </div>
    @endif
    @if(isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif                
</section>

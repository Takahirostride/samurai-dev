@extends('Asp::layouts.auth')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="bl-middel">
                <p class="text-center">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/asp/images/logo-asp.png') }}" class="logo-img" alt="SAMURAI"></a>
                </p>
                @include('Asp::auth.notify')
                <form action="{{ route('asp_login') }}" method="POST" role="form" class="authform">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <p>
                                <label class="control-label">Username</label>
                            </p>  
                            <p>
                            <input type="text" name="account" class="form-control" id="account" placeholder="eg: jaison.justus" required>
                                
                            </p>                          
                    </div>
                    <div class="form-group">
                        <p>
                            <label class="control-label">Password</label>
                        </p>
                        <p>
                            <input type="password" name="password" class="form-control" id="" placeholder=".........." required>
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="">
                          <input type="checkbox" name="remember" value="1">
                          <span>Remeber me on this computer</span>
                        </label>
                        <p class="mt10"><a data-toggle="modal" href='#modal-reset-password'>パスワードをお忘れの場合</a></p>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-authform btn-lg btn-login">LOGIN</button>                        
                    </div>
                    
                </form>                
            </div>

        </div>
    </div>
</div>
@endsection
@push('script')
    @include('Asp::auth.modal_reset_password')
@endpush
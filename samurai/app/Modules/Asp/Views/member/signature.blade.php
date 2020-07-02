@extends('Asp::layouts.asp')
@section('content')
@php
    $prev_link = session('prev_link') ? session('prev_link') : url()->previous();
@endphp
<div class="container">
    <p class="bg-danger heading-text">署名管理</p>
    {!! Form::open(['route'=>['asp_update_signature'],'enctype'=>"multipart/form-data",'id'=>'form-signature']) !!}
        <input type="hidden" name="prev_link" value="{{ $prev_link }}">
        <div class="row">
            <div class="col-sm-7">
                <p>パンフレットに印刷する署名登録編集</p>
                <table class="table form-bor middle">
                    <tbody>
                        <tr class="form-group">
                            <td><label for="">会社名</label><span class="required">必須</span></td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-12">
                                        {!! Form::text('company',$signature->company,['class'=>'form-control','required']) !!}
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">役職 / 部署名</label></td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-12">
                                    	{!! Form::text('position',$signature->position,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">担当者名</label><span class="required">必須</span></td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-12">
                                        {!! Form::text('name',$signature->name,['class'=>'form-control','required']) !!}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">住所１</label><span class="required">必須</span></td>
                            <td>
							{!! Form::text('address_1',$signature->address_1,['class'=>'form-control','required']) !!}	
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">住所２</label></td>
                            <td>
                            	{!! Form::text('address_2',$signature->address_2,['class'=>'form-control']) !!}
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">TEL</label></td>
                            <td>{!! Form::text('tel',$signature->tel,['class'=>'form-control']) !!}</td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">FAX</label></td>
                            <td>{!! Form::text('fax',$signature->fax,['class'=>'form-control']) !!}</td>
                        </tr>
                        <tr class="form-group">
                            <td><label for="">MAIL</label></td>
                            <td>{!! Form::email('email',$signature->email,['class'=>'form-control']) !!}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- end .col-sm-8 -->
            <div class="col-sm-5">
            	@include('Asp::layouts.partials.image_upload',['name'=>'avatar','img_url'=>$signature->avatar])
            </div>
            <!-- end .col-sm-3 -->
        </div> <!-- end .row -->
        <div class="row">
        	<div class="col-sm-7">
        		<div class="text-right">
                    @php
                        $btn_cls = 'btn-primary';
                        $btn_txt = '保存ボタン';
                        if(!empty($signature->company)){
                            $btn_cls = 'btn-orange';
                            $btn_txt = '編集する';
                        }
                    @endphp
        			<button type="submit" class="btn {{ $btn_cls }} btn-sm">{{ $btn_txt }}</button>                    
        		</div>
        	</div>
            <div class="col-sm-5">
                <a href="{{ $prev_link }}" class="btn btn-white">戻る</a>
            </div>
        </div>

        <!-- end .row -->
    </form>
    <!-- end form -->
</div>
@endsection
@push('script')
    @include('Asp::layouts.modal.modal_notify')
<script>
(function($){
    $(function(){
        $('#form-signature').validate({
            rules : {
                    email:{
                        email:true,
                    },
                    company :"required",
                    name :"required",
                    address_1 :"required"
            },
            messages :{
            }          
        });
    });
})(jQuery); 
</script>
@endpush
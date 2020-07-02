@extends('Asp::layouts.asp_admin')
@section('title_page')グループ@endsection
@section('content')
<div class="container">
    {!! Form::open(['route'=>['asp.groups.store'],'enctype'=>"multipart/form-data"]) !!}
        <div class="row">
            <div class="col-sm-7">
                <legend>グループ作成</legend>
                <table class="table form-bor middle">
                    <tbody>
                        <tr class="form-group">
                            <td><label for="">グループ名</label><span class="required">必須</span></td>
                            <td>
                                {!! Form::text('title',null,['class'=>'form-control','required']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> <!-- end .row -->
        <div class="row">
        	<div class="col-xs-7">
        		<div class="text-center">
        			<button type="submit" class="btn btn-primary">登録する</button>
        			<button type="button" class="btn btn-default goBack">戻る</button>
        		</div>
        	</div>
        </div><!-- end .row -->
        
    {!! Form::close() !!}
    <!-- end form -->
</div>
@endsection
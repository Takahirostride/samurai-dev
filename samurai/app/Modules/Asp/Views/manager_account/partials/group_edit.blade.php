{!! Form::open(['route'=>['asp_manager_account_group_update',$group],'method'=>'POST','enctype'=>"multipart/form-data"]) !!}
    <div class="row">
        <div class="col-sm-12">
            <table class="table form-bor middle">
                <tbody>
                    <tr class="form-group">
                        <td><label for="">グループ名</label><span class="required">必須</span></td>
                        <td>
                            {!! Form::text('title',$group->title,['class'=>'form-control','required']) !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> <!-- end .row -->
    <div class="row">
    	<div class="col-xs-12">
    		<div class="text-center">
    			<button type="submit" class="btn btn-primary btn-sm">登録する</button>
    			<a href="{{ route('asp_manager_account') }}" class="btn btn-default btn-sm">戻る</a>
                <a href="{{ route('asp_manager_account_group_destroy',$group) }}" class="btn btn-red olDelGroup"  data-title="{{ $group->title }}">グループ削除</a>
    		</div>
    	</div>
    </div><!-- end .row -->
{!! Form::close() !!} 
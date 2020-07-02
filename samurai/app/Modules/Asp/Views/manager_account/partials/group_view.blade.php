<div class="row">
    <div class="col-sm-12">
        <table class="table form-bor middle">
            <tbody>
                <tr class="form-group">
                    <td><label for="">グループ名</label></td>
                    <td>
                        <p>{{ $group->title }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div> <!-- end .row -->
<div class="row">
	<div class="col-xs-12">
		<div class="text-center">
			<a href="{{ route('asp_manager_account') }}" class="btn btn-default btn-sm">戻る</a>
		</div>
	</div>
</div><!-- end .row -->
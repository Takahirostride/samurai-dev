<table class="table table-bordered table-hover pdtdbold table-striped">
	<thead>
		<tr>
			<th style="width: 20%">日付</th>
			<th style="width: 30%">タスク</th>
			<th style="width: 30%">ファイル</th>
			<th style="width: 20%">編集・削除</th>
		</tr>
	</thead>
	<tbody>
		@foreach($work_set as $w)
		<tr>
			<td class="text-center">{{date_string($w->schedule)}}</td>
			<td class="text-center">{{WorkSetString($w->work_content, $w->work_content_other_value, $w->work_content_other)}}</td>
			<td class="text-center">{{$w->file_name}}</td>
			<td class="text-center">
				<button type="button" onclick="editTask({{$w->id}});" class="btn btn-sm btn-default"><i class="fa fa-edit"></i></button>
				<button type="button" onclick="deleteTask({{$w->id}});" class="btn btn-sm btn-default"><i class="fa fa-remove"></i></button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
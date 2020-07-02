<div class="form_csv">
	<h3><span class="sep">1</span>CSVファイルを用意しましょう</h3>
	<p><a href="{{ asset('assets/asp/csv/samurai_csv_import_format.xlsx') }}" class="link" download>CSVファイルのサンプル</a>をダウンロードして、Microsoft等でクライアントの情報を変更してください。必須項目以外は空欄にしても問題ありません。</p>
	<ul class="lst-csv-field">
		<li><span class="required">必須</span><span>会社名事業所名</span></li>
		<li><span class="required">必須</span><span>都道府県</span></li>
		<li><span class="required">必須</span><span>市区町村</span></li>
		<li><span class="required">必須</span><span>町名番地</span></li>
		<li><span>マンション名ビル名</span></li>
		<li><span class="required">必須</span><span>業種</span></li>
		<li><span>設立年月</span></li>
		<li><span class="required">必須</span><span>資本金</span></li>
		<li><span class="required">必須</span><span>従業員数</span></li>
		<li><span>メールアドレス</span></li>		
	</ul>
	<h3><span class="sep">2</span>ユーザーのインポート</h3>
	<p>規定の様式のCSVファイルをアップロードしてユーザーを一括登録します。</p>
	<div class="import-csv">
		{!! Form::open(['route'=>['asp_manage_clients_csv_import'],'enctype'=>'multipart/form-data','class'=>'form-import']) !!}
			<div class="btn-file">
				<span class="btn">ファイルを選択</span>
				<span class="name"></span>				
				<input type="file" name="company" accept=".xlsx" required>
			</div>
			<div class="bl-submit">
				<button type="submit" name="save" value="1" class="btn-plus">
					<i class="fa fa-plus"></i>
					<span>差分インポート</span>				
				</button>
			</div>		
		{!! Form::close() !!}
	</div>	
</div>
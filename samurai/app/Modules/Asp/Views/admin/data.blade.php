@extends('Asp::layouts.asp_admin')
@section('title_page')
CSV データ取り込み
@endsection
@section('content')
<div class="container">
    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#tab111" aria-controls="tab111" role="tab" data-toggle="tab">取引先情報</a>
            </li>
        </ul>
    
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab111">
                <p class="csv-d">現在、企業が取得している補助金・助成金情報の一覧です。施策名をクリックすると、施策名の詳細情報をみることができます。</p>
                <p class="csv-h">手順1 取り込み用ファイルフォーマットのダウンロード</p>
                <p class="csv-d">利用者情報取り込み用のフォマットをダウンロードし、取り込む情報をCSVフォマットに合わせて入力してください。</p>
                <p class="csv-h">手順 2 CSV フォマットのアップロード</p>
                <p class="csv-d">読み込むファイルを選択して、情報入力済みのCSV フォーマットをアップロードしてください。</p>
                <a class="btn-add" href="#">
                  <i class="fa fa-check"></i><span>取り込むを開始</span>
                </a>
            </div>
        </div>
    </div>    	
</div>
@endsection
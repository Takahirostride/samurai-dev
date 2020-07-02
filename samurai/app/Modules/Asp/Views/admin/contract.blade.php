@extends('Asp::layouts.asp_admin')
@section('title_page')
契約者ページ
@endsection
@section('content')
<div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p class="des">
                    SAMURAIの泉にログインする、スタッフと所属するグループの追加が可能です。
                </p>
            </div>
            <div class="col-xs-12 contract-page">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <div class="dbox">
                            <a class="boxl" href="{{ route('asp_admin_contract_export1') }}"></a>
                            <h3 class="dbox-title"><i class="fa fa-id-card"></i> 登録情報設定</h3>
                            <p class="dbox-desc">ご契約内容を確認・変更する事ができます。</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="dbox">
                            <a class="boxl" href="{{ route('asp_admin_contract_export2') }}"></a>
                            <h3 class="dbox-title"><i class="fa fa-folder"></i> ご利用状況</h3>
                            <p class="dbox-desc">各種サーピスの設定状況を確認・変更することができます。</p>
                        </div>
                    </div>
                </div> <!-- end .row -->
                    
            </div> <!-- end .col-xs-12 -->
            
        </div> <!-- end .row -->
    <!-- end form -->
   
</div>
@endsection
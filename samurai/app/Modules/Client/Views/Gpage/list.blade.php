@extends('layouts.home')
@section('style')
	<!-- <link rel="stylesheet" href="//assets/client/css/g_home.css"> -->
@endsection
@section('content')
<div class="mainpage">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li><a class="bg-color" href="#">TOPページ</a></li>
                    <li class="active">助成金・補助金の申請代行募集をする</li>
                </ol>   
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">助成金・補助金の申請代行募集をする</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mainpage">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-step "><b><span>STEP1</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;どのリストから申請代行募集をするのかを選択してください。</b></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="div-style-yellow box-radio-2">
                            <div class="col-sm-8">
                                <label class="click-label"><input  class="control-label check-option" type="radio" name="option" value="1" pos="0" checked="checked" aria-invalid="false">提案を検討リストから施策を選択する</label>
                                <br> 
                                <label><input class="control-label check-option" type="radio" value="2" name="option" pos="1" aria-invalid="false">興味ありリストから施策を選択する</label>
                                <br> 
                                <label><input class="control-label check-option" type="radio" value="3" name="option" pos="2" aria-invalid="false">自動マッチングから選択する</label>
                                <br> 
                                <label><input class="control-label check-option" type="radio" value="4" name="option" pos="3" aria-invalid="false">条件設定検索をして施策を選択する</label>
                            </div>
                            <div class="col-sm-4 text-right">
                                <a  href="/client/Glist" class="btn btn-success  btn-style-shadow-green change-pos" >施策を選択する</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12"> 
                        <div class="div-style-grey ds-il-bl">
                            <div class="col-sm-6">
                                <h5>0件/1件</h5> 
                            </div>
                            <div class="col-sm-6">
                                <h5 class="col-sm-3">並び替え：</h5>
                                <div class="col-sm-3">
                                    <select class="form-control"> 
                                        <option value="1">1</option>                                     
                                        <option value="2">2</option>                                     
                                        <option value="3">3</option>                                     
                                    </select>
                                </div>
                                <h5 class="col-sm-3">表示件数：</h5>
                                <div class="col-sm-3">
                                    <select class="form-control" aria-invalid="false"> 
                                        <option value="10">10</option>                                     
                                        <option value="15">15</option>                                     
                                        <option value="20" selected="selected">20</option>                                     
                                    </select>
                                </div>                             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-scope recruitment col-sm-12">
                    <div class="col-sm-9">
                        <div class="col-sm-2">
                            <div class="text-center mgt-20">
                                <img src="/assets/images/img1.jpg">
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
                            <p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                            <p>区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
                            中小企業事業資金融資あっせん制...</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                <strong>提案を検討</strong>
                            </button>
                            <p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                            </div>
                            <div class="tooltips"><button type="button" class="btn btn-default btn-success">
                                <strong>興味あり</strong>
                                </button>
                                <p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                            </div>
                            <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                <strong>非表示</strong>
                                </button>
                                <p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
                            </div>
                            <div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <button type="button" class="btn btn-default btn-success pdlr-30"><strong>施策を選択する</strong></button>
                    </div>
                </div>
                <div class="box-scope recruitment col-sm-12">
                    <div class="col-sm-9">
                        <div class="col-sm-2">
                            <div class="text-center mgt-20">
                                <img src="/assets/images/img1.jpg">
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
                            <p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                            <p>区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
                            中小企業事業資金融資あっせん制...</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                <strong>提案を検討</strong>
                            </button>
                            <p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                            </div>
                            <div class="tooltips"><button type="button" class="btn btn-default btn-success">
                                <strong>興味あり</strong>
                                </button>
                                <p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                            </div>
                            <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                <strong>非表示</strong>
                                </button>
                                <p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
                            </div>
                            <div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <button type="button" class="btn btn-default btn-success pdlr-30"><strong>施策を選択する</strong></button>
                    </div>
                </div>
                <div class="box-scope recruitment col-sm-12">
                    <div class="col-sm-9">
                        <div class="col-sm-2">
                            <div class="text-center mgt-20">
                                <img src="/assets/images/img1.jpg">
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
                            <p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                            <p>区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
                            中小企業事業資金融資あっせん制...</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                <strong>提案を検討</strong>
                            </button>
                            <p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                            </div>
                            <div class="tooltips"><button type="button" class="btn btn-default btn-success">
                                <strong>興味あり</strong>
                                </button>
                                <p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                            </div>
                            <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                <strong>非表示</strong>
                                </button>
                                <p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
                            </div>
                            <div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <button type="button" class="btn btn-default btn-success pdlr-30"><strong>施策を選択する</strong></button>
                    </div>
                </div>
                <div class="box-scope recruitment col-sm-12 mb20">
                    <div class="col-sm-9">
                        <div class="col-sm-2">
                            <div class="text-center mgt-20">
                                <img src="/assets/images/img1.jpg">
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <h3 class="box-scope-title">タイトルタイトルタイトルタイトル</h3>
                            <p class="measure_text1 ng-binding">登録機関：○○○/募集時期：○○○</p>
                            <p>区内の中小企業者が事業資金を必要とする場合、低利で融資が受けられるように金融機関にあっせんします。
                            中小企業事業資金融資あっせん制...</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                <strong>提案を検討</strong>
                            </button>
                            <p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                            </div>
                            <div class="tooltips"><button type="button" class="btn btn-default btn-success">
                                <strong>興味あり</strong>
                                </button>
                                <p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                            </div>
                            <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                <strong>非表示</strong>
                                </button>
                                <p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
                            </div>
                            <div class="btn-cost2">
                                <label class="label-cost ng-binding">融資視線：1,500万円</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <button type="button" class="btn btn-default btn-success pdlr-30"><strong>施策を選択する</strong></button>
                    </div>
                </div>
                <div class="row">
                    <nav class="text-center" aria-label="pagination">
                        <ul class="pagination">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1">最初</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>

                            <li class="page-item">
                              <a class="page-link" href="#">最後</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(".check-option").click(function(){
        var pos = $(this).attr("pos");
        pos = pos * 50;
        console.log(pos);
        $(".change-pos").css('margin-top', pos+"px" );
    })
</script>
@endsection
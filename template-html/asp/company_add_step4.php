<?php include ('./inc/header2.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="com-hd">株式会社サムライ　様</p>
                        <div class="step-div">
                            <span class="" onclick="window.location.href='company_add_step1.php';">基本情報</span>
                            <span class="" onclick="window.location.href='company_add_step2.php';">助成金・補助金情報</span>
                            <span class="" onclick="window.location.href='company_add_step3.php';">党則・利用状況</span>
                            <span class="active">資料</span>
                        </div>
                        <p>現在、企業が取得している助成金・補助金情報の一覧です。施策名をクリックすると、施策の詳細情報をみることができます。</p>
                        <div class="row">
                            <p class="com-hd">資料作成履歴</p>

                            <div class="col-xs-12">
                                <table class="table table-bordered com-table">
                                    <thead>
                                        <tr>
                                            <th width="20%">作成日</th>
                                            <th>施策名</th>
                                            <th>目的</th>
                                            <th width="20%">印刷</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>平成 30 年 5月 12日</td>
                                            <td><a href="company_detail.php">株式会社サムライ</a></td>
                                            <td>確認</td>
                                            <td><button type="button" class="btn btn-primary">出力する</button></td>
                                        </tr>
                                    </tbody>
                                </table> 
                                <div class="btn-right-mail">
                                    <a class="btn-add pull-right" href="#" onclick="return false;">
                                        <i class="fa fa-envelope"></i><span>登録メール送信</span>
                                    </a>
                                </div>
                                <p class="com-hd">資料作成日　　<span class="date-info">平成 30 年 06 月 01 日</span> <span class="badge badge-warning">必須</span>　</p>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">提案施策</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">資料内容確認</a></li>
                                </ul>
                                <div class="tab-content list-rows smr comdt">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <table class="table table-bordered com-table33">
                                            <thead>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td width="20%">作成日</td>
                                                    <th>施策名</th>
                                                    <th width="20%">目的</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" value="">
                                                        </label>
                                                    </div></td>
                                                    <td>平成 30 年 5月 12日</td>
                                                    <td><a href="company_detail.php">株式会社サムライ</a></td>
                                                    <td>
                                                        <select class="form-control">
                                                            <option value="">設定なし</option>
                                                            <option value="">訪問営業</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" value="" checked="checked">
                                                        </label>
                                                    </div></td>
                                                    <td>平成 30 年 5月 12日</td>
                                                    <td><a href="company_detail.php">株式会社サムライ</a></td>
                                                    <td>
                                                        <select class="form-control">
                                                            <option value="">設定なし</option>
                                                            <option value="" selected="selected">訪問営業</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table> 
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary">資料を作成する</button>
                                        </div>

                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <div class="page-company">
                                            <p class="dt-date">平成 30 年 5月 12日</p>
                                            <p class="main-hd">熊谷市企業立地奨励金制度について</p>
                                            <hr>
                                            <p class="dt-text2">「熊谷市企業の立地及び拡大の支援に関する条例」は、産業の振興と雇用の促進を図り、そのことによって市民生活の安定向上に役立つため、事業所の新設等に対し奨励金を交付するものです。ぜひご活用ください。</p>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p class="dt-hd">対象者の詳細</p>
                                                    <p class="dt-text">とちぎヘルスケア産業フォーラム又はとちぎロボットフォーラムの会員であって、県内に事業所を有する（新たに設置する場合も含む）中小企業者又は中小企業団体</p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p class="dt-hd">支援内容</p>
                                                    <p class="dt-text">資金使途】ヘルスケア関連産業又はロボット関連産業分野に係る研究開発、製造、販路開拓等の事業実施に係る運転資金及び設備資金
    【融資利率】
    　信用保証協会の保証付き
    　　年 1.9％以内（責任共有制度対象）
    　　年 1.7％以内（責任共有制度対象外）
    　保証なし　年 2.2％以内
    【融資期間】
    　運転資金　5年以内（うち据置1年以内）
    　設備資金　10年以内（うち据置1年以内）
    　（建物の場合は据置2年以内）</p>
                                                </div> <!-- end .col-xs-6 -->
                                                <div class="col-xs-12">
                                                    <p class="dt-hd">支援規模</p>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <p class="dt-text">資金使途】ヘルスケア関連産業又はロボット関連産業分野に係る研究開発、製造、販路開拓等の事業実施に係る運転資金及び設備資金
    【融資利率】
    　信用保証協会の保証付き
    　　年 1.9％以内（責任共有制度対象）
    　　年 1.7％以内（責任共有制度対象外）
    　保証なし　年 2.2％以内
    【融資期間】
    　運転資金　5年以内（うち据置1年以内）
    　設備資金　10年以内（うち据置1年以内）
    　（建物の場合は据置2年以内）</p>
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="tdhead" style="width: 25%">下限</td>
                                                                        <td>0</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdhead">上限</td>
                                                                        <td>100000000</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdhead">助成率</td>
                                                                        <td>0</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div> <!-- end .col-xs-6 -->
                                                    </div> <!-- end .row -->
                                                </div> <!-- end .col-xs-12 -->
                                                <div class="col-xs-6">
                                                    <p class="dt-hd">募集期間</p>
                                                    <p class="dt-text">平成30年4月1日～平成31年3月31日</p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p class="dt-hd">対象期間</p>
                                                    <p class="dt-text">平成30年4月1日～平成31年3月31日</p>
                                                </div>
                                                <div class="col-xs-6">
                                                    <p class="dt-hd">お問い合せ</p>
                                                    <p class="dt-text">栃木県産業労働観光部経営支援課金融担当
    電話　028-623-3181
    ※県内金融機関にお申し込みいただきます。</p>
                                                </div>
                                            </div> <!-- end .row -->
                                        </div> <!-- end .page-company -->

                                    </div>
                                </div>
                                
                            </div> <!-- end .col-xs-12 -->
                        </div> <!-- end .row -->

                        
                    </div> <!-- end .col-xs-12 -->
                </div> 
                <!-- end .row -->
            </div>
            <!-- end .container -->
        </main>
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>

    </body>
</html>
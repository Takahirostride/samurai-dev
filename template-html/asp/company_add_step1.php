<?php include ('./inc/header2.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="com-hd">株式会社サムライ　様</p>
                        <div class="step-div">
                            <span class="active">基本情報</span>
                            <span class="" onclick="window.location.href='company_add_step2.php';">助成金・補助金情報</span>
                            <span class="" onclick="window.location.href='company_add_step3.php';">党則・利用状況</span>
                            <span class="" onclick="window.location.href='company_add_step4.php';">資料</span>
                        </div>
                        <p>現在、企業が取得している助成金・補助金情報の一覧です。施策名をクリックすると、施策の詳細情報をみることができます。</p>
                        <p class="com-hd">会社概要</p>
                        <form>
                            <table class="table table-bordered com-table">
                                <tbody>
                                    <tr>
                                        <td class="thead">取引先番号</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">企業名</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">フリガナ</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">法人番号</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">代表者名</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">メールアドレス</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">会社 URL</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">住所</td>
                                        <td>
                                            <div class="row mrg-bot-10">
                                                <div class="col-xs-2"><input type="text" class="form-control" value=""></div>
                                                <div class="span-middle-text"><span>-</span></div>
                                                <div class="col-xs-2"><input type="text" class="form-control" value=""></div>
                                            </div>
                                            <div class="row mrg-bot-10"><div class="col-xs-4"><input type="text" class="form-control" value=""></div></div>
                                            <div class="row mrg-bot-10"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                            <div class="row mrg-bot-10"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">会社 URL</td>
                                        <td>
                                            <table class="table" id="com-url-table" style="width: 50%">
                                                <tr>
                                                    <td><select name="" class="form-control">
                                                    <option value="">select</option>
                                                </select></td>
                                                </tr>
                                                <tr>
                                                    <td><select name="" class="form-control">
                                                    <option value="">select</option>
                                                </select></td>
                                                </tr>
                                            </table>
                                            <a class="btn-add" href="#" onclick="add_com();return false;">
                                                <i class="fa fa-plus"></i><span>追加する</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">カテゴリー</td>
                                        <td>
                                            <table class="table" id="cat-table" style="width: 60%">
                                                <tr>
                                                    <td style="width: 50%"><select name="" class="form-control">
                                                        <option value="">カテゴリー</option>
                                                    </select></td>
                                                    <td><select name="" class="form-control">
                                                        <option value="">カテゴリー</option>
                                                    </select></td>
                                                </tr>
                                            </table>
                                            <a class="btn-add" href="#" onclick="add_cat();return false;">
                                                <i class="fa fa-plus"></i><span>追加する</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">設立年月</td>
                                        <td>
                                            <div class="row mrg-bot-10">
                                                <div class="col-xs-2"><input type="text" class="form-control" value=""></div>
                                                <div class="span-middle-text"><span>年</span></div>
                                                <div class="col-xs-2"><input type="text" class="form-control" value=""></div>
                                                <div class="span-middle-text"><span>月</span></div>
                                                <div class="col-xs-2"><input type="text" class="form-control" value=""></div>
                                                <div class="span-middle-text"><span>日</span></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">資本金</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">社員数　　（正社員）</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div><div class="span-middle-text"><span>人</span></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">（バイト・派遣）</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div><div class="span-middle-text"><span>人</span></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">採用予定数　（正社員）</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div><div class="span-middle-text"><span>人</span></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">（バイト・派遣）</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div><div class="span-middle-text"><span>人</span></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">正社員化の予定数</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div><div class="span-middle-text"><span>人</span></div></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="thead">60 際</td>
                                        <td>
                                            <div class="row"><div class="col-xs-6"><input type="text" class="form-control" value=""></div><div class="span-middle-text"><span>人</span></div></div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </form> <!-- end form -->
                        <p class="com-hd">会社資料</p>
                        <div class="com-btn-list">
                            <div class="com-item">
                                <a href="#" onclick="return false;"></a>
                                <i class="fa fa-file-contract"></i>
                                <p>資料①</p>
                            </div>
                            <div class="com-item">
                                <a href="#" onclick="return false;"></a>
                                <i class="fa fa-folder"></i>
                                <p>資料②</p>
                            </div>
                            <div class="com-item">
                                <a href="#" onclick="return false;"></a>
                                <i class="fa fa-chart-line"></i>
                                <p>資料③</p>
                            </div>
                            <div class="com-item">
                                <a href="#" onclick="return false;"></a>
                                <i class="fa fa-folder"></i>
                                <p>資料④</p>
                            </div>
                            <div class="com-item">
                                <a href="#" onclick="return false;"></a>
                                <i class="fa fa-file-contract"></i>
                                <p>資料⑤</p>
                            </div>
                        </div>
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
        <script type="text/javascript">
            var add_com = function() {
                html = '<tr><td><select name="" class="form-control"><option value="">select</option></select></td></tr>';
                $('#com-url-table').append(html);
            }
            var add_cat = function() {
                html = '<tr><td style="width: 50%"><select name="" class="form-control"><option value="">カテゴリー</option></select></td><td><select name="" class="form-control"><option value="">カテゴリー</option></select></td></tr>';
                $('#cat-table').append(html);
            }
        </script>
    </body>
</html>
<?php include ('./inc/header2.php'); ?>
            <div class="container">
                <div class="row">
                        <div class="staff-submenu">
                            <ul class="s-submenu">
                                <li class="active"><a href="">すべて</a></li>
                                <li class=""><a href="">担当者 1</a></li>
                                <li class=""><a href="">担当者 2</a></li>
                                <li class=""><a href="">担当者 3</a></li>
                                <li class=""><a href="">担当者 4</a></li>
                                <li class=""><a href="">担当者 5</a></li>
                                <li class=""><a href="">担当者 6</a></li>
                            </ul>
                        </div>
                    
                        <div class="staff-submenu-1">
                            <ul class="s-submenu-1">
                                <li class=""><a href="staff.php">企業を探す</a>
                                    <ul>
                                        <li><a href="staff_saved.php">保存リストを見る</a></li>
                                        <li><a href="staff_history.php">履歴を見る</a></li>
                                    </ul>
                                </li>
                                <li class=""><a href="find_policy.php">施策を探す</a>
                                    <ul>
                                        <li><a href="policy_saved.php">保存リストを見る</a></li>
                                        <li><a href="policy_history.php">履歴を見る</a></li>
                                    </ul>
                                </li>
                                <li class="active"><a href="register_samurai.php">samurai 登録を依頼する</a>
                                    <ul>
                                        <li><a href="samurai_saved.php">保存リストを見る</a></li>
                                        <li><a href="samurai_history.php">履歴を見る</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                </div> <!-- end .row -->
                <div class="row">
                    <div class="col-xs-2">
                        <div class="sidebar-widget">
                            <h3 class="sidebar-hd">業種</h3>
                            <ul class="sidebar-cat">
                                <li><a href="#">雇用・人材</a></li>
                                <li><a href="#">経営改善・販路開拓</a></li>
                                <li><a href="#">設備導入・研究開発</a></li>
                                <li><a href="#">創業・起業</a></li>
                                <li><a href="#">特許・知的財産</a></li>
                                <li><a href="#">経営環境改善</a></li>
                            </ul>
                        </div> <!-- end .sidebar-widget -->

                        <div class="sidebar-widget">
                            <h3 class="sidebar-hd">所在地</h3>
                            <select name="" id="input" class="form-control">
                                <option value="">全国</option>
                                <option value="">全国</option>
                                <option value="">全国</option>
                            </select>
                        </div> <!-- end .sidebar-widget -->

                        <div class="sidebar-widget">
                            <h3 class="sidebar-hd">カテゴリー</h3>
                            <select name="" id="input" class="form-control">
                                <option value="">雇用・人材</option>
                                <option value="">全国</option>
                                <option value="">全国</option>
                            </select>
                        </div> <!-- end .sidebar-widget -->
                        
                    </div> <!-- end .col-sm-2 -->
                    <div class="col-xs-10">
                        <p class="list-heading">samurai登録企業一覧（保存リスト）<span>1000件　（1件～25件表示）</span></p>
                        <div class="list-checkall">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="" id="checkall">
                                    すべて選択
                                </label>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setting-modal">送信</button>
                            </div>

                        </div>
                        <div class="list-rows smr">
                            <div class="row">
                                <div class="p-item">
                                    <div class="col-xs-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <img src="../assets/images/agency-list-03.jpg" alt="">
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="text-desc">当事務所では、雇用・人材、経営改善、創業・起業などの助成金取得の100件以上の実績があります。 お客様が、どの助成金取得が可能か、どのような書類が必要かなど、どんな質問でもご気軽にお問い合わせください。 スタッフ一同親身に対応させていただきますので、よろしくお願い致します。</p>
                                        <div class="meta-top">
                                            <div class="item-half">住所 : 〒141-0031東京都品川区西五反田2-25-1</div>
                                            <div class="item-half">email: info@grand2.com</div>
                                        </div>
                                    </div> <!-- end .col-xs-8 -->
                                    <div class="col-xs-2 list-right-item">
                                        <button type="button" class="btn btn-warning">お気に入り</button>
                                        <button type="button" class="btn btn-primary">詳細</button>
                                    </div>
                                    <div class="col-xs-12 pitem-meta-bottom">
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step1.php';">基本情報</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step2.php';">助成金・補助金情報</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step3.php';">samurai 登録</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step4.php';">資料</button>
                                        <div class="bt-right">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setting-modal">送信</button>
                                            <p class="text-right">前回の送信日：2018年5月21日</p>
                                        </div>
                                    </div>
                                </div> <!-- end .p-item -->
                                <div class="p-item">
                                    <div class="col-xs-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <img src="../assets/images/agency-list-03.jpg" alt="">
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="text-desc">当事務所では、雇用・人材、経営改善、創業・起業などの助成金取得の100件以上の実績があります。 お客様が、どの助成金取得が可能か、どのような書類が必要かなど、どんな質問でもご気軽にお問い合わせください。 スタッフ一同親身に対応させていただきますので、よろしくお願い致します。</p>
                                        <div class="meta-top">
                                            <div class="item-half">住所 : 〒141-0031東京都品川区西五反田2-25-1</div>
                                            <div class="item-half">email: info@grand2.com</div>
                                        </div>
                                    </div> <!-- end .col-xs-8 -->
                                    <div class="col-xs-2 list-right-item">
                                        <button type="button" class="btn btn-warning">お気に入り</button>
                                        <button type="button" class="btn btn-primary">詳細</button>
                                    </div>
                                    <div class="col-xs-12 pitem-meta-bottom">
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step1.php';">基本情報</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step2.php';">助成金・補助金情報</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step3.php';">samurai 登録</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step4.php';">資料</button>
                                        <div class="bt-right">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setting-modal">送信</button>
                                            <p class="text-right">前回の送信日：2018年5月21日</p>
                                        </div>
                                    </div>
                                </div> <!-- end .p-item -->
                                <div class="p-item">
                                    <div class="col-xs-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <img src="../assets/images/agency-list-03.jpg" alt="">
                                    </div>
                                    <div class="col-xs-7">
                                        <p class="text-desc">当事務所では、雇用・人材、経営改善、創業・起業などの助成金取得の100件以上の実績があります。 お客様が、どの助成金取得が可能か、どのような書類が必要かなど、どんな質問でもご気軽にお問い合わせください。 スタッフ一同親身に対応させていただきますので、よろしくお願い致します。</p>
                                        <div class="meta-top">
                                            <div class="item-half">住所 : 〒141-0031東京都品川区西五反田2-25-1</div>
                                            <div class="item-half">email: info@grand2.com</div>
                                        </div>
                                    </div> <!-- end .col-xs-8 -->
                                    <div class="col-xs-2 list-right-item">
                                        <button type="button" class="btn btn-warning">お気に入り</button>
                                        <button type="button" class="btn btn-primary">詳細</button>
                                    </div>
                                    <div class="col-xs-12 pitem-meta-bottom">
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step1.php';">基本情報</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step2.php';">助成金・補助金情報</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step3.php';">samurai 登録</button>
                                        <button type="button" class="btn btn-default" onclick="window.location.href='company_add_step4.php';">資料</button>
                                        <div class="bt-right">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setting-modal">送信</button>
                                            <p class="text-right">前回の送信日：2018年5月21日</p>
                                        </div>
                                    </div>
                                </div> <!-- end .p-item -->
                            </div> <!-- end .list-rows -->
                    </div> <!-- end .list-pages -->
                </div>
                <!-- end .row -->
            </div>
            <!-- end .container -->
        </main>
        <div class="modal fade" id="setting-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        20件の企業にsamurai 登録案内メールを送信します<br>宜しいですか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">送信する</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
        <script type="text/javascript">
            $('#checkall').click(function(event) {
                if($(this).is(':checked')) {
                    $('.p-item').find('input[type="checkbox"]').prop('checked', true);
                } else {
                    $('.p-item').find('input[type="checkbox"]').prop('checked', false);
                }
                
            });
        </script>
    </body>
</html>
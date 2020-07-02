<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">支払い管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">支払い管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-10 mainpage">
                <div class="col-sm-12 clientjob-tab mb20">
                    <div class="row">
                        <ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey active">
                                <a href="mypage/agencypayment-1.php">入出金履歴</a>
                            </li>                                     
                            <li class="tab-style-grey">
                                <a href="mypage/agencypayment-2.php">支払管理</a>
                            </li> 
                            <li class="tab-style-grey">
                                <a href="mypage/agencypayment-3.php">出金管理</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                            <select class="form-control">
                                <option value="0" selected="selected">すべて</option>
                                <option value="1">入金</option>
                                <option value="2">出金</option>
                            </select>
                    </div>
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-2">
                        <div class="mglr-sp-15">
                            <select class="form-control">
                                <option value="2020" selected="selected">2020年</option>
                                <option value="2019">2019年</option>
                                <option value="2018">2018年</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="mglr-sp-15">
                            <select class="form-control">
                                <option value="0" selected="selected">月はすべて</option>                                 
                                <option value="1">1月</option>                                 
                                <option value="2">2月</option>  
                                <option value="3">3月</option>  
                                <option value="4">4月</option>  
                                <option value="5">5月</option>  
                                <option value="6">6月</option>  
                                <option value="7">7月</option>  
                                <option value="8">8月</option>              
                                <option value="9">9月</option>  
                                <option value="10">10月</option>  
                                <option value="11">11月</option>  
                                <option value="12">12月</option>  
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mgt-20">
                        <table class="table table-bordered table-hover" style="margin-bottom: 20px"> 
                            <thead class="div-style-blue2"> 
                                <tr> 
                                    <th >番号</th> 
                                    <th >日付</th> 
                                    <th >概要</th>
                                    <th >入金</th> 
                                    <th >出金</th> 
                                    <th >残高</th> 
                                    <th >状況</th> 
                                </tr>                                 
                            </thead>                             
                            <tbody> 
                                <tr>
                                    <td>27256712</td> 
                                    <td>2018年04月26日</td> 
                                    <td>出口gura, 足立区就業規則作成助成金</td> 
                                    <td><span>2000</span>円</td>
                                    <td></td>
                                    <td></td>
                                    <td>エスクロー</td>
                                </tr>                           
                            </tbody>
                        </table>
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
<?php include ('../inc/footer.php'); ?>
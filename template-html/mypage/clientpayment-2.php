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
                            <li class="tab-style-grey">
                                <a href="mypage/agencypayment-1.php">入出金履歴</a>
                            </li>                                     
                            <li class="tab-style-grey active">
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
                        <table class="table table-bordered table-hover"> 
                            <thead class="div-style-blue2"> 
                                <tr> 
                                    <th class="w5"></th> 
                                    <th class="w10">番号</th> 
                                    <th class="w10">日付</th>
                                    <th class="w30">概要</th> 
                                    <th class="w15">名目</th> 
                                    <th class="w20">金額</th> 
                                    <th class="w10">状況</th> 
                                </tr>                                 
                            </thead>                             
                            <tbody> 
                                <tr>
                                    <td class="text-center"><label><input type="checkbox" name="option[]" class="check"></label></td>
                                    <td></td> 
                                    <td></td> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr> 
                                <tr>
                                    <td class="text-center"><label><input type="checkbox" name="option[]" class="check"></label></td>
                                    <td></td> 
                                    <td></td> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>  
                                <tr>
                                    <td class="text-center"><label><input type="checkbox" name="option[]" class="check"></label></td>
                                    <td></td> 
                                    <td></td> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>  
                                <tr>
                                    <td class="text-center"><label><input type="checkbox" name="option[]" class="check"></label></td>
                                    <td></td> 
                                    <td></td> 
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>                           
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12 box-agen-green mb20">
                    <p>下記より、お支払い画面に進み、支払を完了してください。<br>
                        ※着手金の支払いの場合、支払い完了すると、業務を開始することができます。</p>
                    <p class="text-center"><button id="click-btn" class="btn-primary btn btn-style-shadow-green btn-success">選択した料金を支払う</button></p>
                </div>
			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>
<script type="text/javascript">
    $('#click-btn').click(function(){
        var group_checkbox =  $("input[name='option[]']:checked");
        if(group_checkbox.length == 0){
            alert("一つ以上の士業を選択してください。");
        }else{

        }
    })
</script>
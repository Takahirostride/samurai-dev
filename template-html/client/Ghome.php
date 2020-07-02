<?php include ('../inc/header.php'); ?>
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
                                <a  href="client/Glist.php" class="btn btn-success  btn-style-shadow-green change-pos" >施策を選択する</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <form method="post" action="" enctype="multipart/form-data">
                            <p class="text-step "><b><span>STEP2</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;募集内容を入力します。</b></p>
                            <table class="table none-over-table table-bordered ghome-table"> 
                                <tbody> 
                                    <tr> 
                                        <td rowspan="1" class="div-style-blue2 text-primary vali-icon">
                                            <b>募集タイトル</b>
                                            <button type="button" class="btn-primary bg-red" disabled="">必須</button>
                                        </td>                                     
                                        <td colspan="2">
                                            <input type="text" name="lname" aria-invalid="false">
                                        </td>                                     
                                    </tr>
                                    <tr> 
                                        <td rowspan="1" class="div-style-blue2 text-primary vali-icon"> 
                                            <b>目的</b>
                                            <button type="button" class="btn-primary bg-red" disabled="">必須</button>
                                        </td>                                     
                                        <td colspan="2">
                                            <textarea rowspan="5" name="lname" class="textarea-1" aria-invalid="false"></textarea>
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td rowspan="1" class="div-style-blue2 text-primary vali-icon">
                                            <b>重視する点</b>
                                            <button type="button" class="btn-primary" disabled=""> 任意</button>
                                        </td>                                     
                                        <td colspan="2">
                                            <div class="col-sm-3">
                                                <label><input class="control-label" type="checkbox" > 予算 </label>
                                                <br>
                                                <label><input class="control-label" type="checkbox" > 実績評価</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><input class="control-label" type="checkbox" > 納期 </label>
                                                <br>
                                                <label><input class="control-label" type="checkbox" > 取得確率</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><input class="control-label" type="checkbox" > こまめな連絡 </label>
                                                <br>
                                                <label><input class="control-label" type="checkbox" > 手離れの良さ</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><input class="control-label" type="checkbox" > クオリティー</label> 
                                                <br> 
                                                <label><input class="control-label" type="checkbox" > その他</label>
                                            </div>
                                        </td>                                     
                                    </tr>
                                    <tr> 
                                        <td rowspan="1" class="div-style-blue2 text-primary vali-icon">
                                            <b>補足説明</b>
                                            <button type="button" class="btn-primary" disabled="">任意</button>
                                        </td>                                     
                                        <td colspan="2">
                                            <textarea rowspan="5" name="lname" class="textarea-1" aria-invalid="false"></textarea>
                                        </td>                                     
                                    </tr>
                                    <tr>
                                        <td class="div-style-blue2 text-primary vali-icon">
                                            <b>添付ファイル</b>
                                            <button type="button" class="btn-primary" disabled="">任意</button>
                                        </td>
                                        <td class="pd0">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="line-btn">
                                                        <div class="col-md-10">
                                                        <input class="form-control filenamed" id="focusedInput1" value="" type="text" disabled="">
                                                        <input class="hidefile1" type="file" data-showname="filenamed" name="filename1" id="filename1">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="submit-delete-button" data-del="focusedInput1"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="line-btn">
                                                        <div class="col-md-10">
                                                        <input class="form-control filenamed" id="focusedInput2" value="" type="text" disabled="">
                                                        <input class="hidefile1" type="file" data-showname="filenamed" name="filename2" id="filename2">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="submit-delete-button" data-del="focusedInput2"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="line-btn">
                                                        <div class="col-md-10">
                                                        <input class="form-control filenamed" id="focusedInput3" value="" type="text" disabled="">
                                                        <input class="hidefile1" type="file" data-showname="filenamed" name="filename3" id="filename3">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="submit-delete-button" data-del="focusedInput3"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="line-btn">
                                                        <div class="col-md-10">
                                                        <input class="form-control filenamed" id="focusedInput4" value="" type="text" disabled="">
                                                        <input class="hidefile1" type="file" data-showname="filenamed" name="filename4" id="filename4">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="submit-delete-button" data-del="focusedInput4"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="line-btn">
                                                        <div class="col-md-10">
                                                        <input class="form-control filenamed" id="focusedInput5" value="" type="text" disabled="">
                                                        <input class="hidefile1"  type="file" data-showname="filenamed" name="filename5" id="filename5">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" class="submit-delete-button" data-del="focusedInput5"><i class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row box-drop">
                                                    <div id="dropbox" class="dropbox" ng-class="dropClass"><span>
                                                    <img src="assets/images/fileupload.png"></span>
                                                    <p>アップロードする場合は、ここに ドラッグ＆ドロップしてください。</p>
                                                    <input class="hidefile1" type="file" data-showname="filenamed" name="filename" multiple >
                                                </div>
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td rowspan="1" class="div-style-blue2 text-primary vali-icon">
                                            <b>募集の締め切り</b>
                                            <button type="button" class="btn-primary " disabled="">必須</button>
                                        </td>                                     
                                        <td>
                                           <div class="datepickertoday" id="datepicker1"></div>
                                        </td>                                     
                                    </tr>
                                </tbody>
                            </table>
                            <p class="text-step "><b><span>STEP3</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;希望内容・予算を設定します。</b></p>
                            <table class="table none-over-table table-bordered ghome-table" > 
                                <tbody> 
                                    <tr> 
                                        <td rowspan="1" class="div-style-blue2 text-primary vali-icon">
                                            <b>依頼業務</b>
                                            <button type="button" class="btn-primary" disabled="">必須</button>
                                        </td>                                     
                                        <td colspan="2">
                                            <div class="row mgtb-10" >
                                                <div class="col-sm-3">
                                                    <label><input type="checkbox" aria-invalid="false">&nbsp;&nbsp;&nbsp;設定しない</label>
                                                </div>
                                            </div>
                                            <div class="row mgtb-10">
                                                <div class="col-sm-2">
                                                    <label><input class="control-label checkdis" type="checkbox" data-tgdis="other3"  aria-invalid="false">&nbsp;&nbsp;&nbsp;書類作成費用</label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="other3" class="form-control" placeholder="書類作成費用"  disabled="disabled" aria-invalid="false">
                                                        <span class="form-control-feedback">円以下</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mgtb-10">
                                                <div class="col-sm-2">
                                                    <label><input class="control-label checkdis1" data-tgdis="other2" type="checkbox" aria-invalid="false">&nbsp;&nbsp;&nbsp;  申請代行費用</label>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="col-sm-3">
                                                        <label for="op4" ><input id="op4" type="radio" name="gender" class="other2" value="1" disabled="disabled" aria-invalid="false">&nbsp;&nbsp;&nbsp;成果報酬0%以下</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="op5"><input id="op5" type="radio" name="gender" value="2" class="other2" disabled="disabled" aria-invalid="false">&nbsp;&nbsp;&nbsp;成果報酬20%以下</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="op6"><input id="op6" type="radio" name="gender" value="3" class="other2"  disabled="disabled" aria-invalid="false">&nbsp;&nbsp;&nbsp;成果報酬30%以下</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label for="op7"><input id="op7" type="radio" name="gender" value="4" class="other2"  disabled="disabled" aria-invalid="false">&nbsp;&nbsp;&nbsp;成果報酬40%以下</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mgtb-10">
                                                <div class="col-sm-2">
                                                    <label><input class="control-label checkdis" data-tgdis="other1" type="checkbox" aria-invalid="false">&nbsp;&nbsp;&nbsp;   その他</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="other1" class="form-control" placeholder="その他費用" disabled="disabled" aria-invalid="false">
                                                        <span class="form-control-feedback">円以下</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>                                     
                                    </tr>
                                    <tr> 
                                        <td rowspan="1" class="div-style-blue2 text-primary vali-icon">
                                            <b>着手金</b>
                                            <button type="button" class="btn-primary" disabled="">必須</button>
                                        </td>                                     
                                        <td colspan="2">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <label for="op1"><input id="op1" class="control-label other4" type="radio" value="1" name="startbalance" aria-invalid="false">&nbsp;&nbsp;&nbsp;設定しない</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="op2"><input id="op2" class="control-label other4" type="radio" value="2" name="startbalance" aria-invalid="false">&nbsp;&nbsp;&nbsp;着手なし</label>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="op3"><input id="op3" class="control-label other4" type="radio" value="3" name="startbalance" aria-invalid="false">&nbsp;&nbsp;&nbsp;着手金</label>
                                                </div>
                                                <div class="col-sm-4 ">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" class="form-control" id="other4" placeholder="着手金" disabled="disabled" aria-invalid="false">
                                                        <span class="form-control-feedback">円以下</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>                                     
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row text-center mb20">
                                <button type="button" class="btn btn-success btn-style-shadow-green mgr-15">内容を確認する</button>
                                <button class="btn btn-default btn-style-shadow-grey" type="button">下書き保存</button>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>
<script type="text/javascript">
    $(".check-option").click(function(){
        var pos = $(this).attr("pos");
        pos = pos * 50;
        console.log(pos);
        $(".change-pos").css('margin-top', pos+"px" );
    })

    $('.checkdis1').click(function(){
        var isDisabled = $('.other2').is(':disabled');
            if (isDisabled) {
                $('.other2').prop('disabled', false);
            } else {
                $('.other2').prop('disabled', true);
            }
    });
    $(".other4").click(function(){
        var check = $(this).attr("id");
        if(check == "op3"){
           $('#other4').prop('disabled', false);
        } else {
            $('#other4').prop('disabled', true);
        }
    })
    $('.submit-delete-button').click(function(){
            var id_del = $(this).attr("data-del");
            $("#"+id_del).val("");
    })

    $(document).on('change', '.hidefile1', function(){
        var obj = $(this);
        //console.log(obj['0'].files);
        var count = obj['0'].files.length;
        if(count > 5){
            alert("アップロードできるファイルは５個までです。");
        }
        for (var i = 0; i < 5; i++) {
            for (var j = 1; j <= 5; j++) {
               if($("#focusedInput"+j).val() == ""){
                    $("#focusedInput"+j).val(obj['0'].files[i]["name"]);
                    break;
               }
            }
        }
    });
    $('.hidefile1').on({
        'dragover dragenter': function(e) {
            $(this).closest('.dropbox').css('background-color', '#15b86c80');
        },
        drop: function(e) {
            $(this).closest('.dropbox').css('background-color', '#fff');
        }
    });
</script>

@extends('layouts.home')
@section('style')
	@include('Agency::Cpage.cadd_style')
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '施策登録'])
			</div>
		</div>
		<div class="row">
	        <div class="col-sm-12">
	            <p class="text-step "><b><span>STEP1</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;対応可能施策情報の選択</b></p>
	        </div>
	    </div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<h3 class="mpage-title">リスト一覧</h3>
				<p><a href="{{url('agency/Csubsidylist?type=0')}}" class="btn btn-default sidebar-btn btn-grad">
						<strong>提案を検討リスト</strong>
					</a></p>
				<p><a href="{{url('agency/Csubsidylist?type=1')}}" class="btn btn-default btn-grad sidebar-btn @if(request()->type==1) active @endif">
						<strong>興味リスト</strong>
					</a></p>
				<p><a href="{{url('agency/Csubsidylist?type=2')}}" class="btn btn-default btn-grad sidebar-btn @if(request()->type==2) active @endif">
						<strong>非表示リスト</strong>
					</a></p>
			</div> <!-- end .sidebar-left -->
			<div class="col-sm-10 mainpage">
				<div class="col-sm-12 div-style-blue2">
			        <div class="row">     
			            <div class="col-sm-12 pd20-30">
				            <label> 
				                <input class="control-label" type="radio" id="option1" name="addway"> 登録されている施策の中から選択する  
				            </label>
				            <br> 
				            <label> 
				                <input class="control-label" type="radio" id="option2" name="addway" value="2" checked>SAMURAIに登録されていない施策を登録する        
				            </label>
			            </div>
			        </div>
		        </div>
		        <div class="col-sm-12">
		        <div class="row div-style-yellow2">
		            <p><b>SAMURAIに掲載されていない施策を登録していただくと、事業者が閲覧できる、「士業掲示板」に掲載されます。　「士業掲示板」はSAMURAIに掲載されて
		                いない施策情報一覧ですが、その施策情報の士業掲載欄には、御社のみが表示されるため、マッチングの可能性が高くなります。</b></p>
		        </div>
		        </div>
		        <div class="row subsidy-list">
					<div class="col-sm-12">
					@include('partials.admin.notify')	
{!! Form::open(['route'=>['agency.cadd.store'],'enctype'=>"multipart/form-data",'class'=>'fr-validator']) !!}
<table class="table table-bordered dtable table-condensed">
	<tbody>
		<tr>
            <td class="div-style-blue2 text-primary vali-icon"><b>登録機関</b></td>
            <td >
                <div class="row">
                    <div class="col-md-4"> 
                    	<div class="form-group">                   	
                        	<div class="angularsl">                        	
							{!! Form::selectMinitry('minitry_id',null,['required','data-error'=>'必須']) !!}							
							</div>
							<div class="help-block with-errors"></div>
						</div>						
                    </div>
                    <div class="col-md-4"> 
                    	<div class="form-group">                   	
	                    	<div class="angularsl">	                       		
								{!! Form::selectSubMinitry('sub_minitry_id',null,['required','data-error'=>'必須']) !!}								
							</div>
							<div class="help-block with-errors"></div>
						</div>	
                    </div>
                </div>
            </td>
        </tr>
        <tr>
		    <td class="div-style-blue2 text-primary vali-icon"><b>画像</b></td>
		    <td >
		        <div class="input-group file-group col-md-8">
		            <input type="text" id="img-name" name="image_name" class="form-control" disabled="" aria-invalid="false">
		            <div class="help-block with-errors"></div>
		            <div class="input-group-btn">
		                <label class="btn btn-success btn-style-shadow-green" id="btn-load-file" for="file">参照</label>
		                <input id="file" type="file" name="file_image_id" accept="image/*">
		            </div>		            
		        </div>
		    </td>
		</tr>
		<tr>
		    <td rowspan="1" class="div-style-blue2 text-primary">
		        <b>カテゴリー<br><br>
		            （登録施策に該当するカテゴリーを選択してください。1つ以上選択する必要があります。）</b>
		    </td>
		    <td colspan="2">
		        <div class="sel-cats">
	                <div id="cat_sel" class="oladd-block">
	                    <div class="results"></div>
	                    <div class="controls">
	                        <div class="gridcell-right mb20">
	                        <div class="row">
	                            <div class="col-md-4">
	                            	<div class="angularsl" id="parent-1">
	                                {!! Form::select('cat_list',[],null,['class'=>'form-control cat-list']) !!}
	                                </div>
	                                <button type="button" class="btn btn-success btn-style-shadow-green ol-add" style="width:100px;">新規追加</button>
	                            </div>
	                        </div>  
	                        </div>                      
	                    </div>
	                </div>	
	                <div class="help-block with-errors"></div>	        	
		        </div>
		    </td>
		</tr>
		<tr>
		  <td class="div-style-blue2 text-primary"><b>タグ</b></td>
		    <td>
		        <div class="row">
                        <div class="tagdonate bl_tags">
                        @foreach ($tags as $k_tag=>$tag)
                            <label class="graybutton" style="width: auto;"><input type="checkbox" name="tags[]" value="{{ $k_tag }}"><span>{{ $tag }}</span></label>
                        @endforeach
                        </div>	
                        <div class="help-block with-errors"></div>	        	
		        </div>
		    </td>
		</tr>
		<tr>
	    <td class="div-style-blue2 text-primary">
	        <b>業種</b>
	    </td>
	    <td colspan="2">
	        <div class="gridcell-right">
	            <div class="col-md-12">
	            	<div class="tagdonate bl_tags">
                        @foreach ($trades as $k_tag=>$tag)
                            <label class="graybutton" style="width: auto;"><input type="checkbox" name="trades[]" value="{{ $k_tag }}"><span>{{ $tag }}</span></label>
                        @endforeach	 
                    </div>               	
	            </div>
	        </div>
	    </td>
	</tr>
	<tr>
    <td rowspan="1" class="div-style-blue2 text-primary">
        <b>対象企業<br><br>
            （登録施策で必須の場合は入力してください。特に条件がない場合は、空欄で構いません。）</b>
    </td>
    <td colspan="2">
        <div class="row">
            <div class="col-sm-2">創業年数</div>
            <div class="col-sm-2"></div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('founding_year_start',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">年</span>
                </div>
            </div>
            <div class="col-sm-1 text-center">~</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('founding_year_end',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">年</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">従業員数</div>
            <div class="col-sm-2">正社員</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('employees_count_start',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
            <div class="col-sm-1 text-center">~</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('employees_count_end',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-2">アルバイト</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('employees_part_count_start',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
            <div class="col-sm-1 text-center">~</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('employees_part_count_end',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-2">60歳以上</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('over_60_count_start',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
            <div class="col-sm-1 text-center">~</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('over_60_count_end',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">採用予定数</div>
            <div class="col-sm-2">正社員</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('hiring_count_start',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
            <div class="col-sm-1 text-center">~</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('hiring_count_end',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-2">アルバイト</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('hiring_byte_count_start',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
            <div class="col-sm-1 text-center">~</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('hiring_byte_count_end',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">人</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">資本金</div>
            <div class="col-sm-2"></div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('capital_start',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">円</span>
                </div>
            </div>
            <div class="col-sm-1 text-center">~</div>
            <div class="col-sm-3">
                <div class="form-group has-feedback">
                    {!! Form::number('capital_end',null,['class'=>'form-control number','min'=>0]) !!}
                    <span class="form-control-feedback">円</span>
                </div>
            </div>
        </div>
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>対象地域</b></td>
    <td colspan="2">
        <div id="region_sel" class="oladd-block">
            <div class="results">
            </div>
            <div class="controls">
                <div class="gridcell-right">
                    <div class="row">
                        <div class="col-md-4">
                        	<div class="angularsl">
                            {!! Form::selectMinitry('province_name',null,['id'=>'province_id_name','data-children'=>'#city_id_name'] ) !!} 
                            </div>                                       
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                        	<div class="angularsl">
                            {!! Form::selectMinitry('city_name',null,['id'=>'city_id_name'] ) !!} 
	                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn mgt-20 button btn-success btn-style-shadow-green ol-add"">新規追加</button>
                    </div>
                </div>                                                       
            </div>                                                 
        </div>    	
    </td>
</tr>
<tr>
<td rowspan="1" class="div-style-blue2 text-primary"><b>最終更新日</b></td>
<td colspan="2">
    <div class="row">
        <div class="col-sm-2 form-group">
            {!! Form::number('update_date[year]',null,['class'=>'form-control number','min'=>2000,'required','data-error'=>'必須']) !!}
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-1 pdt-5">年</div>
        <div class="col-sm-2 form-group">
            {!! Form::number('update_date[month]',null,['class'=>'form-control number','min'=>1,'max'=>12,'required','data-error'=>'必須']) !!}
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-1 pdt-5">月</div>
        <div class="col-sm-2 form-group">
            {!! Form::number('update_date[day]',null,['class'=>'form-control number','min'=>1,'max'=>31,'required','data-error'=>'必須']) !!}
            <div class="help-block with-errors"></div>
        </div>
        <div class="col-sm-1 pdt-5">日</div>
    </div>
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>施策名</b></td>
    <td colspan="2">
    	<div class="form-group">
    		{!! Form::text('name',null,['class'=>'form-control','required','data-error'=>'必須']) !!}
    		<div class="help-block with-errors"></div>
    	</div>
        
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>施策名（サブ）</b></td>
    <td colspan="2">
    	<div class="form-group">
    		{!! Form::text('name_serve',null,['class'=>'form-control','required','data-error'=>'必須']) !!}
    		<div class="help-block with-errors"></div>
    	</div>       
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>目的</b></td>
    <td colspan="2">
        {!! Form::textarea('target',null,['class'=>'form-control']) !!}
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>対象者の詳細</b></td>
    <td colspan="2">
        {!! Form::textareaTiny('info')!!}
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>支援内容</b></td>
    <td colspan="2">
        {!! Form::textareaTiny('support_content',null)!!}
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>取得可能金額設定</b></td>
    <td colspan="2">
        <div class="row">
            <div class="col-md-5">
            	<div class="form-group">
            	<div class="angularsl">
	                  @php
	                      $amounts = config('policy.amount_list');
	                  @endphp            		
	            	<select name="acquire_budget_first" multiple="multiple" data-error='必須' required>
                        @foreach ($amounts as $key=>$ite)
                            <option value="{{ $key }}">{{ $ite }}</option>
                        @endforeach
	            	</select>
            	</div>
            	<div class="help-block with-errors"></div>
            	</div>
            </div>
            <div class="col-md-4">
            	<div class="form-group">
                {!! Form::text('acquire_budget_display',null,['class'=>'form-control','required','data-error'=>'必須']) !!}
                <div class="help-block with-errors"></div>
                </div>            
            </div>
        </div>
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>支援規模</b></td>
    <td colspan="2">
        <div class="col-sm-12">
        	<div class="row">
	            <div class="col-md-4 border-1-a7a7a7">
	                <div class="row">
	                    <p class="text-center">下限</p>
	                </div>
	                <div class="row">
                        <div class="form-group">
                        {!! Form::text('support_scale_lower_limit',null,['class'=>'form-control','pattern'=>"[0-9]+([\.,][0-9]+)*",'required','data-error'=>'必須']) !!}
                        <div class="help-block with-errors"></div>
                        </div>	                	
	                </div>
	            </div>
	            <div class="col-md-4 border-1-a7a7a7">
	                <div class="row">
	                    <p class="text-center">上限</p>
	                </div>
	                <div class="row">
                        <div class="form-group">
                        {!! Form::text('support_scale_upper_limit',null,['class'=>'form-control number','pattern'=>"[0-9]+([\.,][0-9]+)*",'required','data-error'=>'必須']) !!}
                        <div class="help-block with-errors"></div>
                        </div>	                	
	                </div>
	            </div>
	            <div class="col-md-4 border-1-a7a7a7">
	                <div class="row">
	                    <p class="text-center">助成率</p>
	                </div>
	                <div class="row">
                        <div class="form-group">
                        {!! Form::text('support_scale_subsidy_duration',null,['class'=>'form-control','required','data-error'=>'必須']) !!}
                        <div class="help-block with-errors"></div>
                        </div>
	                </div>
	            </div>
            </div>
        </div>
        {!! Form::textareaTiny('support_scale')!!}
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>募集期間</b></td>
    <td colspan="2">
                <div class="gridcell-right">
                    {!! Form::textarea('subscript_duration',null,['class'=>'form-control'])!!}
                </div>
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>対象期間</b></td>
    <td colspan="2">
                <div class="gridcell-right">
                    {!! Form::textarea('object_duration',null,['class'=>'form-control'])!!}
                </div>
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>採択結果</b></td>
    <td colspan="2">
                <div class="gridcell-right">
                    {!! Form::text('adopt_result',null,['class'=>'form-control','require']) !!}
                </div>
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>掲載終了日　<br>（不明な場合は、随時を選択）</b></td>
    <td colspan="2">
        <div class="row">
            <div class="col-sm-2 form-group">
                {!! Form::number('subscript_duration_detail[year]',null,['min'=>2000,'class'=>'form-control','required','data-error'=>'必須']) !!}
                <div class="help-block with-errors"></div>

            </div>
            <div class="col-sm-1 pdt-5">年</div>
            <div class="col-sm-2 form-group">
                {!! Form::number('subscript_duration_detail[month]',null,['min'=>1,'max'=>12,'class'=>'form-control','required','data-error'=>'必須']) !!}
                <div class="help-block with-errors"></div>
            </div>
            <div class="col-sm-1 pdt-5">月</div>
            <div class="col-sm-2 form-group">
                {!! Form::number('subscript_duration_detail[day]',null,['min'=>1,'max'=>31,'class'=>'form-control','required','data-error'=>'必須']) !!}
                <div class="help-block with-errors"></div>
            </div>
            <div class="col-sm-1 pdt-5">日</div>
            <div class="col-sm-3 pdt-5">
            	<label>
                <input type="checkbox" name="subscript_duration_option" aria-invalid="false">随時</label>
            </div>
        </div>
    </td>
</tr>
<tr>
	<td class="div-style-blue2 text-primary"><b>pdf データ</b></td>
	<td class="pd0">
		<div class="row">
        <div class="col-md-5">
            <div class="row">
            	@foreach (range(1,5) as $ite)
	                <div class="line-btn">
	                    <div class="col-md-10">
	                    <input class="form-control filenamed" id="focusedInput{{ $ite }}" value="" type="text" disabled="">
	                    <input class="hidefile1" type="file" data-showname="filenamed" id="filename{{ $ite }}">
	                    </div>
	                    <div class="col-md-1">
	                        <button type="button" class="submit-delete-button" data-del="focusedInput{{ $ite }}"><i class="fa fa-trash-o"></i></button>
	                    </div>
	                </div>
            	@endforeach
            </div>
        </div>
        <div class="col-md-7">
            <div class="row box-drop">
                <div id="dropbox" class="dropbox" ng-class="dropClass"><span>
                <img src="/assets/common/images/fileupload.png"></span>
                <p>アップロードする場合は、ここに ドラッグ＆ドロップしてください。</p>
                <input class="hidefile1" type="file" data-showname="filenamed" name="register_pdf_file[]" multiple="">
            </div>
            </div>
        </div>
        </div>
        @php
            $reg_pdf = array_fill_keys(range(0,2),['name'=>'','url'=>'']);
        @endphp                
        @foreach ($reg_pdf as $k=>$ite) 
        <div class="row">
            <div class="col-sm-12">
            	<div class="line-box-2">
                	<div class="col-md-5 border-right-ddd pd5">
					    <input class="form-control" placeholder="表示ファイル名" aria-invalid="false" name="register_pdf1[{{ $k }}][name]">
					</div>
					<div class="col-md-7 pd5">
                        <input class="form-control" placeholder="登録URL" name="register_pdf1[{{ $k }}][url]">
                    </div>
				</div>
            </div>
        </div>                       
        @endforeach                
    </td>
</tr>
<tr>
    <td rowspan="1" class="div-style-blue2 text-primary"><b>お問い合わせ<br>
		（当該施策の監督省庁などの情報があれば記載ください）</b></td>
    <td colspan="2">
        <div class="form-group">
            {!! Form::textarea('inquiry',null,['class'=>'form-control','required','data-error'=>'必須'])!!}
            <div class="help-block with-errors"></div>
        </div>
    </td>
</tr>
</tbody>
</table> <!-- end table category -->
<div class="clearfix"></div>
<div class="text-center bsearch-btn-s">
	<button type="submit" class="btn btn-success btn-style-shadow-green mgr-15">適用する</button>
       <button class="btn btn-default btn-style-shadow-grey" type="button">下書き保存</button>
</div>
{!! Form::close() !!}
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
				<div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog box-in box-center">
	                  <div class="modal-content box-out">
	                    <div class="row center-div">
	                        <div class="col-sm-12">
	                            <h4>ポップアップ</h4>
	                            <p>
									登録されていない施策を登録する場合には、既に登録されていないかを必ずご確認ください。
									また、登録の際には、本部で確認してから本登録されます。修正、登録、削除をする可能性があります。
									※悪質な登録に関しては、予告なくアカウント停止をさせて頂く場合があります。
	                            </p>
	                            <p class="text-right"><button class="btn btn-style-shadow-grey exit color-bule3" type="button">確認</button></p>
	                        </div>
	                    </div>
	                  </div>
                  </div>
                </div> 
			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
	<script src="{{ asset('assets/common/plugins/bootstrap/js/validator.min.js') }}"></script>
	@include('Agency::Cpage.cadd_script')
@endsection
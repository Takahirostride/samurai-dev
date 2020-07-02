@extends('layouts.home')

@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">アフィリエイト管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">アフィリエイト管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
					@php ($profile_image = $user->image) @endphp
				@else
					@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
				@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
                <div class="col-sm-12 clientjob-tab mb20">
                    <div class="row">
                        <ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey active">
                                <a href="{{URL::route('agency.affiliate')}}">リンク作成</a>
                            </li>                                     
                            <li class="tab-style-grey">
                                <a href="{{URL::route('agency.affiliate.result')}}">成果統計</a>
                            </li> 
                            <li class="tab-style-grey">
                                <a href="{{URL::route('agency.affiliate.register')}}">登録情報</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12">
                        <form action="" method="POST">
                            <table class="table table-bordered tableformtitle">
                                <tbody>
                                    <tr>
                                        <th>アフィリエイトコード</th>
                                        <td>{{$affiliate_url}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered tableformtitle">
                                <tbody id="affiliate-tbody">
                                    <tr>
                                        <th>区分</th>
                                        <td>
                                            <div class="radio-inline col-sm-3">
                                                <label>
                                                    <input type="radio" class="radiochange" name="group" value="0" checked>バナー
                                                </label>
                                            </div>
                                            <div class="radio-inline col-sm-3">
                                                <label>
                                                    <input type="radio" class="radiochange" name="group" value="1">テキスト
                                                </label>
                                            </div>
                                            <div class="radio-inline col-sm-3">
                                                <label>
                                                    <input type="radio" class="radiochange" name="group" value="2">自由テキスト
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>リンク先のURL</th>
                                        <td>{{$affiliate_url}}</td>
                                    </tr>
                                    <tr class="change-aj">
                                        <th rowspan="2" ><p id="title_op">表示バナー</p></th>
                                        <td class="hide_op_2">
                                            <div class="radio-inline col-sm-3">
                                                <label>
                                                    <input type="radio" class="radiochange" name="group1" value="0" checked>企業向け
                                                </label>
                                            </div>
                                            <div class="radio-inline col-sm-3">
                                                <label>
                                                    <input type="radio" class="radiochange" name="group1" value="1">士業向け
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="change-aj hide_group" id="group_1_1">
                                        <td>
                                            <div class="business">
                                            @foreach ($business as $key => $value)
                                            <p>{{$sizearray[$key]}}</p>
                                            <div class="row">
                                                 @foreach ($value['sub'] as $key1 => $value1)
                                                <div class="@if($key == 3) col-sm-12 @else col-sm-4 @endif">
                                                    <img class="thumbnail" id="bu{{$key}}{{$key1}}" src="{{URL::to('/')}}/assets/affiliate/business/{{$bannerdirectory[$key]}}/{{$value1}}" onclick="get_link_img('{{URL::to('/')}}/assets/affiliate/business/{{$bannerdirectory[$key]}}/{{$value1}}','bu{{$key}}{{$key1}}')" alt="">
                                                </div>
                                                @endforeach
                                            </div>
                                            @endforeach
                                            </div>
                                            <div class="agency">
                                                @foreach ($agency as $key => $value)
                                                <p>{{$sizearray[$key]}}</p>
                                                <div class="row">
                                                     @foreach ($value['sub'] as $key1 => $value1)
                                                    <div class="@if($key == 3) col-sm-12 @else col-sm-4 @endif">
                                                        <img class="thumbnail" id="ag{{$key}}{{$key1}}" src="{{URL::to('/')}}/assets/affiliate/agency/{{$bannerdirectory[$key]}}/{{$value1}}" onclick="get_link_img('{{URL::to('/')}}/assets/affiliate/agency/{{$bannerdirectory[$key]}}/{{$value1}}','ag{{$key}}{{$key1}}')" alt="">
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="change-aj hide_group" id="group_1_2">
                                        <td>
                                        <div class="business">
                                            @foreach ($businessmessagearray as $key => $value)
                                                <div style="margin-left: 15px;">
                                                <p class="col-sm-7 text_click" >{{$value}}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="agency">
                                            @foreach ($agencymessagearray as $key => $value)
                                                <div style="margin-left: 15px;">
                                                <p class="col-sm-7 text_click">{{$value}}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                    <td class="hide_group"  id="group_1_3">
                                        <textarea class="form-control" rows="5" name="preview" id="preview"></textarea>
                                    </td>
                                    <tr class="hide_group" id="group_1_2_1">
                                        <th>プレビュー</th>
                                        <td class="add_text">
                                            
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="text-center mgbt-30">
                                <button type="button" id="update_html" class="shadowbuttonsuccess btn btn-success">コード作成</button>
                            </div>
                            <table class="table table-bordered tableformtitle">
                                <tbody>
                                    <tr>
                                        <th>HTMLコード</th>
                                        <td>
                                            <textarea name="content" id="content" class="form-control" rows="5"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div><!-- end .col-sm-12 -->

			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    innit();
    var html_export = ""; 
    var base_url = '{{URL::to('/')}}/{{$affiliate_url}}';
	$('input[name=group1]').on('change',function(){
        innit();
    })
    $('input[name=group]').on('change',function(){
        innit();
    })
    function get_link_img(link, id){
        console.log(link);
        $('.thumbnail').removeClass('checked_img');
        $('#'+id).addClass('checked_img');
        html_export = "<div><a href='"+base_url+"'><img "
        html_export += "src='"+link+"'></a></div>";    
    }
    $('.text_click').click(function(){
        $('.text_click').removeClass('checked_text');
        $(this).addClass('checked_text');
        html_export = "<div><a href='"+base_url+"'>"+$(this).text()+"</a></div>"; 
        text_add ='<a class="table-row ng-binding" style="font-size: 12px;margin-left: 15px;margin-right: 15px;';
        text_add += 'word-break: break-all" href="'+base_url+'">'+$(this).text()+'</a>';
        $('.add_text').html(text_add);
    })
    function innit(){
        var vl = $('input[name=group1]:checked').val();
        var vl1 = $('input[name=group]:checked').val();
        console.log(vl1);
        if(vl == 0){
            $('.business').show();
            $('.agency').hide();
        }else{
            $('.business').hide();
            $('.agency').show();
        }
        if(vl1 == 0){
            $('.hide_group').hide();
            $('#group_1_1').show();
            $('.hide_op_2').show();
            $('#group_1_2_1').hide();
            $('#title_op').text("表示バナー");

            
        }else if(vl1 == 1){
            $('.hide_group').hide();
            $('#group_1_2').show();
            $('.hide_op_2').show();
            $('#group_1_2_1').show();
            $('#title_op').text("テキスト");
            
        }else{
            $('.hide_group').hide();
             $('#group_1_3').show();
             $('.hide_op_2').hide();
             $('#group_1_2_1').show();
             $('#title_op').text("テキスト");

             
        }
        html_export ="";
    }
    $('#update_html').click(function(){
        if(html_export == ""){
            alert("すべての項目を正確に入力してください!");
        }else{
            $('#content').val(html_export);
        }
        
    })
    $('#preview').on('keyup',function(){
        html_export = "<div><a href='"+base_url+"'>"+$(this).val()+"</a></div>"; 
        text_add ='<a class="table-row ng-binding" style="font-size: 12px;margin-left: 15px;margin-right: 15px;';
        text_add += 'word-break: break-all" href="'+base_url+'">'+$(this).val()+'</a>';
        $('.add_text').html(text_add);
    })

    
</script>	

@endsection
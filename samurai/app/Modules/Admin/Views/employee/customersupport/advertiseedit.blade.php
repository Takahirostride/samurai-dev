@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>顧客対応管理</a></li>
    </ul>
</div>
@endsection
@section('content')
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <ul>
	                                <li><a href="{{('/admin/employee/customersupport/contact')}}">お問い合わせ対応設定</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/identifydoc')}}">本人確認書類管理</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/identifyphrase')}}">本人確認書類対応設定</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/violator')}}">違反者管理</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/violatorphrase')}}">違反者対応設定</a></li>
	                                <li class="active"><a href="{{('/admin/employee/customersupport/manageadvertise')}}">広告掲載管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="site-content">
                           <div class="blueheading col-sm-10"><span>広告掲載情報一覧</span></div>
                                @foreach ($result as $value)
                                <div class="col-sm-12" style="margin-top: 40px;">
                                    <table class="table table-bordered" style="margin-bottom:0px; border: 1px solid #d6d6d6;">
                                        <tbody>
                                        <tr>
                                            <td class="td-div-blue"><h5>タイトル</h5> </td>
                                            <td style="font-size: 12px">
                                                <input type="text" class="form-control" placeholder="タイトル" value="{{$value->title}}" disabled="disabled">
                                            </td>
                                            <td rowspan="5" class="text-center" style="font-size: 12px;width: 33%;vertical-align: middle;">
                                                <img id="{{'image_url'.$value->id}}" src="@if($value->image_url != ''){{$value->image_url}} @else {{'./assets/img/img-icon.png'}}@endif" style="width: 245px;height:245px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-div-blue"><h5>内容</h5> </td>
                                            <td style="font-size: 12px">
                                                <textarea class="form-control" rows="3" disabled="disabled">{{$value->content}}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-div-blue"><h5>URL</h5> </td>
                                            <td style=" font-size: 12px">
                                                <input type="text" class="form-control" placeholder="URL" value="{{$value->url}}" disabled="disabled">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-div-blue"><h5>掲載写真</h5> </td>
                                            <td style="font-size: 12px">
                                                <div class="input-group">
                                                    <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                        <input type="text" id="{{'image_name'.$value->id}}" class="form-control" value="{{$value->image_name}}" disabled>
                                                        <span class="form-control-feedback" onclick="deleteimagefile1('{{$value->id}}')" style="pointer-events: auto;" disabled="disabled">
                                                                                    <i class="fa fa-close" style="margin-top: 10px;"></i></span>
                                                    </div>
                                                    <div class="input-group-btn">
                                                        <label for='{{"file".$value->id}}' class="btn btn-primary">
                                                            参照
                                                        </label>
                                                        <input id='{{"file".$value->id}}' type="file" style="display: none;" accept="image/*" ngf-select="selectNewAdImage1($index,$files)" disabled="disabled"/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td-div-blue"><h5>料金表示</h5> </td>
                                            <td style="font-size: 12px">
                                                <div class="col-sm-8" style="padding-left:0px;">
                                                    <input type="number" class="form-control" value="{{$value->charge}}" disabled="disabled">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                   
                        </div>
                         @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style')
<style type="text/css">
  
</style>
@endsection
@section('script')
    <script>
       function deleteimagefile1(id){
            console.log(id);
           $('#image_name'+id).val('');
           $('#image_url'+id).attr( "src", "" );
       }
    </script>
@endsection
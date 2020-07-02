@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>その他管理</a></li>
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
	                                <li><a href="{{('/admin/employee/other/affiliate')}}">アフィリエイター管理</a></li>
	                                <li><a href="{{('/admin/employee/other/payment')}}">支払管理</a></li>
	                                <li><a href="{{('/admin/employee/other/paydata')}}">支払管理データ総括</a></li>
	                                <li class="active"><a href="{{('/admin/employee/other/companies')}}">仕事提携可能会社一覧</a></li>
	                                <li><a href="{{('/admin/employee/other/data')}}">仕事提携可能会社データ総括</a></li>
	                                <li><a href="{{('/admin/employee/other/seminardata')}}">セミナーデータ一覧</a></li>
	                                <li><a href="{{('/admin/employee/other/seminarapplicant')}}">セミナー申込者一覧</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>仕事提携可能会社情報一覧</span></div>

                            <div class="section-2 col-md-12">
                                <div class="row">
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-5">
                                        <form class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-4">仕事提携可能会社</p>
                                                <div class="col-sm-7">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="仕事提携可能会社" ng-model="searchsetting.name" aria-invalid="false">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-5">
                                        <form class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-4">キーワード</p>
                                                <div class="col-sm-7">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="キーワード" ng-model="searchsetting.name" aria-invalid="false">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="submit" name="submit" class="submit-blue-btn" value="検索" ng-click="clicksearchagency()">
                                    </div>
                                </div>
                            </div>
                            <div class="section-3 col-md-12">
                                <div class="section3-full">
                                    <div class="section3-full-scroll">
                                        <div class="row" style="margin-top:30px;">
                                            <div class="col-sm-3">
                                            	<div class="angularsl">
                                                    <select name="location"> 
                                                        <option value="1">アカウントの停止</option> 
                                                        <option value="1">アカウントの停止解除</option> 
                                                    </select>
                                                </div> 
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="submit" name="submit" class="submit-blue-btn" value="適用" ng-click="clickchangestatus()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-5 col-md-12" style="overflow-x:auto;display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="yes" ng-click="headcheckboxclick()" ng-checked="headcheckboxchecked()">
                                            </th>
                                            <th style="min-width:160px;">選択</th>
                                            <th style="min-width:120px;">登録日</th>
                                            <th style="min-width:120px;">ユーザーID</th>
                                            <th style="min-width:120px;">表示名</th>
                                            <th style="min-width:180px;">登録者名</th>
                                            <th style="min-width:180px;">都道府県</th>
                                            <th style="min-width:180px;">掲載数</th>
                                            <th style="min-width:120px;">利用総額</th>
                                            <th style="min-width:120px;">ステータス</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ngRepeat: tableitem in tablearray -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                <ul uib-pagination="" total-items="paginationsetting.totalitemcount" max-size="5" ng-model="paginationsetting.currentpage" previous-text="前へ" next-text="次へ" first-text="最初" last-text="最後" direction-links="false" boundary-links="true" items-per-page="paginationsetting.itemperpage" class="pagination-sm ng-pristine ng-untouched ng-valid ng-isolate-scope pagination ng-empty" boundary-link-numbers="true" rotate="true" ng-change="paginationchange()" role="menu" aria-invalid="false">
                                    <!-- ngIf: ::boundaryLinks -->
                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noPrevious()||ngDisabled}" class="pagination-first ng-scope disabled"><a href="" ng-click="selectPage(1, $event)" ng-disabled="noPrevious()||ngDisabled" uib-tabindex-toggle="" class="ng-binding" disabled="disabled" tabindex="-1">最初</a></li>
                                    <!-- end ngIf: ::boundaryLinks -->
                                    <!-- ngIf: ::directionLinks -->
                                    <!-- ngRepeat: page in pages track by $index -->
                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope active"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">1</a></li>
                                    <!-- end ngRepeat: page in pages track by $index -->
                                    <!-- ngIf: ::directionLinks -->
                                    <!-- ngIf: ::boundaryLinks -->
                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noNext()||ngDisabled}" class="pagination-last ng-scope disabled"><a href="" ng-click="selectPage(totalPages, $event)" ng-disabled="noNext()||ngDisabled" uib-tabindex-toggle="" class="ng-binding" disabled="disabled" tabindex="-1">最後</a></li>
                                    <!-- end ngIf: ::boundaryLinks -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
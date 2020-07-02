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
	                                <li class="active"><a href="{{('/admin/employee/other/paydata')}}">支払管理データ総括</a></li>
	                                <li><a href="{{('/admin/employee/other/companies')}}">仕事提携可能会社一覧</a></li>
	                                <li><a href="{{('/admin/employee/other/data')}}">仕事提携可能会社データ総括</a></li>
	                                <li><a href="{{('/admin/employee/other/seminardata')}}">セミナーデータ一覧</a></li>
	                                <li><a href="{{('/admin/employee/other/seminarapplicant')}}">セミナー申込者一覧</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>アフィリエイト成果報酬</span></div>
                            <div style="border-bottom:1px solid #000000;margin-bottom:40px;margin-right:120px;"></div>
                            <div class="section-3 col-md-12">
                                <div class="section3-full">
                                    <div class="section3-full-scroll">
                                        <div class="row" style="margin-top:30px;">
                                            <div class="col-sm-2">
                                                <label>
                                                    <input type="radio" ng-checked="availableamount.value==2" ng-model="availableamount.value" value="2" name="amount" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false"> 月別成果集計
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                            	<div class="angularsl">
                                                    <select name="location"> 
                                                        <option value="1">○○○○年</option> 
                                                        <option value="2">○○○○年</option> 
                                                        <option value="3">○○○○年</option> 
                                                        <option value="4">○○○○年</option> 
                                                    </select>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:30px;">
                                            <div class="col-sm-2">
                                                <label>
                                                    <input type="radio" ng-checked="availableamount.value==2" ng-model="availableamount.value" value="2" name="amount" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false"> 日別成果集計
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                            	<div class="angularsl">
                                                    <select name="location"> 
                                                        <option value="1">○○○○年</option> 
                                                        <option value="2">○○○○年</option> 
                                                        <option value="3">○○○○年</option> 
                                                        <option value="4">○○○○年</option> 
                                                    </select>
                                                </div>   
                                            </div>
                                            <div class="col-sm-1">
                                            	<div class="angularsl">
                                                    <select name="location"> 
                                                        <option value="1">○○月</option> 
                                                        <option value="2">○○月</option> 
                                                        <option value="3">○○月</option>  
                                                    </select>
                                                </div>   
                                            </div>
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-2">
                                                <input type="submit" name="submit" class="submit-blue-btn" value="csv出力" ng-click="clickchangestatus()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-4 col-md-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>日付</th>
                                            <th>imp数</th>
                                            <th>アクセス数</th>
                                            <th>クリック数</th>
                                            <th>発生成果数</th>
                                            <th>発生成果額</th>
                                            <th>確定成果数</th>
                                            <th>確定成果額</th>
                                            <th>報酬合計</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>○日分</td>
                                            <td>0 imp</td>
                                            <td>0件</td>
                                            <td>0件</td>
                                            <td>0件</td>
                                            <td>0円</td>
                                            <td>0件</td>
                                            <td>0円</td>
                                            <td>0円</td>
                                        </tr>
                                        <tr>
                                            <td>○○年○月○日　</td>
                                            <td>0 imp</td>
                                            <td>0件</td>
                                            <td>0件</td>
                                            <td>0件</td>
                                            <td>0円</td>
                                            <td>0件</td>
                                            <td>0円</td>
                                            <td>0円</td>
                                        </tr>
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
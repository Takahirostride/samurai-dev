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
	                                <li class="active"><a href="{{('/admin/employee/other/payment')}}">支払管理</a></li>
	                                <li><a href="{{('/admin/employee/other/paydata')}}">支払管理データ総括</a></li>
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
                            <div class="section-1">
                                <div class="success-msg">
                                    <span>csvを出力しました。</span>
                                </div>
                            </div>

                            <div class="section-2 col-md-12">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <form class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">支払コード</p>
                                                <div class="col-sm-7">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="支払コード" ng-model="subsidykeyword" aria-invalid="false">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <form class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group">
                                                <p class="col-sm-3">支払予定日</p>
                                                <div class="col-sm-3" style="padding-right:0px;">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" ng-model="searchsetting.name" aria-invalid="false">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" ng-model="searchsetting.name" aria-invalid="false">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" ng-model="searchsetting.name" aria-invalid="false">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-5">
                                        <form class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group">
                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">~</p>
                                                <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" ng-model="searchsetting.name" aria-invalid="false">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" ng-model="searchsetting.name" aria-invalid="false">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" ng-model="searchsetting.name" aria-invalid="false">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <form class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">支払先会社名</p>
                                                <div class="col-sm-7">
                                                    <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" id="focusedInput" type="text" placeholder="支払先会社名" ng-model="subsidykeyword" aria-invalid="false">
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">ステータス</p>
                                                <div class="col-sm-7">
                                                	<div class="angularsl">
                                                        <select name="location"> 
                                                            <option value="1">すべて</option> 
                                                        </select>
                                                    </div>  
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">科目</p>
                                                <div class="col-sm-7">
                                                    <div class="angularsl">
                                                        <select name="location"> 
                                                            <option value="1">すべて</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div style="margin-top:50px;">
                                    <input type="submit" name="submit" class="submit-blue-btn" value="表示する" ng-click="submitSearch($event)">
                                </div>
                            </div>

                            <div class="section-3 col-md-12">
                                <h4 style="margin-bottom:20px;">支払予定管理一覧</h4>
                                <div class="row" style="margin-bottom:20px;margin-top:20px;">

                                    <div class="col-sm-12">
                                        <form class="searchPart ng-pristine ng-valid">
                                            <div style="display: inline;margin-left:30px;">00件表示 / 00件</div>
                                            <button type="button" class="submit-blue-searchright" style="margin-left:10px;">支払表印刷</button>
                                            <button type="button" class="submit-blue-searchright">csv出力</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="min-width:120px;">支払コード</th>
                                            <th>支払予定日</th>
                                            <th>支払先</th>
                                            <th>科目</th>
                                            <th>支払金額</th>
                                            <th>手数料</th>
                                            <th>合計金額</th>
                                            <th>ステータス</th>
                                            <th>支払</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="">
                                            <td ng-click="$event.stopPropagation()" role="button" tabindex="0">
                                                <input type="checkbox" name="yes" ng-model="tableitem.checkboxstate" ng-change="checkboxchange(tableitem.checkboxstate,tableitem.subsidyid)" class="ng-pristine ng-untouched ng-valid ng-empty" aria-invalid="false">
                                            </td>
                                            <td>sdfadsfdsa</td>
                                            <td>sdfadsfdsa</td>
                                            <td>sdfadsfdsa</td>
                                            <td>sdfadsfdsa</td>
                                            <td>sdfadsfdsa</td>
                                            <td>sdfadsfdsa</td>
                                            <td>sdfadsfdsa</td>
                                            <td>sdfadsfdsa</td>
                                            <td>
                                                <button type="button" class="submit-blue-left" ng-click="submitSearch()">完了</button>
                                                <button type="button" class="submit-blue-left" ng-click="submitSearch()">修正</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination">
                                <ul uib-pagination="" total-items="totaltableitem" max-size="5" ng-model="paginationnumber" previous-text="前へ" next-text="次へ" first-text="最初" last-text="最後" direction-links="false" boundary-links="true" items-per-page="tablepageitemcount" class="pagination-sm ng-pristine ng-untouched ng-valid ng-isolate-scope pagination ng-empty" boundary-link-numbers="true" rotate="true" ng-change="paginationchange()" role="menu" aria-invalid="false">
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
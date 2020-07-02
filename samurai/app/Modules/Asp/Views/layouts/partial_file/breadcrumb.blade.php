@php
	if(!isset($page_name)){ return false;}
@endphp
<nav class="nav-breadcrumb">
	<ul class="lst-inl">
		@switch($page_name)
		    @case('asp_home')
		        <li><span class="clr-blue">TOPページ</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>全体ダッシュボード</span></li>
		    @break	
		    @case('search_subsidy')
		        <li><span class="clr-blue">補助金／助成金検索</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>条件から絞り込んで探す</span></li>
		    @break			    	
		    @case('search_client')
		        <li><span class="clr-blue">補助金／助成金検索</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>顧客から案件を探す</span></li>
		    @break
			@case('show_client')
		        <li><span class="clr-blue">補助金／助成金検索</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>条件から絞り込んで探す</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>申請可能な顧客一覧</span></li>
		    @break
			@case('client_document')
		        <li><span class="clr-blue">補助金／助成金検索</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>顧客から案件を探す</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>検索結果</span></li>
		    @break
			@case('client_subsidy')
		        <li><span class="clr-blue">補助金／助成金検索</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>顧客から案件を探す</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>検索結果</span></li>
		    @break
			@case('status_client')
		        <li><span class="clr-blue">補助金／助成金検索</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>顧客から案件を探す</span></li>
		    @break
		    @case('status_client_recuitment')
		        <li><span class="clr-blue">顧客ステータス</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>申請中の案件</span></li>
		    @break

			@case('manage_client_index')
		        <li><span class="clr-blue">顧客管理</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>顧客一覧</span></li>
		    @break
			@case('manage_client_favorite')
		        <li><span class="clr-blue">顧客管理</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>担当企業</span></li>
		    @break
			@case('manage_client_invation')
		        <li><span class="clr-blue">顧客管理</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>招待管理</span></li>
		    @break
			@case('manage_client_csv')
		        <li><span class="clr-blue">顧客管理</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>顧客CSV登録</span></li>
		    @break
			@case('manage_client_hire_history')
		        <li><span class="clr-blue">顧客管理</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>出力履歴</span></li>
		    @break
			@case('manage_client_register_custom')
		        <li><span class="clr-blue">顧客管理</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>顧客情報</span></li>

		    @break
			@case('manage_client_register_edit')
		        <li><span class="clr-blue">顧客管理</span></li>
		        <li><span class="sep">＞</span></li>
		        <li><span>顧客情報</span></li>
				<li><span class="sep">＞</span></li>
		        <li><span>顧客情報編集</span></li>
				
		    @break
			
		    @default
		@endswitch
		
	</ul>
</nav>
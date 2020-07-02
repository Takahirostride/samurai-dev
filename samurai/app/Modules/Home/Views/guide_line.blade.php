@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/home/css/privacy_policy.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '仕事依頼ガイドライン'])
				<h1 class="page-title">仕事依頼ガイドライン</h1>
				<div class="clearfix"></div>
				<p>
					SAMURAIにおける、仕事依頼ガイドライン（以下「ガイドライン」といいます）は、利用規約に基づき本サービスにおけるご依頼の順守事項および利用条件を定めています。<br >
					本サービスでは、以下の仕事依頼を禁止しています。
				</p>
				<div class="box-list">
					<div class="clearfix"></div>
					<h3 class="page-title guide-line-h3">法律で許認可・登録・届出等が必要な仕事</h3>
					<p>
						依頼・弁護・法的文書作成・旅行代理などの、許認可・登録・届出等が必要となる資格・スキルが必要な仕事は依頼できません。直接的には法律で規定する資格行為を行わなくても、それに準ずるような書類や記事を作成する仕事に対しては、当該資格者の監修があること、または当該資格保持を提案要件として記載する必要があります。<br>
						・医療行為等の依頼<br>
						・病気の対処方法に関する記事作成の仕事で、提案資格に「特定の情報を調べ、それをまとめ記事などにてきる方」と記載されている<br>
						・薬の効用に関するコンテンツ制作だが、提案資格に薬剤師指定と記載なく、監修者に薬剤師がついていることも明示していない仕事<br>
						・その他、SAMURAIが上記に該当すると判断した仕事依頼<br>
					</p>

				    <h3 class="page-title guide-line-h3">個別契約・顧問契約募集の仕事</h3>
					
					<p>
						SAMURAIは、業務委託契約であることを利用規約で定めています。顧問契約、正社員、契約社員、アルバイトの雇用に繋がると判断される仕事はご依頼いただけません。<br>
						・顧問契約をさせてくださいなどの記載<br>
						・社員契約を結ばせてくださいなどの記載<br>
						・アルバイト契約をさせてくださいなどの記載<br>
						・顧問・正社員・契約社員で採用すると判断される記載<br>
						・その他、SAMURAIが上記に該当すると判断した仕事依頼
					</p>

					<h4 class="underLine-mg">レビューを指定する仕事依頼</h4>
					<p>
						レビュー内容を指定する仕事はご依頼いただけませんが、自由にレビューをお願いする仕事はご依頼いただけます。<br>
						・仕事完了後の評価・星の数を限定する仕事依頼<br>
						・その他、SAMURAIが上記に該当すると判断した仕事依頼
					</p>

					<h4 class="underLine-mg">サービス登録・いいね・フォローを促す仕事依頼</h4>
					<p>
						特定のサービスや、Facebookサービスのいいね、Twitterサービスのフォロー、検索サイトの順位を不正に向上させるような仕事は依頼することはできません。ただし、何か目的達成のためにサービス登録をすることが必要なご依頼は禁止ではありません。<br>
						・Facebookページのいいねしてください。<br>
						・このページのメルマガに登録してください。<br>
						・Twitterをフォローしてください。<br>
						・その他、SAMURAIが上記に該当すると判断した仕事依頼
					</p>
				     <h3 class="page-title guide-line-h3">SAMURAIを介さずに、取引を進行すると判断されるようなご依頼</h3>
					<p>
						SAMURAI委に対して履歴者や氏名、住所、電話番号などの個人情報、もしくは連絡の取れる手段を提案時の要件に記載した仕事はご依頼いただけません。また、依頼者の連絡先を記載した仕事もご依頼いただけません。<br>
						・提案時に履歴書を添付してください<br>
						・提案時に、チャットワークIDもしくはskypeIDを記載してください<br>
						・提案時に、氏名住所電話番号を記載してください<br>
						・選定する際に、スカイプ面接を実施します<br>
						・会ってから面談の上仕事依頼します<br>
						・私の連絡先です。山田太郎　０８０－○○○○ー○○○○・メールアドレス記載<br>
						・○○株式会社　○○部○○チーム　山田太郎<br>
						・その他、SAMURAIが上記に該当すると判断した仕事依頼
					</p>
				    <h3 class="page-title guide-line-h3"> その他、下記のようなご依頼</h3>
					<p class="mgbt-50">
						１．会社情報を偽った、助成金・補助金の申請依頼<br>
						２．偽造契約書等の作成依頼<br>
						３．その他、弊社が不適当と判断した仕事
					</p>
				</div>
			</div>
		</div><!-- .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
	<script src="/assets/home/js/privacy_policy.js"></script>
@endsection
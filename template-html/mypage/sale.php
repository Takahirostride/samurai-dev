<?php include ('../inc/header.php'); ?>
<div class="mainpage">
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
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<img src="assets/images/comingsoon.png" alt="">
					</div><!-- end .col-sm-12 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>

<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#home" aria-controls="home" role="tab" data-toggle="tab">home</a>
		</li>
		<li role="presentation">
			<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">tab</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="home">...</div>
		<div role="tabpanel" class="tab-pane" id="tab">...</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>
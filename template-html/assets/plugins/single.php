<?php get_header(); ?>
    <div id="container">

        <div class="main_post">
            <div class="cat_link cat_leisure-outdoor">
                <p>Column</p>
                <span></span>
            </div>
        </div>
        <div class="clearfix"></div>
        <section id="content" role="main">
            <div class="main_wrap">
                <div class="l_main">
                    <div class="headline_title" style="opacity:0;">
                        <div>
                            <h2>All</h2><span>全て</span>
                        </div>
                        <?php 
                            $categories = get_categories(array(
                                'hide_empty'       => 0,
                            )); 
                            foreach($categories as $category) {
                                echo ' <div><h2>'. $category->name . '</h2><span>'.$category->description.'</span></div>';
                            }

                        ?>
                    </div>
                    <div class="content_slide" style="opacity:0;">
                       <?php do_action('slide_show') ?>
                    </div>
                    <!--content_slide-->
                    <div class="clearfix clear"></div>
                </div>
                <!--l_main-->
            </div>
            <!--main_wrap-->
        </section>
        <!--#content-->
        <section class="full-w backao" style="background: url('<?php echo get_template_directory_uri() ?>/images/bg1.png') no-repeat center center; background-size: cover;">
            <div class="container">
                <h2 class="s_title">SNS</h2>
                <div class="sofica_slick">
                    <div class="fb_sofica">
                        <!--facebook-->
                        <p class="text-center">
                        	<img src="<?php echo get_template_directory_uri() ?>/images/logo-instagram.png" alt="">
                        </p>
                        <div class="cont">
                        	<img src="<?php echo get_template_directory_uri() ?>/images/image-4.png" alt="">
                        </div>
                    </div>
                    <div class="fb_sofica">
                        <!--facebook-->
                        <p class="text-center">
                        	<img src="<?php echo get_template_directory_uri() ?>/images/logo-fb.png" alt="">
                        </p>
                        <div class="cont">
                        	<img src="<?php echo get_template_directory_uri() ?>/images/image-5.png" alt="">
                        </div>
                    </div>
                    <div class="fb_sofica">
                        <!--facebook-->
                        <p class="text-center">
                        	<img src="<?php echo get_template_directory_uri() ?>/images/logo-twitter.png" alt="">
                        </p>
                        <div class="cont">
                        	<img src="<?php echo get_template_directory_uri() ?>/images/image-6.png" alt="">
                        </div>
                    </div>
                </div>
                <!--sofica_slick end-->
            </div>
            <!--sofica_inner end-->
            <div class="clearfix clear"></div>
        </section>
        <!--sofica-->
        <section class="full-w backao" style="background: url('<?php echo get_template_directory_uri() ?>/images/bg2.png') no-repeat center center; background-size: cover;">
        	<div class="container">
	        	<div class="living">
	        		<img src="<?php echo get_template_directory_uri() ?>/images/living-center.jpg" alt="">
	        	</div>
        	</div>
        </section>
        <!--pickup-->
        <section class="full-w backao"  style="background: url('<?php echo get_template_directory_uri() ?>/images/bg3.png') no-repeat center center; background-size: cover;">
            <div class="container">
            	<h2 class="s_title">Contents</h2>
            	<ul class="list-ico">
            		<li>
            			<p class="text-center">
            				<img src="<?php echo get_template_directory_uri() ?>/images/icon1.png" alt="">
            			</p>
                        <div class="tb-dl">
                        <div class="tb-cell">
                			<p class="text-center">
                				番組情報
                			</p>
                        </div>
                        </div>
            		</li>
            		<li>
            			<p class="text-center">
            				<img src="<?php echo get_template_directory_uri() ?>/images/icon2.png" alt="">
            			</p>
                        <div class="tb-dl">
                        <div class="tb-cell">
                            <p class="text-center">
                                番組コラム
                            </p>
                        </div>
                        </div>
            		</li>
            		<li>
            			<p class="text-center">
            				<img src="<?php echo get_template_directory_uri() ?>/images/icon3.png" alt="">
            			</p>
                        <div class="tb-dl">
                        <div class="tb-cell">
                            <p class="text-center">
                                d design travel WORKSHOP<br>「千葉エリア号」活動レポート
                            </p>
                        </div>
                        </div>
            		</li>
            		<li>
            			<p class="text-center">
            				<img src="<?php echo get_template_directory_uri() ?>/images/icon4.png" alt="">
            			</p>
                        <div class="tb-dl">
                        <div class="tb-cell">
                            <p class="text-center">
                                検見川浜グッドポイントマップ
                            </p>
                        </div>
                        </div>
            		</li>
            	</ul>
            </div>
        </section>
    </div>
<?php get_footer(); ?>   
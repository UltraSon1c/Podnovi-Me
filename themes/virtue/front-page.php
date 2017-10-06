<?php  global $virtue; 
			if(isset($virtue['mobile_switch'])) {
				$mobile_slider = $virtue['mobile_switch']; 
			} else { 
				$mobile_slider = '0';
			}
			if(isset($virtue['choose_slider'])) {
				$slider = $virtue['choose_slider'];
			} else {
				$slider = 'mock_flex';
			}
			if($mobile_slider == '1') {
		 		$mslider = $virtue['choose_mobile_slider'];
				if ($mslider == "flex") {
					get_template_part('templates/mobile_home/mobileflex', 'slider');
				} else if ($mslider == "video") {
					get_template_part('templates/mobile_home/mobilevideo', 'block');
				} 
			}
			if ($slider == "flex") {
					get_template_part('templates/home/flex', 'slider');
			} else if ($slider == "thumbs") {
					get_template_part('templates/home/thumb', 'slider');
			} else if ($slider == "fullwidth") {
					get_template_part('templates/home/flex', 'slider-fullwidth');
			} else if ($slider == "latest") {
					get_template_part('templates/home/latest', 'slider');
			} else if ($slider == "carousel") {
					get_template_part('templates/home/carousel', 'slider');
			} else if ($slider == "video") {
					get_template_part('templates/home/video', 'block');
			} else if ($slider == "mock_flex") {
					get_template_part('templates/home/mock', 'flex');
			}
			$show_pagetitle = false;
			if(isset($virtue['homepage_layout']['enabled'])){
				$i = 0;
				foreach ($virtue['homepage_layout']['enabled'] as $key=>$value) {
					if($key == "block_one") {
						$show_pagetitle = true;
					}
					$i++;
					if($i==2) break;
				}
			} 
			if($show_pagetitle == true) { ?>
				<div id="homeheader" class="welcomeclass">
					<div class="container">
						<?php get_template_part('templates/page', 'header'); ?>
					</div>
				</div><!--titleclass-->
			<?php } ?>

    <div id="content" class="container homepagecontent">
   		<div class="row">
          	<div class="main <?php echo esc_attr(kadence_main_class()); ?>" role="main">
          	<div class="entry-content" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/WebPageElement">

      		<?php if(isset($virtue['homepage_layout']['enabled'])) { 
      			$layout = $virtue['homepage_layout']['enabled']; 
      		  } else {
      		  	$layout = array("block_one" => "block_one", "block_four" => "block_four"); 
      		  }

				if ($layout):

				foreach ($layout as $key=>$value) {

				    switch($key) {

				    	case 'block_one':
						   	if($show_pagetitle == false) {?>
					    	  <div id="homeheader" class="welcomeclass">
									<?php get_template_part('templates/page', 'header'); ?>
								</div><!--titleclass-->
							<?php }

					    break;
						case 'block_four':
							if(is_home()) {
									if(kadence_display_sidebar()) {
										$display_sidebar = true; 
										$fullclass = '';
									} else {
										$display_sidebar = false;
										$fullclass = 'fullwidth';
									} 
									if(isset($virtue['home_post_summery']) and ($virtue['home_post_summery'] == 'full')) {
										$summery = "full";
										$postclass = "single-article fullpost";
									} else {
										$summery = "summery";
										$postclass = "postlist";
									} ?>
								<div class="homecontent <?php echo esc_attr($fullclass); ?>  <?php echo esc_attr($postclass); ?> clearfix home-margin"> 
									<?php while (have_posts()) : the_post(); 
								  			if($summery == 'full') {
												if($display_sidebar){
													get_template_part('templates/content', 'fullpost'); 
												} else {
													get_template_part('templates/content', 'fullpostfull');
												}
											} else {
												if($display_sidebar){
												 	get_template_part('templates/content', get_post_format()); 
												 } else {
												 	get_template_part('templates/content', 'fullwidth');
												 }
											}
										endwhile; 
									
										//Page Navigation
								        if ($wp_query->max_num_pages > 1) :
								        	virtue_wp_pagenav();
								        endif; ?>
								</div> 
							<?php } else { ?>
								<div class="homecontent clearfix home-margin"> 
									<?php get_template_part('templates/content', 'page'); ?>
								</div>
							<?php }
						break;
						case 'block_five':
								get_template_part('templates/home/blog', 'home'); 
						break;
						case 'block_six':
								get_template_part('templates/home/portfolio', 'carousel');		 
						break; 
						case 'block_seven':
								get_template_part('templates/home/icon', 'menu');		 
						break;
						case 'block_twenty':
								get_template_part('templates/home/icon', 'menumock');		 
						break;  
					}
				}
			endif; ?>  
			</div>
		</div><!-- /.main -->
<hr>
<div id="mainCategories" class="row">

	<div class="col-md-4 text-center smoothZoom">
	<a href="https://www.podnovi.me/product-category/devojki/%D1%87%D0%B0%D1%81%D0%BE%D0%B2%D0%BD%D0%B8%D1%86%D0%B8/">
<img src="https://www.podnovi.me/wp-content/uploads/2017/07/womage-733-leopard-casual-watch-for-women-dress-watches-crystal-dial-ladies-ear-shape-quartz-wrist-watch-pink-WO190OTAA1VVHMANPH-3737442.jpg" style="margin: 0 auto; max-width: 220px;" class="img-responsive ">
		<h5>Женски Часовници</h5></a>
	</div>
	<div class="col-md-4 text-center smoothZoom">
		<a href="https://www.podnovi.me/product-category/devojki/%D1%87%D0%B0%D1%81%D0%BE%D0%B2%D0%BD%D0%B8%D1%86%D0%B8/">
		<img src="https://www.podnovi.me/wp-content/uploads/2017/07/obetki_sini.jpg" class="img-responsive" style="margin: 0 auto; max-width: 220px;">
		<h5>Накит</h5>
		</a>

	</div>
	<div class="col-md-4 text-center smoothZoom">
	<a href="https://www.podnovi.me/product-category/devojki/%D1%87%D0%B0%D1%81%D0%BE%D0%B2%D0%BD%D0%B8%D1%86%D0%B8/">
		<img src="https://www.podnovi.me/wp-content/uploads/2017/07/jingle-womage-mens-leather-analog-quartz-strap-watch-brown-1484093951-9409451-d2b5e3cf0ca304e9f5cf206eb22d7f44-webp-zoom-1.jpg" class="img-responsive" style="margin: 0 auto; max-width: 220px;">
		<h5>Машки Часовници</h5>
		</a>
	</div>
</div>
<hr>
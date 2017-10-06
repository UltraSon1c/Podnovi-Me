<footer id="containerfooter" class="footerclass" itemscope itemtype="http://schema.org/WPFooter">
  <div class="container">
  	<div class="row">
  		<?php global $virtue; if(isset($virtue['footer_layout'])) { $footer_layout = $virtue['footer_layout']; } else { $footer_layout = 'fourc'; }
  			if ($footer_layout == "fourc") {
  				if (is_active_sidebar('footer_1') ) { ?> 
					<div class="col-md-3 col-sm-6 footercol1">
					<?php dynamic_sidebar('footer_1'); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?> 
					<div class="col-md-3  col-sm-6 footercol2">
					<?php dynamic_sidebar('footer_2'); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?> 
					<div class="col-md-3 col-sm-6 footercol3">
					<?php dynamic_sidebar('footer_3'); ?>
					</div> 
	            <?php }; ?>
				<?php if (is_active_sidebar('footer_4') ) { ?> 
					<div class="col-md-3 col-sm-6 footercol4">
					<?php dynamic_sidebar('footer_4'); ?>
					</div> 
		        <?php }; ?>
		    <?php } else if($footer_layout == "threec") {
		    	if (is_active_sidebar('footer_third_1') ) { ?> 
					<div class="col-md-4 footercol1">
					<?php dynamic_sidebar('footer_third_1'); ?>
					</div> 
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_third_2') ) { ?> 
					<div class="col-md-4 footercol2">
					<?php dynamic_sidebar('footer_third_2'); ?>
					</div> 
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_third_3') ) { ?> 
					<div class="col-md-4 footercol3">
					<?php dynamic_sidebar('footer_third_3'); ?>
					</div> 
	            <?php }; ?>
			<?php } else {
					if (is_active_sidebar('footer_double_1') ) { ?>
					<div class="col-md-6 footercol1">
					<?php dynamic_sidebar('footer_double_1'); ?> 
					</div> 
		            <?php }; ?>
		        <?php if (is_active_sidebar('footer_double_2') ) { ?>
					<div class="col-md-6 footercol2">
					<?php dynamic_sidebar('footer_double_2'); ?> 
					</div> 
		            <?php }; ?>
		        <?php } ?>
        </div>
        <div class="footercredits clearfix">
    		
    		<?php if (has_nav_menu('footer_navigation')) :
        	?><div class="footernav clearfix"><?php 
              wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footermenu'));
            ?></div><?php
        	endif;?>
        	<p><?php if(isset($virtue['footer_text'])) { $footertext = $virtue['footer_text'];} else {$footertext = '[copyright] [the-year] [site-name] [theme-credit]';}
        		$footertext = str_replace('[copyright]','&copy;',$footertext);
        		$footertext = str_replace('[the-year]',date('Y'),$footertext);
        		$footertext = str_replace('[site-name]',get_bloginfo('name'),$footertext);
        		$footertext = str_replace('[theme-credit]','- WordPress Theme by <a href="https://www.kadencethemes.com/" target="_blank">Kadence Themes</a>',$footertext);
        		 echo do_shortcode($footertext); ?></p>
    	</div>

  </div>

<script type="text/javascript">
(function(d,s,id){var z=d.createElement(s);z.type="text/javascript";z.id=id;z.async=true;z.src="//static.zotabox.com/a/3/a3afa50c8cade29bacfddf136c3a313d/widgets.js";var sz=d.getElementsByTagName(s)[0];sz.parentNode.insertBefore(z,sz)}(document,"script","zb-embed-code"));
</script>
<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */
    
    var disqus_config = function () {
        this.page.url = '<?php echo get_permalink(); ?>';
		this.page.identifier = '<?php echo dsq_identifier_for_post($post); ?>';
    };
    
    (function() {  // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        
        s.src = 'https://podnovi-me-2.disqus.com/embed.js';
        
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
</footer>
</div><!--Wrapper-->

<?php wp_footer(); ?>

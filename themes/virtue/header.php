<?php
/*
DO NOT ADD SCRIPTS HERE
USE a plugin like : https://wordpress.org/plugins/header-and-footer-scripts/

- Force plugins to stop stating incorrect errors -
<?php wp_head(); ?>
*/

get_template_part('templates/head'); ?>
  	<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->



  	<body <?php body_class(); ?>>
<!-- Google Code for &#1055;&#1086;&#1076;&#1085;&#1086;&#1074;&#1080; &#1052;&#1077; Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 972178279;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "-_9XCO716nQQ54bJzwM";
var google_conversion_value = 1.00;
var google_conversion_currency = "EUR";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/972178279/?value=1.00&amp;currency_code=EUR&amp;label=-_9XCO716nQQ54bJzwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

  	<?php 
	do_action('virtue_after_body');
	?>

    <div id="wrapper" class="container">
    <?php 

        
        get_template_part('templates/header');
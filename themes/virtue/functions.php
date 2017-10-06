<?php
/*-----------------------------------------------------------------------------------*/
/* Include Theme Functions */
/*-----------------------------------------------------------------------------------*/

function virtue_lang_setup() {
	load_theme_textdomain('virtue', get_template_directory() . '/languages');
}
add_action( 'after_setup_theme', 'virtue_lang_setup' );
/*
 * Init Theme Options
 */
require_once locate_template('/themeoptions/framework.php');        		// Options framework
require_once locate_template('/themeoptions/options.php');     				// Options framework
require_once locate_template('/themeoptions/options/virtue_extension.php'); // Options framework extension
require_once locate_template('/lib/utils.php');           					// Utility functions
require_once locate_template('/lib/init.php');            					// Initial theme setup and constants
require_once locate_template('/lib/sidebar.php');         					// Sidebar class
require_once locate_template('/lib/config.php');          					// Configuration
require_once locate_template('/lib/cleanup.php');        					// Cleanup
require_once locate_template('/lib/nav.php');            					// Custom nav modifications
require_once locate_template('/lib/metaboxes.php');     					// Custom metaboxes
require_once locate_template('/lib/comments.php');        					// Custom comments modifications
require_once locate_template('/lib/widgets.php');         					// Sidebars and widgets
require_once locate_template('/lib/aq_resizer.php');      					// Resize on the fly
require_once locate_template('/lib/image_functions.php');        			// Image functions
require_once locate_template('/lib/class-virtue-get-image.php');        	// Image Class
require_once locate_template('/lib/scripts.php');        					// Scripts and stylesheets
require_once locate_template('/lib/custom.php');          					// Custom functions
require_once locate_template('/lib/admin_scripts.php');          			// Icon functions
require_once locate_template('/lib/authorbox.php');         				// Author box
require_once locate_template('/lib/template_hooks/portfolio_hooks.php'); 	// Portfolio Template Hooks
require_once locate_template('/lib/template_hooks/post_hooks.php'); 		// Post Template Hooks
require_once locate_template('/lib/template_hooks/page_hooks.php'); 		// Post Template Hooks
require_once locate_template('/lib/custom-woocommerce.php'); 				// Woocommerce functions
require_once locate_template('/lib/woo-account.php'); 						// Woocommerce functions
require_once locate_template('/lib/virtuetoolkit-activate.php'); 			// Plugin Activation
require_once locate_template('/lib/custom-css.php'); 			    		// Fontend Custom CSS


// removes Order Notes Title - Additional Information
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
//remove Order Notes Field
add_filter( 'woocommerce_checkout_fields' , 'remove_order_notes' );
function remove_order_notes( $fields ) {
 unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_email']);
 return $fields;
}

add_filter( 'woocommerce_checkout_fields' , 'remove_email_field' );
function remove_email_field( $fields ) {
 unset($fields['billing']['billing_email']);
 return $fields;
}

add_action( 'template_redirect', 'wc_custom_redirect_after_purchase' ); 
function wc_custom_redirect_after_purchase() {
	global $wp;

	if ( is_checkout() && ! empty( $wp->query_vars['order-received'] ) ) {
		wp_redirect( 'https://www.podnovi.me/thank-you/' );
		exit;
	}
}

add_filter('woocommerce_cart_needs_payment', '__return_false');
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );

foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

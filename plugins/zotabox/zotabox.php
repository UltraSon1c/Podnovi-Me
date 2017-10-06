<?php
/*
/**
 * Plugin Name: Zotabox
 * Plugin URI: https://zotabox.com/dashboard/?utm_source=wordpress.com&utm_medium=Zotabox&utm_campaign=ecommerce%20plugins&authuser=anonymous
 * Description: Boost your subscribers and sales with 20+ popular on-site marketing tools: Email List Builder, Social Coupon, Countdown Timers, Contact Forms, Popups
 * Version: 1.7.7
 * Author: Zotabox
 * Author URI: https://zotabox.com/dashboard/?utm_source=wordpress.com&utm_medium=Zotabox&utm_campaign=ecommerce%20plugins&authuser=anonymous
 * License: SMB 1.0
 */

//Add some free tools

add_action( 'admin_init', 'zb_zbapp_admin_init' );
function zb_zbapp_admin_init(){
	/* Register stylesheet. */
	wp_register_style( 'css_main', plugins_url('assets/css/style.css', __FILE__) );
	wp_enqueue_style('css_main');
    /* Register js. */
	wp_register_script( 'main_js', plugins_url('assets/js/main.js?v=5', __FILE__) );
	wp_enqueue_script('main_js');

    //Create options
    add_option( 'ztb_source', '', '', 'yes' );
    add_option( 'ztb_id', '', '', 'yes' );
    add_option( 'ztb_domainid', '', '', 'yes' );
    add_option( 'ztb_email', '', '', 'yes' );
    add_option( 'access_key', '', '', 'yes' );
    add_option( 'ztb_access_key', '', '', 'yes' );
    add_option( 'ztb_status_message', 1, '', 'yes' );
    add_option( 'ztb_status_disconnect', 2, '', 'yes' );
}

register_deactivation_hook( __FILE__, 'zb_zbapp_deactivate' );
function zb_zbapp_deactivate(){
	update_option( 'ztb_status_message', 2 );
	update_option( 'ztb_status_disconnect', 1 );
}

register_activation_hook( __FILE__, 'zb_zbapp_activate' );
function zb_zbapp_activate() {
	update_option( 'ztb_status_message', 1 );
}

/*
add_action('admin_notices', 'zb_zbapp_show_admin_messages');
function zb_zbapp_show_admin_messages() {

}
*/

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'zb_zbapp_add_action_links' );
function zb_zbapp_add_action_links ( $links ) {
	 $mylinks = array(
	 '<a href="' . admin_url( 'admin.php?page=zb_zbapp' ) . '">Settings</a>',
	 );
	return array_merge( $links, $mylinks );
}

add_action('admin_menu', 'zb_zbapp_admin_menu');
function zb_zbapp_admin_menu() {
	add_menu_page('Zotabox', 'Zotabox', 'administrator', 'zb_zbapp', 'zb_zbapp_setting',plugins_url( 'zotabox.png', __FILE__ ));
}

function zb_zbapp_setting(){
	$domain_action = 'https://zotabox.com';
	$access_key = get_option( 'ztb_access_key', '' );
	$ztb_id = get_option( 'ztb_id', '' );
	$domain = get_option('ztb_domainid','');
	$zbEmail = get_option('ztb_email','');
	$ztb_source = get_option('ztb_source','');
	$button = '';
	$adminEmail = get_option('admin_email');
	//Check empty ztb email
	if(empty($zbEmail)){
		$zbEmail = $adminEmail;
	}
	global $current_user;
    wp_get_current_user();

	$ztb_status_disconnect = get_option( 'ztb_status_disconnect', '' );
	$connected = 2;
	if(isset($access_key) && !empty($access_key) && strlen($access_key) > 0 && $ztb_status_disconnect == $connected){
	
		$button = '<a  target="zotabox" href="'.$domain_action.'/customer/access/PluginLogin/?customer='.$ztb_id.'&access='.$access_key.'&platform=wordpress&utm_source=wordpress.com">
			Configure your tools
		</a>';
		$form = '';
	}else{
		$form = '<form class="ztb-register-form" target="_blank" method="POST" action="'.$domain_action.'/customer/access/PluginAuth?utm_source=wordpress.com&utm_medium=Zotabox&utm_campaign=ecommerce%20plugins&platform=wordpress&access='.$access_key.'" id="account-info">
					<div class="form-group">
						<label>Website:</label>
						<input class="form-control" readonly type="text" name="domain" value="'.home_url().'" />
						<input type="hidden" name="name" value="'.$current_user->display_name.'" />
						<input type="hidden" name="utm_medium" value="Zotabox" />
						<input type="hidden" name="utm_campaign" value="ecommerce plugins" />
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input class="form-control" type="text" name="email" value="'.$zbEmail.'" />
					</div>
					
					<div class="form-group button-wrapper">
						<input class="ztb-submit-button" type="submit" value="Start Using Your New Tools Now" />
					</div>
					</form>';
		$button = '';
	} 

	$html = '
	<script type="text/javascript">
		var ZBT_WP_ADMIN_URL = "'.admin_url().'";
		var ZTB_BASE_URL = "'.$domain_action.'";
	</script>
	<div class="ztb-wrapper">
		<div class="ztb-logo">
			<a href="https://zotabox.com/dashboard/?utm_source=wordpress.com&utm_medium=Zotabox&utm_campaign=ecommerce%20plugins&authuser=anonymous" title="Zotabox" target="zotabox">
				<img title="Zotabox" alt="Zotabox" src="'.plugins_url( 'assets/images/logo-zotabox.png', __FILE__ ).'">
			</a>
		</div>
		<div class="ztb-code-wrapper wrap">
			<div class="ztb-title">
				Zotabox includes 20+ Free and Premium on-site marketing tools to grow your website’s traffic, boost your sales and get more subscribers.
			</div>
			<div class="account-input">
				'.$form.'
			</div>
			<div class="ztb-button">'.$button.'</div>
			<div style="clear:both"></div>
		</div>
	</div>';
	echo $html;
}

function insert_zb_zbapp_code(){
	if(!is_admin()){
		$domain = get_option( 'ztb_domainid', '' );
		$ztb_source = get_option('ztb_source','');
		$ztb_status_disconnect = get_option('ztb_status_disconnect','');
		$connected = 2;
		if(!empty($domain) && strlen($domain) > 0 && $ztb_status_disconnect == $connected){
			print_r(html_entity_decode(print_zb_zbapp_code($domain)));
		}
	}
}

add_action( 'wp_head', 'insert_zb_zbapp_code' );


add_action("wp_ajax_update_zb_zbapp_code", "update_zb_zbapp_code");
add_action("wp_ajax_nopriv_update_zb_zbapp_code", "update_zb_zbapp_code");

function update_zb_zbapp_code(){
	header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
	$domain = addslashes($_REQUEST['domain']);
	$public_key = addslashes($_REQUEST['access']);
	$id = intval($_REQUEST['customer']);
	$zbEmail = addslashes($_REQUEST['email']);
	if(!isset($domain) || empty($domain)){
		header("Location: ".admin_url()."admin.php?page=zb_zbapp");
	}else{
		file_put_contents('updatecode.json', date('d-m-Y H:i:s').$zbEmail);
		update_option( 'ztb_domainid', $domain );
		update_option( 'ztb_access_key', $public_key );
		update_option( 'ztb_id', $id );
		update_option( 'ztb_email', $zbEmail );
		update_option( 'ztb_status_disconnect', 2 );
		wp_send_json( array(
			'error' => false,
			'message' => 'Update Zotabox embedded code successful !' 
			)
		);
	}
}

function print_zb_zbapp_code($domainSecureID = "", $isHtml = false) {

	$ds1 = substr($domainSecureID, 0, 1);
	$ds2 = substr($domainSecureID, 1, 1);
	$baseUrl = '//static.zotabox.com';
	$code = <<<STRING
<script type="text/javascript">
(function(d,s,id){var z=d.createElement(s);z.type="text/javascript";z.id=id;z.async=true;z.src="{$baseUrl}/{$ds1}/{$ds2}/{$domainSecureID}/widgets.js";var sz=d.getElementsByTagName(s)[0];sz.parentNode.insertBefore(z,sz)}(document,"script","zb-embed-code"));
</script>
STRING;
	return $code;
}
?>
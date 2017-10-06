<?php
/**
 * weeblrAMP - Accelerated Mobile Pages for Wordpress
 *
 * @author       weeblrPress
 * @copyright    (c) WeeblrPress - Weeblr,llc - 2017
 * @package      weeblrAMP - Community edition
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version      1.4.0.580
 *
 * 2017-07-31
 */

// Security check to ensure this file is being included by a parent file.
defined( 'WEEBLRAMP_EXEC' ) || die;

if ( is_front_page() && $this->get( 'user_config' )->isFalsy( 'amplify_home' ) ) {
	return;
}

?>
<link rel="amphtml" href="<?php echo $this->getAsUrl( 'amp_url' ); ?>"/>

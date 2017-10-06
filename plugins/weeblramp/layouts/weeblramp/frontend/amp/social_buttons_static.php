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
// no direct access
defined( 'WEEBLRAMP_EXEC' ) || die;

$file = wbSlashJoin( __DIR__, WeeblrampHelper_Version::getEdition(), 'social_buttons_static.php' );
if ( file_exists( $file ) ) {
	include $file;
}

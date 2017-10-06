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

/**
 * Handles communication with WeeblrPress service in relation with Disqus support
 *
 */
class WeeblrampModelFeature_Disqus extends WeeblrampClass_Model {

	public function dispatch( $request ) {

		throw new Exception( 'Invalid action requested. Aborting.' );
	}

}

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

class WeeblrampModelElement_Ad extends WeeblrampClass_Base {

	/**
	 * Finds if any ads is to be displayed based on shortcodes.
	 *
	 * @return mixed|string
	 */
	public function getData( $rawContent ) {

		return array(
			'data'    => $rawContent,
			'scripts' => array(),
			'styles'  => array()
		);
	}
}

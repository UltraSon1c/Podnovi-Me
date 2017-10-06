<?php
/**
 * weeblrAMP - Accelerated Mobile Pages for Wordpress
 *
 * @author                  weeblrPress
 * @copyright               (c) WeeblrPress - Weeblr,llc - 2017
 * @package                 weeblrAMP - Community edition
 * @license                 http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version                 1.4.0.580
 *
 * 2017-07-31
 */

// Security check to ensure this file is being included by a parent file.
defined( 'WEEBLRAMP_EXEC' ) || die;

class WeeblrampHelper_Widget {

	public static $widgetDisabled = false;

	/**
	 * Collect and return all widgets output from a given widget area
	 * Filters first whether that area should be displayed.
	 *
	 * @param string $widgetAreaName
	 *
	 * @return string
	 */
	public static function getWidgetAreaWidgets( $widgetAreaName, $requestType, $default = true ) {

		return '';
	}

	/**
	 * Registers AMP-only widgets.
	 *
	 * Registering only on AMP pages means we have to delay registration until after
	 * we know this is an AMP request (ie not on "init" hook).
	 * In admin however, widgets must be registered for all requests, so we keep registering them
	 * on the admin_init hook.
	 */
	public static function registerAmpWidgets() {
	}
}

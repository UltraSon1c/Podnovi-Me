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

/**
 * Settings page for the plugin
 */
class WeeblrampViewAdmin_Options extends WeeblrampClass_Configview {

	const SETTINGS_PAGE = 'weeblramp-settings';

	public $title     = 'Settings';
	public $menuTitle = 'Settings';

	protected $configName = 'weeblramp.config.user';

	/**
	 * WeeblrampViewAdmin_Options constructor.
	 */
	public function __construct() {

		parent::__construct();

		// hook up config checks on settings page
		add_action(
			'weeblramp_config_after_render',
			array(
				WeeblrampFactory::getA( 'WeeblrampClass_Configcheck' ),
				'execute'
			)
		);
	}
}

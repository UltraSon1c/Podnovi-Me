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

class WeeblrampHelper_Admin {

	/**
	 * Add a link to the settings page from the plugin page
	 *
	 * @param $links
	 *
	 * @return array
	 */
	public static function filter_plugins_action_links( $links ) {

		$addedLinks = array(
			'<a href="' . admin_url( 'admin.php?page=' . WeeblrampViewAdmin_Options::SETTINGS_PAGE ) . '">' . __( 'Settings' ) . '</a>',
			'<a href="' . admin_url( 'admin.php?page=' . WeeblrampViewAdmin_Customize::SETTINGS_PAGE ) . '">' . __( 'Customize' ) . '</a>',
		);

		return array_merge( $addedLinks, $links );
	}

	/**
	 * Add minimal javascript to the settings page
	 */
	public static function admin_action_scripts() {

		// built in required javascript
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-accordion' );

		// media manager
		wp_enqueue_media();

		// custom weeblrAMP scripts
		$htmlManager = WeeblrampFactory::getThe( 'weeblramp.html_manager' );
		wp_enqueue_script(
			'wblib-admin',
			$htmlManager->getMediaLink(
				'wblib_admin',
				'js',
				array(
					'files_path'      => array( WBLIB_ASSETS_PATH => '' ),
					'assets_bundling' => false
				)
			)
		);
		wp_enqueue_script(
			'wblib-spinner',
			$htmlManager->getMediaLink(
				'spinner',
				'js',
				array(
					'files_path'      => array( WBLIB_ASSETS_PATH => '' ),
					'assets_bundling' => false
				)
			)
		);
		wp_enqueue_script(
			'weeblramp-admin',
			$htmlManager->getMediaLink(
				'weeblramp_admin',
				'js',
				array(
					'files_path'      => array( 'assets/admin' => '' ),
					'assets_bundling' => false
				)
			)
		);

		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );

		// and styles
		wp_enqueue_style(
			'wblib-admin',
			$htmlManager->getMediaLink(
				'wblib_admin',
				'css',
				array(
					'files_path'      => array( WBLIB_ASSETS_PATH => '' ),
					'assets_bundling' => false
				)
			)
		);
		wp_enqueue_style(
			'wblib-spinner',
			$htmlManager->getMediaLink(
				'spinner',
				'css',
				array(
					'files_path'      => array( WBLIB_ASSETS_PATH => '' ),
					'assets_bundling' => false
				)
			)
		);
		wp_enqueue_style(
			'weeblramp-admin',
			$htmlManager->getMediaLink(
				'weeblramp_admin',
				'css',
				array(
					'files_path'      => array( 'assets/admin' => '' ),
					'assets_bundling' => false
				)
			)
		);
	}

	/**
	 * Adds the root menu (admin side) to which
	 * our settings page will be attached
	 */
	public static function addAdminMenu() {

		static $added = false;

		if ( ! $added ) {
			$svg     = WeeblrampFactory::getThe( 'weeblramp.config.system' )->get( 'assets.amp_logo' );
			$svg = str_replace('<path ', '<path fill="#FFFFFF" ', $svg);
			$iconUrl = 'data:image/svg+xml;base64,' . base64_encode( $svg );
			add_menu_page(
				__( 'weeblrAMP', 'weeblramp' ),
				__( 'weeblrAMP', 'weeblramp' ),
				'manage_options',
				WeeblrampViewAdmin_Options::ROOT_MENU_PAGE,
				array( WeeblrampFactory::getThe( 'WeeblrampViewAdmin_Options' ), 'render' ),
				$iconUrl
			);
			$added = true;
		}
	}
}

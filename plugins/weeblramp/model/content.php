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

class WeeblrampModel_Content extends WeeblrampClass_Model {

	private $embedFiles = array(
		'WeeblrampModelEmbed_Gallery'
	);

	/**
	 * Stores 3rd-party embed handlers
	 *
	 * @var array
	 */
	private $additionalEmbedHandlers = array();

	/**
	 * Store post if one is passed
	 * @var null
	 */
	private $post = null;

	/**
	 * Cause WP to do content processing, based on settings:
	 *
	 * - either no processing
	 * - only shortcodes
	 * - apply 'the_content' filter (normal processing)
	 *
	 * @param string  $content
	 * @param WP_Post $post
	 *
	 * @return mixed|string
	 */
	public function doWPProcessing( $content, $post = null ) {

		$this->post = $post;

		// specifically remove disabled shortcodes from content;
		// as they were disabled, WP won't remove them
		$content = $this->removeDisabledShortcode( $content );

		// let WP process remaining codes, disabling wpautop
		// which really makes things more difficult
		$content = $this->processContent( $content );

		return $content;
	}

	/**
	 * Shortcodes handler for content goodies
	 *
	 * @param $content
	 *
	 * @return mixed
	 */
	public function doReplaceContentTagsShortcodes( $atts, $content, $tag ) {

		static $date = null;

		// date init
		if ( is_null( $date ) ) {
			$date = WblSystem_Date::toDateTimeObject(
				'now',
				WblWordpress_Helper::getTimezone()
			);
		}

		// handle shortcode
		switch ( $tag ) {
			case 'weeblramp_current_year':
				$format = 'Y';
				break;
			case 'weeblramp_current_fulldate':
				$format = get_option( 'date_format' );
				break;
			default:
				$format = '';
				break;
		}

		if ( ! empty( $format ) ) {
			$processed = $date->format( $format );
		} else {
			$processed = '';
		}

		return $processed;
	}

	private function processContent( $content ) {

		switch ( $this->userConfig->get( 'wp_processing_mode' ) ) {
			// standard WP the_content processing
			case ( WeeblrampConfig_User::WP_CONTENT_NORMAL ):

				// disable wpautop
				// which really makes things more difficult
				// NB: wpautop is still applied, but only on the
				// actual post content (see model/renderer.php)
				remove_filter( 'the_content', 'wpautop' );
				// set our filters and shortcodes
				$this->setEmbedHandlers()
					// add some goodies shortcodes
					 ->addReplaceContentTagsShortcodes();

				// apply filters
				$content = WblWordpress_Html::getTheContent( $content );

				// remove 3rd-party collected handlers
				// collect scripts
				$this->unsetEmbedHandlers();
				break;

			// only shortcodes
			case ( WeeblrampConfig_User::WP_CONTENT_SHORTCODES ):

				global $wp_filter;
				// nuke other filters and shortcodes
				$wp_filter['the_content'] = array();
				// restore only shortcodes processing
				add_filter( 'the_content', 'do_shortcode', 11 );

				// set back only our filters and shortcodes
				$this->setEmbedHandlers()
					// add some goodies shortcodes
					 ->addReplaceContentTagsShortcodes();

				// apply filters
				$content = WblWordpress_Html::getTheContent( $content );

				// remove 3rd-party collected handlers
				// collect scripts
				$this->unsetEmbedHandlers();
				break;

			// no the_content processing
			case ( WeeblrampConfig_User::WP_CONTENT_NONE ):

				// we still want our shortcodes executed
				// and custom embedhandlers executed

				global $wp_filter, $shortcode_tags;
				// nuke other filters and shortcodes
				$wp_filter['the_content'] = array();
				// restore only shortcodes processing
				add_filter( 'the_content', 'do_shortcode', 11 );
				// nuke all shortcodes (but don't strip them
				// from content, as Embed handlers may
				// implement some of them ("gallery" is built-in for instance)
				$shortCodesBackup = $shortcode_tags;
				remove_all_shortcodes();

				// set back only our filters and shortcodes
				// NB: Embed handlers may well set or handle shortcodes
				// so we have to delay stripping the shortcodes
				$this->setEmbedHandlers()
					// add some goodies shortcodes
					 ->addReplaceContentTagsShortcodes();

				// apply filters
				$content = WblWordpress_Html::getTheContent( $content );

				// now that all shortcodes have been processed
				// we can strip all the previously registered ones
				$shortcode_tags = $shortCodesBackup;
				$content        = strip_shortcodes( $content );

				// remove 3rd-party collected handlers
				// collect scripts
				$this->unsetEmbedHandlers();
				break;
		}

		return $content;
	}

	private function setEmbedHandlers() {

		// build a lis tof built-in handlers
		// according to the AMP plugin definition
		// NB: currently none of the handlers have parameters
		$embedHandlers = array();
		foreach ( $this->embedFiles as $className ) {
			$embedHandlers[ $className ] = array();
		}

		// let 3rd-party add their own
		$handlers = apply_filters(
			'amp_content_embed_handlers',
			$embedHandlers,
			$this->post
		);

		foreach ( $handlers as $className => $args ) {
			$handler = new $className( $args );

			if ( ! is_subclass_of( $handler, 'AMP_Base_Embed_Handler' ) ) {
				_doing_it_wrong( __METHOD__, sprintf( __( 'Embed Handler (%s) must extend `AMP_Embed_Handler`', 'amp' ), $className ), '0.1' );
				continue;
			}

			$handler->register_embed();
			$this->additionalEmbedHandlers[] = $handler;
		}

		return $this;
	}

	private function unsetEmbedHandlers() {

		$assetsCollector = WeeblrampFactory::getThe( 'WeeblrampModel_Assetscollector' );

		foreach ( $this->additionalEmbedHandlers as $handler ) {
			$scripts = $handler->get_scripts();
			if ( ! empty( $scripts ) ) {
				$assetsCollector->addScripts( $scripts );
			}

			if ( method_exists( $handler, 'weeblramp_get_styles' ) ) {
				$assetsCollector->addStyle( $handler->weeblramp_get_styles() );
			}
			// first collect any script
			$handler->unregister_embed();
		}

		return $this;
	}

	/**
	 * Utility to remove shortcodes disabled by user from some content
	 *
	 * @param string $content
	 *
	 * @return mixed
	 */
	private function removeDisabledShortcode( $content ) {

		$disabledCodes = $this->getDisabledShortCodes();
		if ( empty( $disabledCodes ) ) {
			return $content;
		}

		$regExp = get_shortcode_regex( $disabledCodes );

		$content = preg_replace( '/' . $regExp . '/su', '', $content );

		return $content;
	}

	/**
	 * Getter for the list of shortcodes the user has disabled, cleaned up
	 * and presented as an array of codes
	 *
	 * @return array
	 */
	private function getDisabledShortCodes() {

		static $codes = null;

		if ( is_null( $codes ) ) {
			$codes = array();

			$disabledCodes = $this->userConfig->get( 'shortcodes_disable_list' );
			if ( ! empty( $disabledCodes ) ) {
				// turn that list into an array
				$disabledCodes = WblSystem_Strings::stringToCleanedArray( $disabledCodes, PHP_EOL );
				if ( ! empty( $disabledCodes ) ) {
					$codes = $disabledCodes;
				}

				/**
				 * Filter the list of WordPress shortcodes to be disabled on AMP pages before rendering
				 *
				 * @api
				 * @package weeblrAMP\filter\output
				 * @var weeblramp_shortcodes_disable_list
				 * @since   1.0.0
				 *
				 * @param array $codes Array of shortcodes names
				 *
				 * @return array
				 */
				$codes = apply_filters( 'weeblramp_shortcodes_disable_list', $codes );
			}
		}

		return $codes;
	}

	/**
	 * Add shortcodes to search and replace for a few common tags
	 *
	 * @return mixed
	 */
	private function addReplaceContentTagsShortcodes() {

		add_shortcode( 'weeblramp_current_year', array( $this, 'doReplaceContentTagsShortcodes' ) );
		add_shortcode( 'weeblramp_current_fulldate', array( $this, 'doReplaceContentTagsShortcodes' ) );

		return $this;
	}
}

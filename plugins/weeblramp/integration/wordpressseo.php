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
 * Integration with Yoast SEO
 *
 */
class WeeblrampIntegration_Wordpressseo extends WeeblrampClass_Integration {

	protected $id = 'wordpress-seo/wp-seo.php';

	protected $filters = array(
		array(
			'filter_name'   => 'weeblramp_config_set_defaults',
			'method'        => 'setConfigDefaults',
			'priority'      => 10,
			'accepted_args' => 1
		),
		array(
			'filter_name'   => 'weeblramp_json_manifest',
			'method'        => 'getJsonLd',
			'priority'      => 10,
			'accepted_args' => 2
		),
		array(
			'filter_name'   => 'weeblramp_get_metadata',
			'method'        => 'getMetadata',
			'priority'      => 10,
			'accepted_args' => 2
		),
		array(
			'filter_name'   => 'weeblramp_get_ogp',
			'method'        => 'getOgp',
			'priority'      => 10,
			'accepted_args' => 2
		),
		array(
			'filter_name'   => 'weeblramp_get_tcards',
			'method'        => 'getTCards',
			'priority'      => 10,
			'accepted_args' => 2
		)
	);

	/**
	 * Store WPSEO instance and options
	 *
	 * @var null|WPSEO_Frontend
	 */
	private $wpseo         = null;
	private $wpseo_options = null;

	/**
	 * Actual integration init, ran at WP init event
	 *
	 */
	public function init() {

		parent::init();

		if ( parent::isEnabled() ) {
			$this->wpseo         = WPSEO_Frontend::get_instance();
			$this->wpseo_options = WPSEO_Options::get_all();
		}
	}

	/**
	 * Pull some data from Yoast to serve as default values for config
	 *
	 * @param $config
	 *
	 * @return mixed
	 */
	public function setConfigDefaults( $config ) {

		// not enabled or not able to instantiate WPSEO, leave
		if ( ! $this->isEnabled() ) {
			return $config;
		}

		// if not active, disable the integration
		if ( ! $this->active && ! empty( $this->id ) ) {
			// site name
			$config['integrations_list'][ $this->id ] = 0;
		}

		// site name
		$config['site_name'] = wbInitEmpty( $config['site_name'], wbArrayGet( $this->wpseo_options, 'website_name' ) );

		// analytics id
		// Disabled: as of 03/17, it is still recommended to use a separate
		// WebProperty ID, to reduce incorrect sesssions and bounces counting
		// Pulling ID from Yoast would go against that.
		//if (empty($config['analytics_webproperty_id']))
		//{
		//	if (class_exists('Yoast_GA_Options'))
		//	{
		//		$id = Yoast_GA_Options::instance()->get_tracking_code();
		//		if (!empty($id))
		//		{
		//			$config['analytics_webproperty_id'] = $id;
		//		}
		//	}
		//}

		// publisher info, entered under Company name
		if ( empty( $config['publisher_name'] ) ) {
			$config['publisher_name'] = wbArrayGet( $this->wpseo_options, 'company_name', '' );
		}

		if ( empty( $config['publisher_image'] ) ) {
			$image = wbArrayGet( $this->wpseo_options, 'company_logo' );
			if ( ! empty( $image ) ) {
				$imageSize = WblHtmlContent_Image::getImageSize( $image );
				if ( WeeblrampClass_Configcheck::checkPublisherLogoSize( $imageSize['width'], $imageSize['height'] ) ) {
					$config['publisher_image']        = $image;
					$config['publisher_image_width']  = $imageSize['width'];
					$config['publisher_image_height'] = $imageSize['height'];
				}
			}
		}

		// Facebook App ID
		if ( empty( $config['facebook_app_id'] ) ) {
			$config['facebook_app_id'] = wbArrayGet( $this->wpseo_options, 'fbadminapp', '' );
		}

		// Twitter account
		if ( empty( $config['twitter_account'] ) ) {
			$account                   = wbArrayGet( $this->wpseo_options, 'twitter_site', '' );
			$config['twitter_account'] = empty( $account ) ? '' : '@' . $account;
		}

		// social profiles
		if ( empty( $config['struct_profiles_social'] ) ) {
			$profiles = array();

			// twitter
			if ( ! empty( $config['twitter_account'] ) ) {
				$profiles[] = 'https://www.twitter.com/' . wbArrayGet( $this->wpseo_options, 'twitter_site' );
			}

			$options = array(
				'facebook_site',
				'instagram_url',
				'linkedin_url',
				'myspace_url',
				'pinterest_url',
				'youtube_url',
				'google_plus_url'
			);
			foreach ( $options as $option ) {
				if ( ! empty( $this->wpseo_options[ $option ] ) ) {
					$profiles[] = $this->wpseo_options[ $option ];
				}
			}

			if ( ! empty( $profiles ) ) {
				$config['struct_profiles_social'] = implode( PHP_EOL, $profiles );
			}
		}

		return $config;
	}

	/**
	 * Read main OGP data from Yoast, to get per page, user-defined values
	 *
	 * @param $ogp
	 *
	 * @return mixed
	 */
	public function getOgp( $ogp, $pageData ) {

		// not enabled or not able to instantiate WPSEO, leave
		if ( ! $this->isEnabled() ) {
			return $ogp;
		}

		// Yoast attaches multiple filters and action
		// which would break AMP pages, such as OGP prefix in <html> tag
		// so we do not use let it output ogp tags (and others), but instead
		// retrieve the data from the output captured
		global $wp_filter;
		$filtersBackup = $wp_filter;
		$ogpModel      = new WPSEO_OpenGraph;
		$wp_filter     = $filtersBackup;

		// we can get title, description and image
		$ogp['title']       = wbInitEmpty( $ogpModel->og_title( false ), $ogp['title'] );
		$ogp['description'] = wbInitEmpty( $ogpModel->description( false ), $ogp['description'] );

		if ( 1 == count( $pageData['main_content'] ) ) {
			$image = WPSEO_Meta::get_value( 'opengraph-image', $pageData['main_content'][0]['post']->ID );
			if ( ! empty( $image ) ) {
				$imageSize           = WblHtmlContent_Image::getImageSize( $image );
				$ogp['image']        = $image;
				$ogp['image_width']  = $imageSize['width'];
				$ogp['image_height'] = $imageSize['height'];
			}
		}

		return $ogp;
	}

	/**
	 * Get Twitter cards per page user-defined values
	 *
	 * @param $tcards
	 * @param $pageData
	 *
	 * @return mixed
	 */
	public function getTCards( $tcards, $pageData ) {

		// not enabled or not able to instantiate WPSEO, leave
		if ( ! $this->isEnabled() ) {
			return $tcards;
		}

		// harder to extract data from Yoast Twitter object
		ob_start();
		WPSEO_Twitter::get_instance();
		$output = ob_get_clean();

		$rawBits    = WblSystem_Strings::stringToCleanedArray( $output, '<meta' );
		$parsedBits = array();
		foreach ( $rawBits as $bit ) {
			$bit                 = wbRTrim( $bit, '/>' );
			$parsedBit           = WblSystem_Strings::parseAttributes( $bit );
			$name                = str_replace( 'twitter:', '', $parsedBit['name'] );
			$parsedBits[ $name ] = $parsedBit['content'];
		}

		$tcards['title']       = wbInitEmpty( wbArrayGet( $parsedBits, 'title' ), $tcards['title'] );
		$tcards['description'] = wbInitEmpty( wbArrayGet( $parsedBits, 'description' ), $tcards['description'] );
		if ( 1 == count( $pageData['main_content'] ) ) {
			$image = wbArrayGet( $parsedBits, 'image' );
			if ( ! empty( $image ) ) {
				$imageSize              = WblHtmlContent_Image::getImageSize( $image );
				$tcards['image']        = $image;
				$tcards['image_width']  = $imageSize['width'];
				$tcards['image_height'] = $imageSize['height'];
			}
		}

		return $tcards;
	}

	public function getJsonLd( $jsonld, $data ) {

		// not enabled or not able to instantiate WPSEO, leave
		if ( ! $this->isEnabled() ) {
			return $jsonld;
		}

		return $jsonld;
	}

	/**
	 * @param $metaData
	 *
	 * @return mixed
	 */

	public function getMetadata( $metaData, $pageData ) {

		// not enabled or not able to instantiate WPSEO, leave
		if ( ! $this->isEnabled() ) {
			return $metaData;
		}

		// we're good, collect information from wpseo

		$description = $this->wpseo->metadesc( false );
		if ( $description ) {
			$metadata['description'] = $description;
		}

		return $metaData;
	}

	/**
	 * Returns true if this integration is available, ie if the
	 * corresponding plugin or service is installed and activated
	 *
	 * @return bool
	 */
	protected function discover() {

		return defined( 'WPSEO_FILE' );
	}

	/**
	 * Shorthand for integration enabled
	 *
	 * @return bool
	 */
	protected function isEnabled() {

		return parent::isEnabled() && ! empty( $this->wpseo ) && ! empty( $this->wpseo_options );
	}
}

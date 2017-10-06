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

use Weeblr\Wblib\Joomla\StringHelper\StringHelper;
use Weeblr\Wblib\Joomla\Uri\Uri;

// Security check to ensure this file is being included by a parent file.
defined( 'WEEBLRAMP_EXEC' ) || die;

/**
 * Updates to a standard HTML page, which has an AMP version
 */
class WeeblrampClass_Configcheck extends WeeblrampClass_Base {

	const NOTIFY = 'notify*';
	const LOG = 'log';

	/**
	 * Hold a list of check methods to run,
	 * based on current settings page being displayed
	 *
	 * @var array
	 */
	private $checksList = array(
		WeeblrampViewAdmin_Options::SETTINGS_PAGE => array(
			'checkLogoDimensions',
			'invalidPageImageFallbackWarning',
			'invalidCustomCSSWarning',
			'analyticsPropertyId',
			'ampSocialShareFbAppid',
			'disqusEndpoint'
		)
	);

	/**
	 * Handle on admin notifier
	 * @var WblSystem_Notices
	 */
	private $notifier = null;

	/**
	 * Flag to disable admin notifications
	 * @var bool
	 */
	private $notificationType = self::NOTIFY;

	/**
	 * Constructor
	 *
	 * @param   array $options An array of options.
	 */
	public function __construct( $options = array() ) {

		parent::__construct( $options );

		// store an instance of the notifier
		$this->notifier = WeeblrampFactory::getThe( 'WblSystem_Notices' );
	}

	/**
	 * Public helper to check publisher logo size against AMP rules
	 *
	 * @param int $width
	 * @param int $height
	 *
	 * @return bool
	 */
	public static function checkPublisherLogoSize( $width, $height ) {

		$valid        = true;
		$requiredSize = WeeblrampFactory::getThe( 'weeblramp.config.amp' )->get( 'publisherLogoSize' );
		if (
			( ! empty( $width ) && $width != $requiredSize['width'] )
			&&
			( ! empty( $height ) && $height != $requiredSize['height'] )
		) {
			$valid = false;
		}

		return $valid;
	}

	/**
	 * Execute all configuration checks
	 *
	 * @param string $settingsPage
	 * @param string $notificationType
	 */
	public function execute( $settingsPage, $notificationType = self::NOTIFY ) {

		// set/reset notification type
		$this->notificationType = $notificationType;

		// run all config checks
		$list = wbArrayGet( $this->checksList, $settingsPage );
		if ( ! empty( $list ) ) {
			foreach ( $list as $method ) {
				$this->{$method}();
			}
		}
	}

	/**
	 * If a publisher logo has been entered, it must
	 * match rules on its size
	 *
	 * https://developers.google.com/structured-data/carousels/top-stories#logo_guidelines
	 *
	 */
	private function checkLogoDimensions() {

		// if filled in, the publisher logo must
		// fit within 600px x 60px
		// height should be 60 or width should be 600px
		$logoUrl = $this->userConfig->get( 'publisher_image' );
		if ( ! empty( $logoUrl ) ) {
			$logoSize = WblHtmlContent_Image::getImageSize( $logoUrl );
			if ( ! self::checkPublisherLogoSize( $logoSize['width'], $logoSize['height'] ) ) {
				$this->notify(
					__( 'Invalid logo dimensions' )
					. ' '
					. __( 'You have entered a <em>Publisher logo URL</em>, under the <em>Meta data tab</em>, but the dimensions of this image are not valid. Height must be 60 pixels (best), or width must be 600 px.' ),
					WblSystem_Notices::ALERT
				);
			}
		}
	}

	/**
	 * Display an info reminder, page fallback image is not large enough
	 *
	 * @return $this
	 */
	private function invalidPageImageFallbackWarning() {

		if ( WeeblrampHelper_Version::isFullEdition() ) {
			$fallbackURL = $this->userConfig->get( 'pages_fallback_image', '' );
			if ( ! empty( $fallbackURL ) ) {
				$fallbackImage = WblSystem_Route::absolutify( $fallbackURL, true );
				$pageImageSize = WblHtmlContent_Image::getImageSize( $fallbackImage );
				$pageImageSize = WeeblrampHelper_Media::findImageSizeIfMissing( $fallbackImage, $pageImageSize );
				if ( empty( $pageImageSize['width'] ) || empty( $pageImageSize['height'] ) || $pageImageSize['width'] < $this->ampConfig->get( 'pageImageMinWidth' ) ) {
					$this->notify(
						sprintf(
							__(
								'You selected a fallback for page image, but this image is not wide enough (or we didn\'t find it). It should be at least %d pixels wide. Its width and height should also be entered if the image does not reside on your server.'
							),
							$this->ampConfig->get( 'pageImageMinWidth' )
						),
						WblSystem_Notices::ALERT
					);
				}
			}
		}
	}

	/**
	 * Display a warning if some suspicious CSS is seen in the custom CSS
	 *
	 * @return $this
	 */
	private function invalidCustomCSSWarning() {

		$invalidCss = array(
			'no_important' => array(
				'reg' => '/\!\s*important/i',
				'msg' => '<i>!important</i> tag is invalid.'
			)
		);

		$msgs      = array();
		$customCss = $this->customizeConfig->get( 'custom_css' );
		if ( ! empty( $customCss ) ) {
			foreach ( $invalidCss as $key => $cssRule ) {
				// simple text found
				if ( ! empty( $cssRule['txt'] ) ) {
					if ( strpos( $customCss, $cssRule['txt'] ) !== false ) {
						$msgs[] = __( $cssRule['msg'] );
					}
				}

				// reg exp test
				if ( ! empty( $cssRule['reg'] ) ) {
					if ( preg_match( $cssRule['reg'], $customCss ) ) {
						$msgs[] = __( $cssRule['msg'] );
					}
				}
			}

			if ( ! empty( $msgs ) ) {
				$this->notify(
					__( 'We found some suspicious CSS in the <strong>Custom CSS</strong> field. Please refer to the <a href="https://www.ampproject.org/docs/guides/responsive/style_pages.html" target="_blank">AMP project guidelines</a>. Details:' )
					. ' '
					. implode( ',', $msgs )
				);
			}
		}

		return $this;
	}

	private function analyticsPropertyId() {

		if ( WeeblrampHelper_Version::isFullEdition() ) {
			if ( WeeblrampConfig_User::ANALYTICS_NONE != $this->userConfig->get( 'analytics_type' ) && $this->userConfig->isFalsy( 'analytics_webproperty_id' ) ) {
				$this->notify(
					__( 'You have enabled Analytics, but did not set yet an analytics web property ID. Analytics will not be able to record traffic data on your site.' )
				);
			}
		}
	}

	/**
	 * amp-social-share for facebook button requires an app id
	 */
	private function ampSocialShareFbAppid() {

		if ( WeeblrampHelper_Version::isFullEdition() ) {
			$buttonsEnabled         = $this->customizeConfig->get( 'social_buttons_types' );
			$facebookSharingEnabled = ! empty( $buttonsEnabled['facebook_share'] );
			if (
				WeeblrampConfig_Customize::SOCIAL_BUTTONS_LOCATION_NONE != $this->customizeConfig->get( 'social_buttons_location' )
				&& WeeblrampConfig_Customize::SOCIAL_BUTTONS_TYPE_AMPSOCIAL == $this->customizeConfig->get( 'social_buttons_type' )
				&& $facebookSharingEnabled
				&& $this->userConfig->isFalsy( 'facebook_app_id' )
			) {
				$this->notify(
					__( 'You have enabled amp-social sharing buttons, including a Facebook button, but you have not yet entered a <strong>Facebook App Id</strong> (under the <strong>SEO</strong> tab). This button cannot work without an app id, so we will hide it until you have one.' )
				);
			}
		}
	}

	/**
	 * If disqus is used for comment, and an endpoint has been specified,
	 * it must be:
	 * - over https
	 * - on a separate domain
	 */
	private function disqusEndpoint() {

		if ( WeeblrampHelper_Version::isFullEdition() ) {
			$endpoint = StringHelper::trim(
				$this->userConfig->get( 'comment_disqus_endpoint' )
			);
			if (
				WeeblrampConfig_User::COMMENTS_DISQUS == $this->userConfig->get( 'commenting_system' )
				&&
				( ! empty( $endpoint ) )
			) {
				$messages = array();
				// is the endpoint over https
				if ( ! wbStartsWith( $endpoint, 'https://' )
				) {
					$messages[] = __(
						' the endpoint is not hosted on <strong>HTTPS</strong>',
						'weeblramp'
					);
				}

				$thisHost     = StringHelper::strtolower(
					WblWordpress_Helper::getSiteUrl(
						array( 'scheme', 'host' )
					)
				);
				$endpointUri  = new Uri( $endpoint );
				$endpointHost = StringHelper::strtolower(
					$endpointUri->toString(
						array( 'scheme', 'host' )
					)
				);
				if ( $endpointHost == $thisHost ) {
					$messages[] = __(
						' the endpoint is <strong>on the same domain</strong> (' . esc_html( $endpointHost ) . ') as this site, which is not allowed by AMP',
						'weeblramp'
					);
				}

				// build up full message and notify
				if ( ! empty( $messages ) ) {
					$message = 'Disqus commenting system is enabled, however'
					           . implode(
						           __( ' and ', 'weeblramp' ),
						           $messages
					           )
					           . '.';
					$this->notify( $message );
				}
			}
		}
	}

	/**
	 * Process an error notification according to current settings
	 *
	 * @param $message
	 */
	private function notify( $message, $type = WblSystem_Notices::ERROR ) {

		switch ( $this->notificationType ) {
			case self::LOG:
				WblSystem_Log::error( $message );
				break;
			default:
				$this->notifier->add(
					$message,
					$type
				);
				break;
		}
	}
}

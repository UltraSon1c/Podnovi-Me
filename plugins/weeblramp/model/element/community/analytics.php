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

// Security check to ensure this file is being included by a parent file.
defined( 'WEEBLRAMP_EXEC' ) || die;

class WeeblrampModelElement_Analytics extends WeeblrampClass_Base {

	const EVENT_TRACKING_RULE_SEPARATOR = '|';

	/**
	 * Adds a Google Analytics tracking tag
	 * with various user-set options
	 *
	 */
	public function getData( $pageData ) {

		$analyticsData = array(
			'config'      => array(),
			'consent'     => false,
			'credentials' => ''
		);

		// no analytics
		if ( WeeblrampConfig_User::ANALYTICS_NONE == $this->userConfig->get( 'analytics_type' ) ) {
			return $analyticsData;
		}

		// compute a consent id if user-notification is enabled
		if ( $this->userConfig->isTruthy( 'analytics_require_consent' ) ) {
			// User wants analytics collection to start only after visitor consented
			// Was a user notification enabled?
			$userNotification = wbArrayGet( $pageData, 'user-notification' );
			if ( ! empty( $userNotification ) && ! empty( $userNotification['button'] ) ) {
				// there is a user notification set, and it has some button
				// use that
				$analyticsData['consent'] = ' data-consent-notification-id="' . $userNotification['id'] . '"';
			}
		}

		// Did user allow setting cookies across analytics request domains?
		// Required for Google Tag Manager
		if (
			$this->userConfig->isTruthy( 'analytics_data_credentials' )
			||
			WeeblrampConfig_User::ANALYTICS_GTM == $this->userConfig->get( 'analytics_type' )
		) {
			$analyticsData['credentials'] = ' data-credentials="include"';
		}

		// Google Tag Manager: only data required is ID
		if ( WeeblrampConfig_User::ANALYTICS_GTM == $this->userConfig->get( 'analytics_type' ) ) {
			$analyticsData['config'] = array(
				'gtm_id' => trim( $this->userConfig->get( 'analytics_gtm_id' ) )
			);
			$result                  = array(
				'data'    => $analyticsData,
				'scripts' => array(
					'amp-analytics' => sprintf( WeeblrampModel_Renderer::AMP_SCRIPTS_PATTERN, 'analytics', WeeblrampModel_Renderer::AMP_SCRIPTS_VERSION )
				)
			);

			return $result;
		}

		// standard analytics:
		// build up the analytics parameters json object
		$analyticsData['config']['vars']     = array(
			'account' => $this->userConfig->get( 'analytics_webproperty_id' )
		);
		$analyticsData['config']['triggers'] = array(
			'wbTrackPageview' => array(
				'on'      => 'visible',
				'request' => 'pageview'
			)
		);

		// optionally add social networks tracking
		$analyticsData['config'] = $this->socialNetworksTracking( $analyticsData['config'], $pageData );

		// optionally add social other events tracking
		$analyticsData['config'] = $this->eventsTracking( $analyticsData['config'], $pageData );

		// finally link to amp analytics handler
		$result = array(
			'data'    => $analyticsData,
			'scripts' => array(
				'amp-analytics' => sprintf( WeeblrampModel_Renderer::AMP_SCRIPTS_PATTERN, 'analytics', WeeblrampModel_Renderer::AMP_SCRIPTS_VERSION )
			)
		);

		return $result;
	}

	/**
	 * Optionally adds social netowrks buttons tracking instructions to the Analytics json-ld snippet
	 *
	 * @param array $analyticsData Current set of analytics data
	 * @param array $pageData Current available data about the page being rendered
	 *
	 * @return mixed
	 */
	private function socialNetworksTracking( $analyticsData, $pageData ) {

		return $analyticsData;
	}

	/**
	 * Optionally adds events tracking instructions to the Analytics json-ld snippet
	 *
	 * @param array $analyticsData Current set of analytics data
	 * @param array $pageData Current available data about the page being rendered
	 *
	 * @return mixed
	 */
	private function eventsTracking( $analyticsData, $pageData ) {

		return $analyticsData;
	}

}

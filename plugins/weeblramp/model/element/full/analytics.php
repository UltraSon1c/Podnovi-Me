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

		if (
			WeeblrampConfig_Customize::SOCIAL_BUTTONS_LOCATION_NONE !== $this->customizeConfig->get( 'social_buttons_location' )
			&&
			WeeblrampConfig_Customize::SOCIAL_BUTTONS_TYPE_STATIC == $this->customizeConfig->get( 'social_buttons_type' )
		) {
			$types = $this->customizeConfig->get( 'social_buttons_types' );
			if ( ! empty( $types ) ) {
				foreach ( $types as $definition => $enabled ) {
					if ( $enabled ) {
						list( $network, $action ) = explode( '_', $definition );
						$socialData                                                                  = array(
							'on'       => 'click',
							'selector' => 'wbamp-button_' . $definition . '_1',
							'request'  => 'social',
							'vars'     => array(
								'socialNetwork' => ucfirst( $network ),
								'socialAction'  => ucfirst( $action ),
								'socialTarget'  => $pageData['canonical']
							)
						);
						$analyticsData['triggers'][ 'wbTrackSocialEvent_' . ucfirst( $definition ) ] = $socialData;
					}
				}
			}
		}

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

		$eventsTrackingDefinitions = WblSystem_Strings::stringToCleanedArray( $this->userConfig->get( 'analytics_tracked_events' ), "\n" );
		if ( ! empty( $eventsTrackingDefinitions ) ) {
			if ( $eventsTrackingDefinitions[0] == '-' ) {
				// globally disabled, by using a - as the first line
				return $analyticsData;
			}

			foreach ( $eventsTrackingDefinitions as $eventsTrackingDefinition ) {
				if ( ';' == StringHelper::substr( $eventsTrackingDefinition, 0, 1 ) ) {
					// line starts with a ;. It's a comment, skip
					continue;
				}
				$def      = WblSystem_Strings::stringToCleanedArray( $eventsTrackingDefinition, self::EVENT_TRACKING_RULE_SEPARATOR );
				$uniqueId = md5( $eventsTrackingDefinition );
				$valid    = false;
				if ( WeeblrampHelper_Route::pathRuleMatch( $def[0], $pageData['amp_path'] ) ) {
					switch ( $def[1] ) {
						// click, css_selector, eventCategory, eventAction [,eventLabel] [,eventValue]
						case 'click':
							if ( count( $def ) >= 5 ) {
								// build an id, based on the event action
								$vars = array(
									'eventCategory' => $def[3],
									'eventAction'   => $def[4]
								);
								if ( ! empty( $def[5] ) ) {
									$vars['eventLabel'] = $def[5];
								}
								if ( ! empty( $def[6] ) ) {
									$vars['eventValue'] = (int) $def[6];
								}

								$eventData = array(
									'on'       => 'click',
									'selector' => $def[2],
									'request'  => 'event',
									'vars'     => $vars
								);

								$valid = true;
							}
							break;
						// scroll, verticalBoundaries [,horizontalBoundaries]
						case 'scroll':
							if ( count( $def ) >= 6 ) {
								// scrollSpec must be an array
								$bits                               = WblSystem_Strings::stringToCleanedArray( JString::trim( $def[2], '[]' ), ',' );
								$scrollSpec                         = array(
									'verticalBoundaries' => $bits
								);
								$bits                               = WblSystem_Strings::stringToCleanedArray( JString::trim( $def[3], '[]' ), ',' );
								$scrollSpec['horizontalBoundaries'] = $bits;

								$vars = array(
									'eventCategory' => $def[4],
									'eventAction'   => $def[5]
								);
								if ( ! empty( $def[6] ) ) {
									$vars['eventLabel'] = $def[6];
								}
								if ( ! empty( $def[7] ) ) {
									$vars['eventValue'] = (int) $def[7];
								}

								$eventData = array(
									'on'         => 'scroll',
									'request'    => 'event',
									'scrollSpec' => $scrollSpec,
									'vars'       => $vars
								);
								$valid     = true;
							}
							break;
					}
				}

				// append to list of triggers
				if ( $valid ) {
					$analyticsData['triggers'][ 'wbampTrackEvent_' . $uniqueId ] = $eventData;
				}
			}
		}

		return $analyticsData;
	}

}

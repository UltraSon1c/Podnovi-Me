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
defined( 'WBLIB_ROOT_PATH' ) || die;

/**
 * Store and display admin notices
 */
class WblSystem_Notices {

	const ERROR = 'error';
	const WARNING = 'warning';
	const SUCCESS = 'success';
	const ALERT = 'alert';

	const CAN_DISMISS = 'can_dismiss';
	const CANNOT_DISMISS = 'cannot_dismiss';

	private $pages = null;

	private $notices = array(
		'error'   => array(),
		'warning' => array(),
		'success' => array(),
		'alert'   => array(),
	);

	/**
	 * Enqueue an admin notice for later display
	 *
	 * @param        $notice
	 * @param string $type
	 */
	public function add( $notice, $type = self::SUCCESS, $dismissable = self::CAN_DISMISS ) {

		if ( ! isset( $this->notices[ $type ] ) ) {
			wbThrow( new  InvalidArgumentException( 'Invalid admin notice type ' . $type ) );
		}

		$this->notices[ $type ][] = array(
			'notice'      => $notice,
			'dismissable' => $dismissable
		);
	}

	/**
	 * Add a page to the list of pages where we want
	 * to display our notices
	 *
	 * @param string $page
	 */
	public function addDisplayPage( $page ) {

		$this->pages[] = $page;
	}

	/**
	 * Action renderer for admin notices
	 *
	 * @return string
	 */
	public function adminActionRenderNotices( $typeFilters = array() ) {

		if ( $this->shouldShow() ) {
			if ( ! empty( $typeFilters ) ) {
				$notices = array_intersect_key(
					$this->notices,
					array_flip( $typeFilters )
				);
			} else {
				$notices = $this->notices;
			}

			// will hold rendered partials
			$__data = array( 'notices' => $notices );

			// display the fully rendered page
			echo WblMvcLayout_Helper::render( 'wblib.notices.notices', $__data, WBLIB_LAYOUTS_PATH );
		}
	}

	/**
	 * True if no page restriction was set, or the we are on one
	 * of the specified pages
	 *
	 * @return bool
	 */
	private function shouldShow() {

		return is_null( $this->pages ) || in_array( get_current_screen()->id, $this->pages );
	}
}

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

/**
 * Holds and manage data
 */
class WeeblrampClass_Model extends WeeblrampClass_Base {

	protected $router     = null;
	protected $__data     = null;
	protected $dataLoaded = false;

	/**
	 * Constructor
	 *
	 * @param   array $options An array of options.
	 *
	 */
	public function __construct( $options = array() ) {

		parent::__construct( $options );

		// add the router to all models
		$this->router = wbArrayGet( $options, 'router', WeeblrampFactory::getThe( 'WeeblrampClass_Route' ) );
	}

	/**
	 * update the data
	 */
	public function getData() {

		if ( $this->dataLoaded ) {
			return __data;
		}

		return $this->loadData()->__data;
	}

	/**
	 *  prepare the data
	 *
	 * @return $this
	 */
	protected function loadData() {

		return $this;
	}
}

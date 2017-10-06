<?php

// Used by some children
require_once( WEEBLRAMP_AMP__DIR__ . '/includes/utils/class-amp-html-utils.php' );

abstract class AMP_Base_Embed_Handler {
	protected $DEFAULT_WIDTH = 480;
	protected $DEFAULT_HEIGHT = 325;

	protected $args = array();
	protected $did_convert_elements = false;

	abstract function register_embed();
	abstract function unregister_embed();

	function __construct( $args = array() ) {
		$this->args = wp_parse_args( $args, array(
			'width' => $this->DEFAULT_WIDTH,
			'height' => $this->DEFAULT_HEIGHT,
		) );
	}

	public function get_scripts() {
		return array();
	}
}

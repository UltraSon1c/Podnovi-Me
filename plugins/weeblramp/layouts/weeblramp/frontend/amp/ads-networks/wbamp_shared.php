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

// no direct access
defined( 'WEEBLRAMP_EXEC' ) || die;

$this->get( 'assets_collector' )
     ->addScripts(
	     array(
		     'amp-ad' => sprintf( WeeblrampModel_Renderer::AMP_SCRIPTS_PATTERN, 'ad', WeeblrampModel_Renderer::AMP_SCRIPTS_VERSION ),
	     )
     )->addStyle(
		array(
			'ad'
		)
	);

$config      = $this->get( 'user_config' );
$placeholder = $config->get( 'ad_placeholder' );
$fallback    = $config->get( 'ad_fallback' );

if ( ! empty( $placeholder ) ) {
	echo "\n\t" . '<div placeholder>' . $placeholder . '</div>';
}

if ( ! empty( $fallback ) ) {
	echo "\n\t" . '<div fallback>' . $fallback . '</div>';
}

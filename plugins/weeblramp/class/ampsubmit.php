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

$edition = 'community';

if ( strpos( $edition, 'community' ) === false ) {
	$filename = __DIR__ . '/' . $edition . '/' . basename( __FILE__ );
} else {
	$filename = __DIR__ . '/full/' . basename( __FILE__ );
}

if ( file_exists( $filename ) ) {
	include_once $filename;
} else {
	throw new Exception( 'weeblrAMP: unsupported feature' );
}


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

if ( ! class_exists( 'AMP_Image_Dimension_Extractor' ) ) {
	class AMP_Image_Dimension_Extractor {

		static public function extract( $url ) {

			$dimensions = WblHtmlContent_Image::getImageSize( $url );

			return array( $dimensions['width'], $dimensions['height'] );
		}
	}
}


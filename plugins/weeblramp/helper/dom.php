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
 * Based on https://github.com/automattic/amp-wp
 * License: GPLv2 or later
 */
class WeeblrampHelper_Dom {

	public static function fromContent( $content ) {

		$libxml_previous_state = libxml_use_internal_errors( true );

		$dom = new DOMDocument;
		// Wrap in dummy tags, since XML needs one parent node.
		// It also makes it easier to loop through nodes.
		// We can later use this to extract our nodes.
		// Add utf-8 charset so loadHTML does not have problems parsing it. See: http://php.net/manual/en/domdocument.loadhtml.php#78243
		$result = $dom->loadHTML( '<html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"></head><body>' . $content . '</body></html>' );

		libxml_clear_errors();
		libxml_use_internal_errors( $libxml_previous_state );

		if ( ! $result ) {
			return false;
		}

		return $dom;
	}

	public static function fromDom( $dom ) {

		// Only want children of the body tag, since we have a subset of HTML.
		$out  = '';
		$body = $dom->getElementsByTagName( 'body' )->item( 0 );

		// remove CDATA from places where they cause amp elements to choke
		// #1: http://stackoverflow.com/questions/6685117/how-to-stop-php-domdocumentsavexml-from-inserting-cdata
		// --> use DOM processing
		// #2: http://stackoverflow.com/questions/8283588/how-to-remove-cdata-and-end
		// --> use a global regexp
		// Using #1 in case there are other script tags in the future that may require CDATA?
		$replaced = false;
		$scripts  = $body->getElementsByTagName( 'script' );
		if ( ! empty( $scripts ) ) {
			foreach ( $scripts as $scriptElement ) {
				$elementParent = $scriptElement->parentNode;
				if ( ! empty( $elementParent ) ) {
					$replaced                 = true;
					$scriptElement->nodeValue = str_replace(
						array(
							'&',
							'<',
							'>'
						),
						array(
							'__WBAMP_ESCAPE_CHAR_AMPERSAND__',
							'__WBAMP_ESCAPE_CHAR_LT__',
							'__WBAMP_ESCAPE_CHAR_GT__'
						),
						$scriptElement->nodeValue
					);
				}
			}
		}

		// finally output to text
		foreach ( $body->childNodes as $node ) {
			$out .= $dom->saveXML( $node, LIBXML_NOEMPTYTAG );
		}

		// put back in replaced characters
		if ( $replaced ) {
			$out = str_replace(
				array(
					'__WBAMP_ESCAPE_CHAR_AMPERSAND__',
					'__WBAMP_ESCAPE_CHAR_LT__',
					'__WBAMP_ESCAPE_CHAR_GT__'
				),
				array(
					'&',
					'<',
					'>'
				),
				$out
			);
		}

		// very special case: when including json inside an HTML element attribute (doubleclick ads)
		// the json must have double quotes (otherwise it's not decoded into an object by javascript)
		// but when using saveXML(), PHP normalize attributes and put double-quotes around them
		$out = str_replace( '"__WBAMP_ESCAPE_START_QUOTE_IN_ATTR__', "'", $out );
		$out = str_replace( '__WBAMP_ESCAPE_END_QUOTE_IN_ATTR__"', "'", $out );
		$out = str_replace( '__WBAMP_ESCAPE_QUOTE_IN_ATTR__', '"', $out );

		$out = self::filterHtml( $out );

		return $out;
	}

	/**
	 * Handle some unusual cases of HTML that needs
	 * specific processing for AMP
	 *
	 * @param string $content
	 *
	 * @return mixed
	 */
	private static function filterHtml( $content ) {

		/**
		 * We must use LIBXML_NOEMPTYTAG when collecting back our page content
		 * from the DOMDocument used to process it, because the AMP runtime
		 * has issues with self-closing tags (https://github.com/ampproject/amphtml/issues/360
		 * and https://github.com/ampproject/amphtml/issues/362)
		 *
		 * This causes <br> or <br /> in content to be output as
		 * <br></br>, which should be OK but is interpreted as
		 * 2 consecutives <br /> tags instead of one by at least Chrome and Firefox (04/2016)
		 *
		 * We choose to simply replace those instances with self-closing tag
		 * which does not seem to be an issue for the AMP runtime.
		 *
		 */
		$tags = WeeblrampFactory::getThe( 'weeblramp.config.amp' )->get( 'self_closing_tags' );
		foreach ( $tags as $tag ) {
			$content = str_replace( '></' . $tag . '>', ' />', $content );
		}

		/**
		 * Same kind of stuff: saveXml() convert end-of-line into &#13;
		 */
		$content = str_replace( '&#13;', '', $content );

		return $content;
	}
}

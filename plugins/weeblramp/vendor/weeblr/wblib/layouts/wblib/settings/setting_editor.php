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

$details    = $this->getAsArray( 'details', array() );
$attributes = wbArrayGet( $details, 'attr', array() );

// WP renders the full editor
wp_editor(
	$this->get( 'current_value' ),
	wbArrayGet( $details, 'id', WblSystem_Strings::asHtmlId( $details['name'] ) ),
	array(
		'textarea_name' => $details['name'],
		'teeny'         => true,
		'editor_class'  => wbArrayGet( $attributes, 'class', '' ),
	)
);

echo '<span id="' . WblSystem_Strings::asHtmlId( $this->getAsAttr( 'name' ) ) . '" ' . WblHtml_Helper::attrToHtml( $this->get( 'show-if-attrs' ) ) . '></span>';

// append the description
echo WblMvcLayout_Helper::render( 'wblib.settings.setting_description', $this->getDisplayData(), WBLIB_LAYOUTS_PATH );

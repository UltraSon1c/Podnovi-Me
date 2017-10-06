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

$details = $this->getAsArray( 'details' );

// set some defaults if missing
wbArrayKeyInit( $details['content']['attr'], 'name', $this->get( 'name' ) );
wbArrayKeyInit( $details['content']['attr'], 'id', $this->getAsId( 'name' ) );
wbArrayKeyInit( $details['content']['attr'], 'class', 'large-text code' );

// optional description
if ( ! empty( $__data['desc'] ) ) {
	$details['content']['attr']['aria-describedby'] = $this->getAsId( 'name' ) . '_description';
}
// turn into text
$attributes = WblHtml_Helper::attrToHtml( $details['content']['attr'] );

?>
<textarea <?php echo $this->hasDisplayData('disabled') ? ' disabled="disabled"' : ''; ?> <?php echo WblHtml_Helper::attrToHtml( $this->get( 'show-if-attrs' ) ); ?> <?php echo $attributes; ?>><?php echo $this->get( 'current_value' ); ?></textarea>
<?php echo WblMvcLayout_Helper::render( 'wblib.settings.setting_description', $this->getDisplayData(), WBLIB_LAYOUTS_PATH ); ?>


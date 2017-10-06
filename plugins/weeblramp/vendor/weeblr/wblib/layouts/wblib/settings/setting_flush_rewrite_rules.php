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

// optional description
if ( ! empty( $details['desc'] ) ) {
	$details['content']['attr']['aria-describedby'] = $this->getAsId( 'name' ) . '_description';
}
// turn into text
$attributes = WblHtml_Helper::attrToHtml( $details['content']['attr'] );

?>
<button <?php echo WblHtml_Helper::attrToHtml( $this->get( 'show-if-attrs' ) ); ?> type="button"
                                                                                   class="js-wbamp-flush-rewrite-rules-button wbamp-flush-rewrite-rules-button button"
	<?php echo $attributes; ?>
>
	<?php _e( 'Flush rules now' ); ?>
</button>
<div class="wbamp-flush-rewrite-rules-msg wbamp-ajax-response-msg">
    <div id="js-wbamp-flush-rewrite-rules-msg"></div>
    <div id="js-wbamp-flush-rewrite-rules-spinner"></div>
</div>
<?php echo WblMvcLayout_Helper::render( 'wblib.settings.setting_description', $this->getDisplayData(), WBLIB_LAYOUTS_PATH ); ?>

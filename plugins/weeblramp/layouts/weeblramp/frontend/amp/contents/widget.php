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

// no direct access
defined('WEEBLRAMP_EXEC') || die;

if (
	!$this->hasDisplayData('widget_name')
	||
	!is_active_sidebar($this->get('widget_name'))
)
{
	return;
}
?>
<div class="wbamp-block wbamp-widget-area <?php echo $this->getAsAttr('widget_name'); ?>" role="complementary">
	<?php
	dynamic_sidebar(
		$this->get('widget_name')
	);
	?>
</div>

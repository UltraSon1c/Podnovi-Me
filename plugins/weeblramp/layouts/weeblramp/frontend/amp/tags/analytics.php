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
defined('WEEBLRAMP_EXEC') || die;

if (!$this->hasDisplayData('analytics_data'))
{
	return;
}

?>
<!-- weeblrAMP: Google Analytics definition -->
<amp-analytics type="googleanalytics" id="wbamp_analytics_1" <?php echo $this->getInArray('analytics_data', 'credentials'); ?>
	<?php echo $this->getInArray('analytics_data', 'consent'); ?>>
	<script type="application/json">
<?php echo WblSystem_Strings::jsonPrettyPrintAndUnescapeSlashes($this->getInArray('analytics_data', 'config')); ?>
	</script>
</amp-analytics>
<!-- weeblrAMP: Google Analytics definition -->

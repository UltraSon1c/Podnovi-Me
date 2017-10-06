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

if (!$this->hasDisplayData('json'))
{
	return;
}
?>
	<!-- <?php echo $this->get('title'); ?> -->
<script type="application/ld+json">
<?php
	echo WblSystem_Strings::jsonPrettyPrintAndUnescapeSlashes(
		$this->get('json')
	);
	?>
</script>
	<!-- <?php echo $this->get('title'); ?> -->

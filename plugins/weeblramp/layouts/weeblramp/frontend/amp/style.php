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

use Weeblr\Wblib\Joomla\StringHelper\StringHelper;

// no direct access
defined('WEEBLRAMP_EXEC') || die;

// raw CSS is split in 3:
// standard CSS
// $css['template']
// filtering by other extensions and themes
// $css['theme']
// override with CSS entered by user in plugin settings
// $css['user']

// output
$customCss = StringHelper::trim(
	implode("\n", $this->get('css'))
);
if (empty($customCss))
{
	return;
}
?>
<!-- weeblrAMP: custom styles -->
	<style amp-custom>
	<?php echo $customCss . "\n";	?>
	</style>
	<!-- weeblrAMP: custom styles -->

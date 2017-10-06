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

$id = $this->hasDisplayData('ad_id') ? $this->getAsId('ad_id') : '1';

?>

<div class="wbamp-block wbamp-ad">
	<div class="wbamp-amp-tag wbamp-adsense" id="wbamp-adsense-<?php echo $id; ?>">
		<amp-ad width="<?php echo $this->get('user_config')->get('ad_width'); ?>"
		        height="<?php echo $this->get('user_config')->get('ad_height'); ?>"
		        type="adsense"
		        data-ad-client="<?php echo $this->get('user_config')->get('adsense-ad-client'); ?>"
		        data-ad-slot="<?php echo $this->get('user_config')->get('adsense-ad-slot'); ?>">
			<?php echo WblMvcLayout_Helper::render('weeblramp.frontend.amp.ads-networks.wbamp_shared', $this->getDisplayData(), WEEBLRAMP_LAYOUTS_PATH); ?>
		</amp-ad>
	</div>
</div>

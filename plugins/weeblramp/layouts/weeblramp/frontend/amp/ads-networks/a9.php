<?php
/**
 * @ant_title_ant@
 *
 * @author      @ant_author_ant@
 * @copyright   @ant_copyright_ant@
 * @package     @ant_package_ant@
 * @license     @ant_license_ant@
 * @version     @ant_version_ant@
 * @date        @ant_current_date_ant@
 */

// no direct access
defined('WEEBLRAMP_EXEC') || die;

$id = $this->hasDisplayData('ad_id') ? $this->getAsId('ad_id') : '1';

?>

<div class="wbamp-block wbamp-ad">
	<div class="wbamp-amp-tag wbamp-a9" id="wbamp-a9-<?php echo $id; ?>">
		<amp-ad width="<?php echo $this->get('user_config')->get('ad_width'); ?>"
		        height="<?php echo $this->get('user_config')->get('ad_height'); ?>"
		        type="a9"
		        data-aax_size="<?php echo $this->get('user_config')->get('ad_width') . 'x' . $this->get('user_config')->get('ad_height'); ?>"
		        data-aax_pubname="<?php echo $this->get('user_config')->get('a9-aax_pubname'); ?>"
		        data-aax_src="<?php echo $this->get('user_config')->get('a9-aax_src'); ?>">
			<?php echo WblMvcLayout_Helper::render('weeblramp.frontend.amp.ads-networks.wbamp_shared', $this->getDisplayData(), WEEBLRAMP_LAYOUTS_PATH); ?>
		</amp-ad>
	</div>
</div>

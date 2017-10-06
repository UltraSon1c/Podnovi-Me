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

if (!$this->hasDisplayData('social_buttons', 'types'))
{
	return;
}

?>

<!-- weeblrAMP: social sharing buttons -->
<div
        class="wbamp-block wbamp-social-buttons  wbamp-icons-<?php echo $this->getInArray('social_buttons', 'theme') ?> wbamp-<?php echo $this->getInArray('social_buttons', 'style') ?>">
	<?php
	$buttons = array();
	foreach ($this->getInArray('social_buttons', 'types') as $buttonType => $enabled)
	{
		if ($enabled)
		{
			$button = WblMvcLayout_Helper::render(
				'weeblramp.frontend.amp.buttons.amp-social-share',
				array(
					'button_type' => $buttonType,
					'user_config' => $this->get('user_config'),
					'system_config' => $this->get('system_config')
				),
				WEEBLRAMP_LAYOUTS_PATH
			);

			$buttons[] = $button;
		}
	}
	if (!empty($buttons))
	{
		echo implode("\n\t", $buttons);
	}
	?>

</div>
<!-- weeblrAMP: social sharing buttons -->

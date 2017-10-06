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

// analytics
if (WeeblrampConfig_User::ANALYTICS_STANDARD == $this->get('user_config')->get('analytics_type'))
{
	echo WblMvcLayout_Helper::render('weeblramp.frontend.amp.tags.analytics', $this->getDisplayData(), WEEBLRAMP_LAYOUTS_PATH);
}

?>
<div class="wbamp-wrapper wbamp-wrapper-header">
	<?php

	// Header: link to home and/or logo
	echo WblMvcLayout_Helper::render('weeblramp.frontend.amp.header', $this->getDisplayData(), WEEBLRAMP_LAYOUTS_PATH);

	?>
</div>

<div class="wbamp-wrapper wbamp-wrapper-content wbamp-h-padded">
	<?php

	// Main content
	echo WblMvcLayout_Helper::render('weeblramp.frontend.amp.contents.' . $this->get('request_type'), $this->getDisplayData(), WEEBLRAMP_LAYOUTS_PATH);

	?>
</div>


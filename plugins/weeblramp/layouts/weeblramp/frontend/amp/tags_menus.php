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

// first is Google Tag Manager, right after body tag
if (WeeblrampConfig_User::ANALYTICS_GTM == $this->get('user_config')->get('analytics_type'))
{
	echo WblMvcLayout_Helper::render('weeblramp.frontend.amp.tags.analytics_gtm', $this->getDisplayData(), WEEBLRAMP_LAYOUTS_PATH);
}

// then navigation
if (WeeblrampConfig_Customize::MENU_TYPE_NONE != $this->get('customize_config')->get('menu_type'))
{
	echo WblMvcLayout_Helper::render('weeblramp.frontend.amp.tags.menu_' . $this->get('customize_config')->get('menu_type'), $this->getDisplayData(), WEEBLRAMP_LAYOUTS_PATH);
}

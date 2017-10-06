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
defined('WBLIB_ROOT_PATH') || die;

foreach ($this->getAsArray('notices') as $type => $notices)
{
	echo WblMvcLayout_Helper::render('wblib.notices.notice', array('type' => $type, 'notices_group' => $notices), WBLIB_LAYOUTS_PATH);
}

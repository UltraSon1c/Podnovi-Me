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

if ($this->hasDisplayData('structured_data'))
{
	foreach ($this->getAsArray('structured_data') as $id => $data)
	{
		echo WblMvcLayout_Helper::render(
			'weeblramp.frontend.amp.generic_json',
			array(
				'json' => $data,
				'title' => 'weeblrAMP: schema.org ' . $id
			),
			WEEBLRAMP_LAYOUTS_PATH
		);
	}
}

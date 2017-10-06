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

if ($this->hasDisplayData('metadata','publisher_id'))
{
	$publisherUrl = 'https://plus.google.com/' . $this->getInArray('metadata','publisher_id');
	echo "\t<!-- weeblrAMP: Publisher ID -->";
	echo "\n\t" . '<link href="' . $publisherUrl . '" rel="publisher" />';
	echo "\n\t<!-- weeblrAMP: Publisher ID -->";
}

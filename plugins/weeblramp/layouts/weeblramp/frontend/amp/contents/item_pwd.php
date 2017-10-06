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

// display information for a password protected post

$userConfig = $this->get('user_config');

// standalone mode, we don't have a way to let user enter a password. Yet.
if (WeeblrampConfig_User::OP_MODE_STANDALONE == $userConfig->get('op_mode'))
{ ?>
	<div class="wbamp-pwd-btn">
		<p><?php echo __('Sorry, this content is password protected.'); ?></p>
	</div>
	<?php
}
else
{
	// other modes: send visitor to standard HTML version of this page, to enter password
	?>
	<div class="wbamp-pwd-btn">
		<p><?php echo __('This content is password protected. Please click on the button below to enter your password.'); ?></p>
		<a class="wbamp-pwd-btn"
		   href="<?php echo esc_url(get_permalink($this->getinObject('post', 'ID'))); ?>">Go to password entry form</a>
	</div>
	<?php
}

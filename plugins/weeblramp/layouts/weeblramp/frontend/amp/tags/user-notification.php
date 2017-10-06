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

// no text, no show
if (!$this->hasDisplayData('text'))
{
	return '';
}

// data preparation
$buttonText = $this->get('button', '');
$id = $this->get('id');

if ($this->hasDisplayData('do_dismiss'))
{
	$on = ' on="tap:' . $id . '.dismiss"';
}
else
{
	$on = '';
}

if ($this->hasDisplayData('show_href'))
{
	$showHref = ' data-show-if-href="' . $this->getAsAbsoluteURl('show_href') . '"';
}
else
{
	$showHref = '';
}

if ($this->hasDisplayData('dismiss_href'))
{
	$dismissHref = ' data-dismiss-href="' . $this->getAsAbsoluteURl('dismiss_href') . '"';
}
else
{
	$dismissHref = '';
}

?>
<div class="wbamp-user-notification wbamp-notification-<?php echo $this->get('theme'); ?>">
    <amp-user-notification layout="nodisplay" id="<?php echo $id; ?>"
    >
		<?php
		echo $this->get('text');
		if ($this->hasDisplayData('do_dismiss') && !empty($buttonText))
		{
			echo "\n<button" . $on . '>' . $buttonText . '</button>';
		}
		?>

    </amp-user-notification>
</div>

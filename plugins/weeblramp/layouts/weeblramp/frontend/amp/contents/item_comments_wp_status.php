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

?>
<div submit-success class="wbamp-form-status-success">
    <template type="amp-mustache">
        <div
                class="wbamp-form-status wbamp-form-status-success"><?php echo __('Thank you for leaving a comment! {{#message}}<br />{{{message}}}{{/message}} {{#link}}<a class="button wbamp-form-status-success" href="{{link}}">Click to refresh</a>{{/link}}', 'weeblramp'); ?></div>
    </template>
</div>
<div submit-error  class="wbamp-form-status-error">
    <template type="amp-mustache">
        <div
                class="wbamp-form-status wbamp-form-status-error"><?php echo __('Sorry, there was a problem posting your comment. {{#message}} {{{message}}}{{/message}}'); ?></div>
    </template>
</div>

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
defined( 'WEEBLRAMP_EXEC' ) || die;

if ( $showReplyTo && comments_open() ) : ?>
    <div class="wbamp-leave-comment">
        <a href="<?php echo $this->getAsUrl( 'canonical' ) . '#respond'; ?>" class="wbamp-leave-comment">Leave a comment</a>
    </div>
<?php endif;

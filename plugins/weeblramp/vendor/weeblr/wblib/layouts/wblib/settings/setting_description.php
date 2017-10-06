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
defined( 'WBLIB_ROOT_PATH' ) || die;

if ( ! empty( $__data['details']['desc'] ) ) : ?>
    <p class="description wblib-settings-description"
       id="<?php echo $this->getAsId( 'name' ); ?>_description"><?php echo $__data['details']['desc']; ?></p>
	<?php

endif;

echo WblMvcLayout_Helper::render( 'wblib.settings.setting_remote_help', $this->getDisplayData(), WBLIB_LAYOUTS_PATH );

$isDisabled = $this->hasDisplayData( 'disabled' );
if ( $isDisabled ) {
	echo WeeblrampHelper_Version::getEditionUpdateMessage( $this->getDisplayData() );
}


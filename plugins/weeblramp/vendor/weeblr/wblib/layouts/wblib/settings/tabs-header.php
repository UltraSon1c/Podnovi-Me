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

$settingsDefinition = $this->getAsArray( 'settings_definitions' );
reset( $settingsDefinition );
$firstTab = empty( $settingsDefinition ) ? '' : $settingsDefinition[0]['name'];
?>
<div id="wblib-settings-tabs" data-page-id="<?php echo $this->getAsAttr( 'settings_page' ); ?>" class="tab-header"
     style="display:none;">
    <ul class="nav-tab-wrapper wp-clearfix">
		<?php foreach ( $settingsDefinition as $key => $definition ):

			// skip tab entirely if not enabled on this edition
			if ( ! wbArrayIsEmpty( $definition, 'editions' )
			     &&
			     ! WeeblrampHelper_Version::isOneOfEditions(
				     wbArrayGet( $definition, 'editions', array()
				     )
			     )
			) {
				continue;
			}

			?>
            <li>
                <a href="#<?php echo esc_attr( $definition['name'] ); ?>"
                   class="js-wblib-tab-<?php echo esc_attr( $definition['name'] ); ?> nav-tab<?php echo $definition['name'] == $firstTab ? ' nav-tab-active' : ''; ?>">
					<?php echo esc_html( $definition['title'] ); ?>
                </a>
            </li>
		<?php endforeach; ?>
    </ul>

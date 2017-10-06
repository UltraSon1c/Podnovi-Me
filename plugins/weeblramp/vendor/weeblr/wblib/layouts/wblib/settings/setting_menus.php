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

$details      = $this->getAsArray( 'details' );
$currentValue = $this->getAsArray( 'current_value' );

// force type
$details['content']['attr']['type'] = 'checkbox';

// sanitize incoming data
$options = empty( $details['content']['options'] ) ? array() : $details['content']['options'];

// optional description
if ( ! empty( $details['desc'] ) ) {
	$details['content']['attr']['aria-describedby'] = $this->getAsId( 'name' ) . '_description';
}

foreach ( $options as $key => $menu ) :
	?>
    <p class="wblib-settings-menus-title"><?php echo esc_html( $menu->name ); ?>
        <span class="wblib-settings-menus-slug">(<?php echo esc_html( $menu->term_id . ' - ' . $menu->slug ); ?>)</span>
    </p>
    <fieldset class="wblib-settings-menus-options wblib-settings-level-0">
        <legend class="screen-reader-text"><?php echo esc_html( $menu->name ); ?></legend>

		<?php // show on AMP pages?
		$name      = $this->get( 'name' ) . '[' . $menu->term_id . '][enabled]';
		$isEnabled = isset( $currentValue[ $menu->term_id ] ) ? ! empty( $currentValue[ $menu->term_id ]['enabled'] ) : 0;

		// turn into text
		$details['content']['attr']['name'] = $name;
		$details['content']['attr']['id']   = WblSystem_Strings::asHtmlId( $name );
		$attributes                         = WblHtml_Helper::attrToHtml( $details['content']['attr'] );
		?>
        <label for="<?php echo esc_attr( $name ); ?>" class="wblib-settings-menus">
            <input <?php echo $attributes; ?> value="1"<?php checked( $isEnabled, true ); ?> />
			<?php echo _e( 'Show on AMP pages' ); ?>
        </label>

		<?php // show name of menu ?
		$name     = $this->get( 'name' ) . '[' . $menu->term_id . '][show_name]';
		$showName = isset( $currentValue[ $menu->term_id ] ) ? ! empty( $currentValue[ $menu->term_id ]['show_name'] ) : 0;

		// turn into text
		$details['content']['attr']['name'] = $name;
		$details['content']['attr']['id']   = WblSystem_Strings::asHtmlId( $name );
		$attributes                         = WblHtml_Helper::attrToHtml( $details['content']['attr'] );
		?>
        <label for="<?php echo esc_attr( $name ); ?>" class="wblib-settings-menus">
            <input <?php echo $attributes; ?> value="1"<?php checked( $showName, true ); ?> />
			<?php echo _e( 'Show menu name' ); ?>
        </label>

		<?php // should amplify links in menu?
		$name          = $this->get( 'name' ) . '[' . $menu->term_id . '][should_amplify]';
		$shouldAmplify = isset( $currentValue[ $menu->term_id ] ) ? ! empty( $currentValue[ $menu->term_id ]['should_amplify'] ) : 0;

		// turn into text
		$details['content']['attr']['name'] = $name;
		$details['content']['attr']['id']   = WblSystem_Strings::asHtmlId( $name );
		$attributes                         = WblHtml_Helper::attrToHtml( $details['content']['attr'] );
		?>
        <label for="<?php echo esc_attr( $name ); ?>" class="wblib-settings-menus">
            <input <?php echo $attributes; ?> value="1"<?php checked( $shouldAmplify, true ); ?> />
			<?php echo _e( 'AMPlify links' ); ?>
        </label>

		<?php
		/**
		 * Filter the list of languages available on the site frontend.
		 *
		 * @api
		 * @package weeblrAMP\filter\Multilingual
		 * @var weeblramp_get_available_languages
		 * @since   1.1.0
		 *
		 * @param array $languagesData List of languages, indexed on language slug.
		 *
		 * @return array
		 */
		$languages = apply_filters( 'weeblramp_get_available_languages', array() );

		// per language activation
		foreach ( $languages as $languageSlug => $languageDetails ) {
			$name          = $this->get( 'name' ) . '[' . $menu->term_id . '][enabled_for_' . $languageSlug . ']';
			$shouldAmplify = isset( $currentValue[ $menu->term_id ] ) ? ! empty( $currentValue[ $menu->term_id ][ 'enabled_for_' . $languageSlug ] ) : 0;

			$details['content']['attr']['name'] = $name;
			$details['content']['attr']['id']   = WblSystem_Strings::asHtmlId( $name );
			$attributes                         = WblHtml_Helper::attrToHtml( $details['content']['attr'] );
			?>
            <label for="<?php echo esc_attr( $name ); ?>" class="wblib-settings-menus">
                <input <?php echo $attributes; ?> value="1"<?php checked( $shouldAmplify, true ); ?> />
				<?php echo esc_html( wbArrayGet( $languageDetails, 'title' ) ); ?>
            </label>
			<?php
		}

		?>
    </fieldset>

<?php endforeach;

echo '<span id="' . WblSystem_Strings::asHtmlId( $this->getAsAttr( 'name' ) ) . '" ' . WblHtml_Helper::attrToHtml( $this->get( 'show-if-attrs' ) ) . '></span>';

echo WblMvcLayout_Helper::render( 'wblib.settings.setting_description', $this->getDisplayData(), WBLIB_LAYOUTS_PATH ); ?>

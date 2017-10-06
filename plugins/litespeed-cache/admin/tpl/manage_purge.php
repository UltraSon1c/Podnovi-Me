<?php
if ( ! defined( 'WPINC' ) ) die ;


$_panels = array(
	array(
		'title'	=> __( 'Purge Front Page', 'litespeed-cache' ),
		'desc'	=> __( 'This will Purge Front Page only', 'litespeed-cache' ),
		'tag'	=> LiteSpeed_Cache::ACTION_PURGE_FRONT,
		'icon'	=> 'purge-front',
	),
	array(
		'title'	=> __( 'Purge Pages', 'litespeed-cache' ),
		'desc'	=> __( 'This will Purge Pages only', 'litespeed-cache' ),
		'tag'	=> LiteSpeed_Cache::ACTION_PURGE_PAGES,
		'icon'	=> 'purge-pages',
	),
	array(
		'title'	=> __( 'Purge 403 Error', 'litespeed-cache' ),
		'desc'	=> __( 'Purge error pages, including 403 pages', 'litespeed-cache' ),
		'tag'	=> LiteSpeed_Cache::ACTION_PURGE_ERRORS,
		'icon'	=> 'purge-403',
		'append_url'	=> 'lserr=403',
	),
	array(
		'title'	=> __( 'Purge 404 Error', 'litespeed-cache' ),
		'desc'	=> __( 'Purge error pages, including 404 pages', 'litespeed-cache' ),
		'tag'	=> LiteSpeed_Cache::ACTION_PURGE_ERRORS,
		'icon'	=> 'purge-404',
		'append_url'	=> 'lserr=404',
	),
	array(
		'title'	=> __( 'Purge 500 Error', 'litespeed-cache' ),
		'desc'	=> __( 'Purge error pages, including 500 pages', 'litespeed-cache' ),
		'tag'	=> LiteSpeed_Cache::ACTION_PURGE_ERRORS,
		'icon'	=> 'purge-500',
		'append_url'	=> 'lserr=500',
	),
	array(
		'title'	=> __( 'Purge All', 'litespeed-cache' ),
		'desc'	=> __( 'Purge the cache entries created by this plugin', 'litespeed-cache' ),
		'tag'	=> LiteSpeed_Cache::ACTION_PURGE_ALL,
		'icon'	=> 'purge-all',
		'title_cls'	=> 'litespeed-warning',
		'cfm'	=>  is_multisite() && is_network_admin() ?
					esc_html( __( 'This will purge everything for all blogs.', 'litespeed-cache' ) ) . ' ' .
					esc_html( __( 'Are you sure you want to purge all?', 'litespeed-cache' ) )
					:
					esc_html( __( 'Are you sure you want to purge all?', 'litespeed-cache' ) )
	),
) ;

if ( ! is_multisite() || is_network_admin() ) {
	$_panels[] = array(
		'title'	=> __( 'Empty Entire Cache', 'litespeed-cache' ),
		'desc'	=> __( 'Clears all cache entries related to this site, <i>including other web applications</i>.', 'litespeed-cache' ) . ' <b>' .
					__('This action should only be used if things are cached incorrectly.', 'litespeed-cache') . '</b>',
		'tag'	=> LiteSpeed_Cache::ACTION_PURGE_EMPTYCACHE,
		'icon'	=> 'empty-cache',
		'title_cls'	=> 'litespeed-danger',
		'cfm'	=>  esc_html( __( 'This will clear EVERYTHING inside the cache.', 'litespeed-cache' ) ) . ' ' .
					esc_html( __( 'This may cause heavy load on the server.', 'litespeed-cache' ) ) . ' ' .
					esc_html( __( 'If only the WordPress site should be purged, use purge all.', 'litespeed-cache' ) )
	) ;
}

?>

<h3 class="litespeed-title"><?php echo __('Purge', 'litespeed-cache'); ?></h3>

<div class="litespeed-panel-wrapper">

<?php foreach ( $_panels as $val ): ?>

	<a 	class="litespeed-panel"
		href="<?php echo LiteSpeed_Cache_Admin_Display::build_url( $val[ 'tag' ], false, ! empty( $val[ 'append_url' ] ) ? $val[ 'append_url' ] : false ) ; ?>"
		<?php if ( ! empty( $val[ 'cfm' ] ) ) echo 'data-litespeed-cfm="' . $val[ 'cfm' ] . '"' ; ?>
	>
		<span class="litespeed-panel-icon-<?php echo $val[ 'icon' ] ; ?>"></span>
		<span class="litespeed-panel-content">
			<span class="litespeed-panel-h3 <?php if ( ! empty( $val[ 'title_cls' ] ) ) echo $val[ 'title_cls' ] ; ?>">
				<?php echo $val[ 'title' ] ; ?>
			</span>
			<span class="litespeed-panel-para"><?php echo $val[ 'desc' ] ; ?></span>
		</span>
	</a>

<?php endforeach; ?>

</div>

<?php if (!is_multisite() || !is_network_admin()): ?>

	<h3><?php echo __('Purge By...', 'litespeed-cache'); ?></h3>
	<hr/>
	<p>
		<?php echo __('Select below for "Purge by" options.', 'litespeed-cache'); ?>
		<?php echo __('Please enter one per line.', 'litespeed-cache'); ?>
	</p>

	<?php
		$purgeby_option = false;
		$_option_field = LiteSpeed_Cache_Admin_Display::PURGEBYOPT_SELECT;
		if(!empty($_REQUEST[$_option_field])){
			$purgeby_option = $_REQUEST[$_option_field];
		}
		if( !in_array($purgeby_option, array(
			LiteSpeed_Cache_Admin_Display::PURGEBY_CAT,
			LiteSpeed_Cache_Admin_Display::PURGEBY_PID,
			LiteSpeed_Cache_Admin_Display::PURGEBY_TAG,
			LiteSpeed_Cache_Admin_Display::PURGEBY_URL,
		)) ) {
			$purgeby_option = LiteSpeed_Cache_Admin_Display::PURGEBY_CAT;
		}
	?>

	<form method="post" action="admin.php?page=lscache-dash">
		<?php $this->form_action(LiteSpeed_Cache::ACTION_PURGE_BY); ?>
		<div class="litespeed-row">
			<div class="litespeed-switch litespeed-label-info litespeed-mini">
				<?php $val = LiteSpeed_Cache_Admin_Display::PURGEBY_CAT;?>
				<input type="radio" name="<?php echo $_option_field; ?>" id="purgeby_option_category"
					value="<?php echo $val; ?>" <?php if( $purgeby_option == $val ) echo 'checked'; ?>
				/>
				<label for="purgeby_option_category"><?php echo __('Category', 'litespeed-cache'); ?></label>

				<?php $val = LiteSpeed_Cache_Admin_Display::PURGEBY_PID;?>
				<input type="radio" name="<?php echo $_option_field; ?>" id="purgeby_option_postid"
					value="<?php echo $val; ?>" <?php if( $purgeby_option == $val ) echo 'checked'; ?>
				/>
				<label for="purgeby_option_postid"><?php echo __('Post ID', 'litespeed-cache'); ?></label>

				<?php $val = LiteSpeed_Cache_Admin_Display::PURGEBY_TAG;?>
				<input type="radio" name="<?php echo $_option_field; ?>" id="purgeby_option_tag"
					value="<?php echo $val; ?>" <?php if( $purgeby_option == $val ) echo 'checked'; ?>
				/>
				<label for="purgeby_option_tag"><?php echo __('Tag', 'litespeed-cache'); ?></label>

				<?php $val = LiteSpeed_Cache_Admin_Display::PURGEBY_URL;?>
				<input type="radio" name="<?php echo $_option_field; ?>" id="purgeby_option_url"
					value="<?php echo $val; ?>" <?php if( $purgeby_option == $val ) echo 'checked'; ?>
				/>
				<label for="purgeby_option_url"><?php echo __('URL', 'litespeed-cache'); ?></label>
			</div>

			<div class="litespeed-cache-purgeby-text">
				<div class="<?php if($purgeby_option != LiteSpeed_Cache_Admin_Display::PURGEBY_CAT) echo 'litespeed-hide'; ?>"
					data-purgeby="<?php echo LiteSpeed_Cache_Admin_Display::PURGEBY_CAT; ?>">
					<?php echo sprintf(__('Purge pages by category name - e.g. %2$s should be used for the URL %1$s.', "litespeed-cache"),
						'http://example.com/category/category-name/', 'category-name'); ?>
				</div>
				<div class="<?php if($purgeby_option != LiteSpeed_Cache_Admin_Display::PURGEBY_PID) echo 'litespeed-hide'; ?>"
					data-purgeby="<?php echo LiteSpeed_Cache_Admin_Display::PURGEBY_PID; ?>">
					<?php echo __("Purge pages by post ID.", "litespeed-cache"); ?>
				</div>
				<div class="<?php if($purgeby_option != LiteSpeed_Cache_Admin_Display::PURGEBY_TAG) echo 'litespeed-hide'; ?>"
					data-purgeby="<?php echo LiteSpeed_Cache_Admin_Display::PURGEBY_TAG; ?>">
					<?php echo sprintf(__('Purge pages by tag name - e.g. %2$s should be used for the URL %1$s.', "litespeed-cache"),
						'http://example.com/tag/tag-name/', 'tag-name'); ?>
				</div>
				<div class="<?php if($purgeby_option != LiteSpeed_Cache_Admin_Display::PURGEBY_URL) echo 'litespeed-hide'; ?>"
					data-purgeby="<?php echo LiteSpeed_Cache_Admin_Display::PURGEBY_URL; ?>">
					<?php echo __('Purge pages by relative or full URL.', 'litespeed-cache'); ?>
					<?php echo sprintf(__('e.g. Use %s or %s.', 'litespeed-cache'),
						'<b><u>/2016/02/24/hello-world/</u></b>',
						'<b><u>http://www.myexamplesite.com/2016/02/24/hello-world/</u></b>'); ?>
				</div>
			</div>

		</div>

		<p>
			<textarea name="<?php echo LiteSpeed_Cache_Admin_Display::PURGEBYOPT_LIST; ?>" rows="5" class="code litespeed-cache-purgeby-textarea"></textarea>
		</p>

		<p>
			<button type="submit" class="litespeed-btn litespeed-btn-success"><?php echo __('Purge List', 'litespeed-cache'); ?></button>
		</p>
	</form>
<?php endif; ?>

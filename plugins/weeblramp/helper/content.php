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

// Security check to ensure this file is being included by a parent file.
defined( 'WEEBLRAMP_EXEC' ) || die;

class WeeblrampHelper_Content {

	/**
	 * Removes all [wbamp] tags from a string (on a regular HTML page)
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public static function scrubRegularHtmlPage( $content ) {

		// shortcut
		if ( empty( $content ) || strpos( $content, '[wbamp-no-scrub]' ) != false ) {
			$content = str_replace( '[wbamp-no-scrub]', '', $content );

			return $content;
		}

		// remove content that should only be displayed on AMP pages
		$regExp  = '#\[\s*wbamp-show\s*start\s*\].*\[\s*wbamp-show\s*end\s*\]#iuUs';
		$content = preg_replace( $regExp, '', $content );

		// remove all remaining {wbamp tags
		$regex   = '#\[\s*wbamp([^\]]*)\]#um';
		$content = preg_replace( $regex, '', $content );

		return $content;
	}

	/**
	 * Removes all [wbamp] tags from a string (on an AMP page)
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public static function scrubAmpHtmlPage( $content ) {

		$content = str_replace( '[wbamp-no-scrub]', '', $content );

		// PHP adds a closing tag for input, which is invalid
		$content = str_replace( '</input>', '', $content );

		return $content;
	}

	/**
	 * Gather data about a post/page featured image
	 *
	 * @param $post
	 *
	 * @return array
	 */
	public static function getPostFeaturedImage( $post ) {

		$featuredImageId = get_post_thumbnail_id( $post->ID );

		return self::getImageDetails( $featuredImageId );
	}

	/**
	 * Gather data about a specific image
	 *
	 * @param int $imageId The image id
	 *
	 * @return array
	 */
	public static function getImageDetails( $imageId ) {

		$featuredImage = array();

		if ( ! empty( $imageId ) ) {
			// get atatchment details
			$featuredImageMeta = get_posts(
				array(
					'post_type'     => 'attachment',
					'numberposts'   => 1,
					'post_status'   => 'any',
					'attachment_id' => $imageId,
				)
			);
			$featuredImageMeta = ! empty( $featuredImageMeta ) && is_array( $featuredImageMeta ) ? $featuredImageMeta[0] : $featuredImageMeta;

			// get image details
			$imageMeta = wp_get_attachment_metadata( $imageId );

			$featuredImage = array(
				'id'         => $imageId,
				'meta'       => $featuredImageMeta,
				'image_meta' => $imageMeta,
				'url'        => wp_get_attachment_url( $imageId ),
				'imgs'       => array(
					'thumbnail'    => wp_get_attachment_image( $imageId, $size = 'thumbnail', $icon = false, $attr = '' ),
					'medium'       => wp_get_attachment_image( $imageId, $size = 'medium', $icon = false, $attr = '' ),
					'medium_large' => wp_get_attachment_image( $imageId, $size = 'medium_large', $icon = false, $attr = '' ),
					'large'        => wp_get_attachment_image( $imageId, $size = 'large', $icon = false, $attr = '' ),
					'full'         => wp_get_attachment_image( $imageId, $size = 'full', $icon = false, $attr = '' ),
				)
			);
		}

		return $featuredImage;
	}

	/**
	 * Compute a unique Page identifier for the passed post.
	 *
	 * We use the same syntax as Disqus, as the initial goal of this id
	 * is to identify a page, so that the same Disqus comments are displayed
	 * on both the STD and the AMP version of a page
	 *
	 * NB: Future reference: if a site was not using the Disqus plugin, but instead simply
	 * inserting the universal Disqus snippet, comments are identified by a string derived from
	 * the page URL. This is why we now specify the URL in the disqus relay iframe. In addition,
	 * the comment_location_id must be computed as follow:
	 *
	 * $uri = JUri::getInstance($currentData['canonical']);
	 * $path = $uri->getPath();
	 * $bits = explode('/', trim($path, '/'));
	 * $pageId = empty($bits) ? '/' : array_pop($bits);
	 * The id is the last segment of the path (for some reason, they also turn dashes into
	 * underscores, but that's internal, it is enough for us to pass the proper segment).
	 *
	 * @param WP_Post $post
	 *
	 * @return string
	 */
	public static function getCommentLocationId( $post ) {

		$id = '';
		if ( ! empty( $post ) && $post instanceof WP_Post ) {
			$id = $post->ID . ' ' . $post->guid;
		}

		// allow filtering
		/**
		 * Filter the id used to uniquely identify a page when associating it with its comments.
		 *
		 * We use the same convention as Disqus: post_id + a space + post_guid
		 *
		 * @api
		 * @package weeblrAMP\filter\comment
		 * @var weeblramp_comments_location_id
		 * @since   1.0.0
		 *
		 * @param string $id Current page id used for commenting
		 *
		 * @return string
		 */
		$id = apply_filters(
			'weeblramp_comments_location_id',
			$id
		);

		return $id;
	}

	/**
	 * Extract the current post being displayed from a page Data record.
	 *
	 * @param array $pageData The currently collected page data record.
	 *
	 * @return mixed|WP_Post
	 */
	public static function getPostFromPageData( $pageData ) {

		// try to build one
		$content = wbArrayGet( $pageData, 'main_content' );
		if ( is_array( $content ) ) {
			$content = array_shift( $content );
		}
		$post = wbArrayGet( $content, 'post' );

		return $post;
	}
}

<?php
/**
 * Menu
 *
 * @package imera-theme
 */

/**
 * Disable the emoji's
 * https://kinsta.com/fr/base-de-connaissances/desactiver-emojis-wordpress/
 */
function elabo_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'elabo_disable_emojis_tinymce' );
	add_filter( 'wp_resource_hints', 'elabo_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'elabo_disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * https://kinsta.com/fr/base-de-connaissances/desactiver-emojis-wordpress/
 *
 * @param array $plugins An array of default TinyMCE plugins.
 * @return array Difference betwen the two arrays
 */
function elabo_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 * https://kinsta.com/fr/base-de-connaissances/desactiver-emojis-wordpress/
 *
 * @param array  $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function elabo_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
		$urls          = array_diff( $urls, array( $emoji_svg_url ) );
	}
	return $urls;
}

/**
 * Remove dashicons in frontend to non-admin.
 */
/*
function elabo_dequeue_dashicon() {
	if ( current_user_can( 'update_core' ) ) {
		return;
	}
	wp_deregister_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'elabo_dequeue_dashicon' );
*/

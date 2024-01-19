<?php
/**
 * SEO
 *
 * @package imera-theme
 */

/**
 * Title
 */
function elabo_theme_title_setup() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'elabo_theme_title_setup' );


/**
 * Breadcrumb
 */
function elabo_breadcrumb() {
	if ( function_exists( 'seopress_display_breadcrumbs' ) ) {
		seopress_display_breadcrumbs();
	}
}

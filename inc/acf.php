<?php
/**
 * ACF
 *
 * @package imera-theme
 */

/**
 * Set ACF site options
 */
function elabo_acf_option_init() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		/* parent page */
		acf_add_options_page(
			array(
				'page_title' => 'Options',
				'menu_title' => 'Options du site',
				'menu_slug'  => 'options-du-site',
				'capability' => 'edit_posts',
				'position'   => 23,
				'icon_url'   => 'dashicons-welcome-widgets-menus',
			)
		);
		/* subpage */
		acf_add_options_sub_page(
			array(
				'page_title'  => "Titres et textes d'introduction",
				'menu_title'  => "Titres et textes d'introduction pour les pages de listes",
				'parent_slug' => 'options-du-site',
			)
		);
	}
}
add_action( 'acf/init', 'elabo_acf_option_init' );

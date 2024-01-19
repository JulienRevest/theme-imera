<?php
/**
 * Sidebars for widgets
 *
 * @package theme-imera
 */

/**
 * Register Archive Alumnis
 */
function imera_register_sidebar_archive_alumni () {
	register_sidebar(
		array(
			'name' => 'Archive Alumnis',
			'id' => 'imera_archive_alumni',
			'before_widget' => '<div class="banner-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'imera_register_sidebar_archive_alumni' );

/**
 * Register Appels a candidature
 */
function imera_register_sidebar_candidature () {
	register_sidebar(
		array(
			'name' => 'Appels à candidature',
			'id' => 'imera_candidature',
			'before_widget' => '<div class="candidature-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'imera_register_sidebar_candidature' );

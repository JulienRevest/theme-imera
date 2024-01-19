<?php
/**
 * Assets
 *
 * @package imera-theme
 */


 /**
 * Add thumbnails
 */
add_theme_support( 'post-thumbnails' );


/**
 * Images sizes
 */
add_image_size( 'archive', 400, 300, true );


/**
 * Load css, js
 */
function elabo_enqueue_scripts() {
	$path = get_template_directory_uri();
	/* CSS */
	$css = array(
		'style' => array(
			'path'  => $path . '/css/styles.min.css',
			'deps'  => false,
			'ver'   => false,
			'media' => 'all',
		),
	);
	foreach ( $css as $id => $path_file ) {
		wp_register_style( $id, $path_file['path'], $path_file['deps'], $path_file['ver'], $path_file['media'] );
		wp_enqueue_style( $id );
	}
	/* js */
	$js = array(
		'scripts'      => array(
			'path'      => $path . '/js/scripts.js',
			'deps'      => array( 'w3menubar', 'jquery' ),
			'ver'       => false,
			'in_footer' => true,
		),
		'menu'      => array(
			'path'      => $path . '/js/menu.js',
			'deps'      => array( 'jquery' ),
			'ver'       => false,
			'in_footer' => true,
		),
		'jquery-modal' => array(
			'path'      => $path . '/js/jquery-accessible-modal-window-aria.js',
			'deps'      => array( 'jquery' ),
			'ver'       => false,
			'in_footer' => true,
		),
		'w3menubar'    => array(
			'path'      => $path . '/js/w3c.menubar.js',
			'deps'      => false,
			'ver'       => false,
			'in_footer' => true,
		),
	);
	foreach ( $js as $id => $path_file ) {
		wp_register_script( $id, $path_file['path'], $path_file['deps'], $path_file['ver'], $path_file['in_footer'] );
		wp_enqueue_script( $id );
	}
	wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'elabo_enqueue_scripts' );


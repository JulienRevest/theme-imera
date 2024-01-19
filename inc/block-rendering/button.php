<?php
/**
 * ACF
 *
 * @package imera-theme
 */

/**
 * Button renderer
 *
 * @param array $attributes Button attributes.
 * @param array $content Button content.
 *
 * @return HTML Button render
 */
function imera_button_renderer( $attributes, $content ) {
	$output = str_replace("</a>", ' <span class="icon-chevron-next"></span></a>', $content);
	return $output;
}

/**
 * Intercept renderer
 */
function imera_block_button_args( $args, $name ) {
	if ( 'core/button' == $name ) {
		$args['render_callback'] = 'imera_button_renderer';
	}
	return $args;
}
add_filter( 'register_block_type_args', 'imera_block_button_args', 10, 3 );

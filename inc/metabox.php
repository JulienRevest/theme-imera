<?php
/**
 * Metaboxes
 *
 * @package imera-theme
 */

function styles_metaboxes() {
	add_meta_box( 'imera_title_style', 'Style de titre', 'styles_metaboxes_func', 'post', 'side', 'high' );
	//TODO: Add all necessary CPT
	add_meta_box( 'imera_title_style', 'Style de titre', 'styles_metaboxes_func', 'agenda', 'side', 'high' );
	add_meta_box( 'imera_title_style', 'Style de titre', 'styles_metaboxes_func', 'alumnis', 'side', 'high' );
	add_meta_box( 'imera_title_style', 'Style de titre', 'styles_metaboxes_func', 'residents', 'side', 'high' );
	add_meta_box( 'imera_title_style', 'Style de titre', 'styles_metaboxes_func', 'page', 'side', 'high' );
	add_meta_box( 'imera_title_style', 'Style de titre', 'styles_metaboxes_func', 'front-page', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'styles_metaboxes' );

function styles_metaboxes_func( $post ) {
	$value = get_post_meta( $post->ID, '_style_type', true );
	echo '<label for="style_type">Type de style : </label>';
	echo '<select name="style_type" class="style-selector">';
	echo '<option ' . selected( 'default', $value, false ) . ' value="default">Par défaut</option>';
	echo '<option ' . selected( 'A', $value, false ) . ' value="A">Style A</option>';
	echo '<option ' . selected( 'B', $value, false ) . ' value="B">Style B</option>';
	echo '<option ' . selected( 'C', $value, false ) . ' value="C">Style C</option>';
	echo '<option ' . selected( 'D', $value, false ) . ' value="D">Style D</option>';
	echo '<option ' . selected( 'E', $value, false ) . ' value="E">Style E</option>';
	echo '<option ' . selected( 'F', $value, false ) . ' value="F">Style F</option>';
	echo '<option ' . selected( 'G', $value, false ) . ' value="G">Style G</option>';
	?>
	</select>
	<br>
	<label for="style_type">Aperçu : </label>
	<script>
		jQuery( function( $ ) {
			$(document).ready(()=>{
				var selected = $('.style-selector').val();
				$('.style-selector').change(() => {
					$('.title-style').removeClass( 'title-style-' + selected );
					selected = $('.style-selector').val();
					$('.title-style').addClass( 'title-style-' + selected );
				})
			});
		});
	</script>
	<?php echo sprintf( '<div class="title-style title-style-%s">', $value ); ?>
	<div class="style-color-1"></div>
	<div class="style-color-2">
		<div class="style-color-3">
			<?php echo file_get_contents( get_template_directory() . '/img/symbol.svg' ) ?>
		</div>
	</div>
	<?php
}

function imera_enqueue_metabox_styling(){
	wp_enqueue_style( 'imera-metabox-stylesheet' , get_template_directory_uri() . '/css/admin-sidebar.min.css' );
}

add_action( 'admin_enqueue_scripts', 'imera_enqueue_metabox_styling' );

function save_styles_metaboxes( $post_ID ){
	if ( isset( $_POST['style_type'] ) ) {
		update_post_meta( $post_ID, '_style_type', esc_html( $_POST['style_type'] ) );
	}
}
add_action( 'save_post', 'save_styles_metaboxes' );

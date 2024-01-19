<?php
/**
 * The template for pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage theme-imera
 * @since 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

get_header(); ?>

<?php
while ( have_posts() ) :
	the_post();
	$post_parent_id = wp_get_post_parent_id( $post );
	?>
	<div class="page-header">
		<?php $post_title_style = get_post_meta( $post->ID, '_style_type', true ); ?>
		<?php elabo_breadcrumb(); ?>
		<div class="page-title<?php echo ( ! empty( $post_title_style ) ? ' has-title-style' : '' ); ?>">
			<div class="title-scrolling<?php echo ( ( ! empty( $post_title_style ) && 'default' != $post_title_style ) ? ' halfwidth' : '' ); ?>"><h1><?php the_title(); ?></h1></div>
			<?php if ( ! empty( $post_title_style ) && 'default' !== $post_title_style ) : ?>
				<div class="title-section-one title-style-<?php echo esc_html( $post_title_style ); ?>">
				</div>
				<div class="title-section-two title-style-<?php echo esc_html( $post_title_style ); ?>">
					<?php echo file_get_contents( get_template_directory() . '/img/symbol.svg' ) ?>
				</div>
			<?php endif; ?>		
		</div>
	</div>

	<div class="global-page">
		<div class="entry-content">
		<?php the_content(); ?>
		</div>
	</div>

	<?php endwhile; ?>
<?php get_footer(); ?>

<?php
/**
 * The template for an archive.
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

	<div class="archive-header">
		<?php elabo_breadcrumb(); ?>
		<div class="page-title has-title-style">
			<div class="title-scrolling halfwidth"><h1 data-title="<?php esc_html_e( 'Candidatures', 'imera' ); ?>"><?php esc_html_e( 'Candidatures', 'imera' ); ?></h1></div>
			<div class="title-section-one title-style-F"></div>
			<div class="title-section-two title-style-F">
				<?php echo file_get_contents( get_template_directory() . '/img/symbol.svg' ) ?>
			</div>
		</div>
		<?php
		if ( get_field( 'archive_candidatures_intro', 'options' ) ) :
			?>
			<p class="archive-description"><?php the_field( 'archive_candidatures_intro', 'options' ); ?></p>
			<?php
		endif;
		?>
	</div>

	<div class="global-page archive-candidatures archive">
		<?php
		if ( get_field( 'archive_candidatures_subtitle', 'options' ) ) :
			?>
			<h2><?php the_field( 'archive_candidatures_subtitle', 'options' ); ?></h2>
			<?php
		endif;
		?>
		<?php if ( have_posts() ) : ?>
			<div class="card-container">
			<?php
			$current_date = strtotime( gmdate( 'M d, Y' ) );
			imera_load_more_scripts( '', true );
			while ( have_posts() ) {
				the_post();
				imera_get_card_html();
			}
			?>
			</div>
			<?php
			if ( $wp_query->max_num_pages > 1 ) :
				?>
				<div class="imera-loadmore"><a class="imera-loadmore-button"><?php esc_html_e( "Voir plus", 'imera' ); ?><span class="icon-chevron-down"></span></a></div>
			<?php endif; ?>
		<?php else : ?>
		<div class="no-posts">
			<?php echo esc_html_e( 'Aucun résultat', 'imera' ); ?>
		</div>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>

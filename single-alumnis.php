<?php
/**
 * The template for a single page.
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
				<div class="title-scrolling<?php echo ( ( ! empty( $post_title_style ) && 'default' != $post_title_style ) ? ' halfwidth' : '' ); ?>"><h1 data-title="<?php the_title(); ?>"><?php the_title(); ?></h1></div>
				<?php if ( ! empty( $post_title_style ) && 'default' !== $post_title_style ) : ?>
					<div class="title-section-one title-style-<?php echo esc_html( $post_title_style ); ?>">
					</div>
					<div class="title-section-two title-style-<?php echo esc_html( $post_title_style ); ?>">
						<?php echo file_get_contents( get_template_directory() . '/img/symbol.svg' ) ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="global-page single-alumni">
			<div class="entry-content featured-style-<?php echo esc_html( $post_title_style ); ?>">
				<?php the_content(); ?>
			</div>

			<div class="related related-alumnis">
				<h2><?php _e( "Découvrir d'autres chercheurs", 'imera' ); ?></h2>
				<div class="card-container">
					<?php
					$related_researchers = array();
					$current_id          = get_the_ID();
					if ( get_the_terms( $current_id, 'alumni_programme' ) || get_the_terms( $current_id, 'alumni_chaire' ) ) {
						$terms_programme = wp_list_pluck( get_the_terms( $current_id, 'alumni_programme' ), 'term_id' );
						$terms_chaire    = wp_list_pluck( get_the_terms( $current_id, 'alumni_chaire' ), 'term_id' );
						$args_prog_chair = array(
							'post_type'      => 'alumnis',
							'post_status'    => 'publish',
							'orderby'        => 'rand',
							'posts_per_page' => 3,
							'exclude'        => array( $current_id ),
							'tax_query' => array(
								'relation' => 'OR',
								array(
									'taxonomy' => 'alumni_programme',
									'field'    => 'term_id',
									'terms'    => $terms_programme,
								),
								array(
									'taxonomy' => 'alumni_chaire',
									'field'    => 'term_id',
									'terms'    => $terms_chaire,
								)
							)
						);
						$related_researchers = array_merge( $related_researchers, get_posts( $args_prog_chair ) );
					}
					$count_related = count( $related_researchers );
					if ( $count_related < 3 && ( get_the_terms( $current_id, 'alumni_type' ) || get_the_terms( $current_id, 'alumni_year' ) ) ) {
						$nb_posts       = 3 - $count_related;
						$terms_type     = wp_list_pluck( get_the_terms( $current_id, 'alumni_type' ), 'term_id' );
						$terms_year     = wp_list_pluck( get_the_terms( $current_id, 'alumni_year' ), 'term_id' );
						$args_type_year = array(
							'post_type'      => 'alumnis',
							'post_status'    => 'publish',
							'orderby'        => 'rand',
							'posts_per_page' => $nb_posts,
							'exclude'        => array( $current_id ),
							'tax_query' => array(
								'relation' => 'OR',
								array(
									'taxonomy' => 'alumni_type',
									'field'    => 'term_id',
									'terms'    => $terms_type,
								),
								array(
									'taxonomy' => 'alumni_year',
									'field'    => 'term_id',
									'terms'    => $terms_year,
								)
							)
						);
						$related_researchers = array_merge( $related_researchers, get_posts( $args_type_year ) );
					}
					$count_related = count( $related_researchers );
					if ( $count_related < 3 ) {
						$nb_posts = 3 - $count_related;
						$args     = array(
							'post_type'      => 'alumnis',
							'post_status'    => 'publish',
							'orderby'        => 'rand',
							'posts_per_page' => $nb_posts,
							'exclude'        => array( $current_id ),
						);
						$related_researchers = array_merge( $related_researchers, get_posts( $args ) );
					}
					foreach ( $related_researchers as $related_researcher ) {
						imera_get_card_html(
							array(
								'is_alumni' => true,
								'post_id' => $related_researcher->ID,
							)
						);
					}
					?>
				</div>
			</div>

			<?php
			$associated_documents = get_field( 'ressources_associees' );
			if ( $associated_documents ) :
				?>
			<div class="related related-documents">
				<h2><?php _e( 'Documents associés', 'imera' ); ?></h2>
				<div class="card-container">
					<?php
					// Check rows exists.
					foreach ( $associated_documents as $documents ) {
						imera_get_card_html(
							array(
								'post_id' => $documents,
							)
						);
					}
					?>
				</div>
			</div>
				<?php
			endif;
			?>
			<div class="entry-content small">
				<?php
				echo apply_filters( 'the_content', get_post_field( 'post_content', 2381 ) );
				?>
			</div>
		</div>



	<?php endwhile; ?>
<?php get_footer(); ?>

<?php
/**
 * Template Name: Actualités
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage imera-theme
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
		?>

		<div class="global-page">
			<?php elabo_breadcrumb(); ?>
			<h1><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>

			<div class="cards">
				<?php
				$current_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
				$args          = array(
					'posts_per_page' => 2,
					'post_type'      => 'post',
					'order'          => 'DESC',
					'paged'          => $current_paged,
				);

				$postslist = new WP_Query( $args );
				imera_load_more_scripts( $args );
				while ( $postslist->have_posts() ) :
					$postslist->the_post();
					?>
					<article class="card-default">
						<?php if ( has_post_thumbnail() ) : ?>
							<figure><?php the_post_thumbnail( 'thumbnail_post_img' ); ?></figure>
						<?php endif; ?>	
						<div class="content">
							<h2><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
							<div class="buttons-zone align-right">
								<a href="<?php the_permalink(); ?>" class="txt-button" title="<?php the_title(); ?>"><?php esc_html_e( 'Lire la suite', 'elabo' ); ?></a>
							</div>
						</div>
					</article>
					<?php
				endwhile;
				?>
			</div>

			<nav class="pagination">
				<?php
				$big = 999999999; /* need an unlikely integer */
				echo paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => max( 1, get_query_var( 'paged' ) ),
						'total'     => $postslist->max_num_pages,
						'type'      => 'list',
						'next_text' => '>',
						'prev_text' => '<',
					)
				);
				wp_reset_postdata();
				?>
			</nav>
		</div>

	<?php endwhile; ?>

<?php get_footer(); ?>

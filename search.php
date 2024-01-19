<?php
/**
 * The template for results layout.
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

	<div class="global-page">

		<div class="results-listing">
			<h1 data-title="<?php esc_html_e( 'Résultats de recherche', 'imera' ); ?>"><?php esc_html_e( 'Résultats de recherche', 'imera' ); ?></h1>
			<div class="search-page">
				<form role="search" method="get" class="search-bar" action="<?php echo home_url(); ?>">
					<label>
						<span class="screen-reader-text"><?php echo _x( 'Rechercher :', 'imera' ) ?></span>
						<input id="search" type="search" class="search-field" placeholder="<?php esc_html_e( 'Rechercher sur Iméra', 'imera' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Rechercher :', 'imera' ) ?>" />
					</label>
					<button type="submit" class="search-submit action-button" value=""><span class="icon-search"></span></button>
				</form>
			</div>
			<div class="search-filters">
				<span><?php esc_html_e( 'Filtrer par', 'imera' ); ?></span>
				<select name="" id="searchFilterPostType" method="GET">
					<option value=""><?php esc_html_e( 'Aucun filtre', 'imera' ); ?></option>
					<?php
					$post_types = get_post_types(
						array(
							'public' => true,
						),
						'objects'
					);
					foreach ( $post_types as $pt ) :
						echo '<pre>';
						var_dump( $pt );
						echo '</pre>';
						?>
						<option value="<?php echo esc_attr( $pt->name ); ?>">
							<?php echo esc_html( $pt->label ); ?>
						</option>
							<?php
					endforeach;
					?>
				</select>
			</div>
			<div> 
				<?php
				global $wp_query;
				$post_count = $wp_query->found_posts;
				echo sprintf(
					'%s résultats',
					$post_count > 0 ? esc_html( $post_count ) : 'Aucun',
				);
				?>

			</div>
			<div class="results-list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article>
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
				</article>
				<?php
			endwhile;
			?>
			</div>
		</div>

	</div>

<?php get_footer(); ?>

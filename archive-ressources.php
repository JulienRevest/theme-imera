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
			<div class="title-scrolling halfwidth"><h1><?php esc_html_e( 'Imérathèque', 'imera' ); ?></h1></div>
			<div class="title-section-one title-style-F"></div>
			<div class="title-section-two title-style-F">
				<?php echo file_get_contents( get_template_directory() . '/img/symbol.svg' ) ?>
			</div>
		</div>
		<?php
		if ( get_field( 'archive_ressources_intro', 'options' ) ) :
			?>
			<p class="archive-description"><?php the_field( 'archive_ressources_intro', 'options' ); ?></p>
			<?php
		endif;
		?>
	</div>

	<div class="global-page archive">
		<?php
		if ( get_field( 'archive_ressources_subtitle', 'options' ) ) :
			?>
			<h2><?php the_field( 'archive_ressources_subtitle', 'options' ); ?></h2>
			<?php
		endif;
		?>
		<div class="archive-filters">
			<span><?php esc_html_e( 'Filtrer par', 'imera' ); ?></span>
			<select name="" id="archiveFilterMedia" method="GET">
				<option value=""><?php esc_html_e( 'Type de média', 'imera' ); ?></option>
				<?php
				$media_types = get_terms(
					array(
						'taxonomy'   => 'ressource_type',
						'hide_empty' => false,
					)
				);
				foreach ( $media_types as $media_type ) :
					?>
					<option value="<?php echo esc_attr( $media_type->slug ); ?>">
						<?php echo esc_html( $media_type->name ); ?>
					</option>
						<?php
				endforeach;
				?>
			</select>
			<select name="" id="archiveFilterCategory" method="GET">
				<option value=""><?php esc_html_e( 'Catégories', 'imera' ); ?></option>
				<?php
				$categories = get_terms(
					array(
						'taxonomy'   => 'ressource_category',
						'hide_empty' => false,
					)
				);
				foreach ( $categories as $category ) :
					?>
					<option value="<?php echo esc_attr( $category->slug ); ?>">
						<?php echo esc_html( $category->name ); ?>
					</option>
						<?php
				endforeach;
				?>
			</select>
			<div class="archive-searchbox">
				<button class="archive-search-button"><span class="icon-search"></span></button>
				<input id="archive-search" type="search" placeholder="<?php esc_html_e( 'Rechercher par nom, mots clés', 'imera' ); ?>"/>
			</div>
		</div>
		<?php if ( have_posts() ) : ?>
			<div class="card-container">
			<?php
			imera_load_more_scripts( '', true );
			while ( have_posts() ) {
				the_post();
				imera_get_card_html(
					array(
						'has_event' => false,
						'is_ressource' => true,
					)
				);
			}
			?>
			</div>
			<?php
			if ( $wp_query->max_num_pages > 1 ) :
				?>
				<div class="imera-loadmore"><a class="imera-loadmore-button"><?php esc_html_e( 'Voir plus', 'imera' ); ?><span class="icon-chevron-down"></span></a></div>
			<?php endif; ?>
			<?php else : ?>
			<div class="no-posts">
				<?php echo esc_html_e( 'Aucun résultat', 'imera' ); ?>
			</div>
		<?php endif; ?>

		<div class="related related-events">
			<h2><?php esc_html_e( 'À la une', 'imera' ); ?></h2>
			<a href="<?php echo esc_html( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="archive-link"><?php esc_html_e( 'Voir toutes les actualités', 'imera' ); ?></a>
			<div class="card-container">
				<?php
					$recent_posts = wp_get_recent_posts(
						array(
							'post_type' => 'post',
							'posts_per_page' => 3,
							'post__not_in' => array( get_the_ID() ),
						),
					);
					foreach ( $recent_posts as $recent_post ) {
						imera_get_card_html(
							array(
								'post_id' => $recent_post['ID'],
							)
						);
					}
					?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>

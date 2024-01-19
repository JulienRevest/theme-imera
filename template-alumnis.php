<?php
/**
 * Template Name: Page alumni
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
			<div class="title-scrolling halfwidth"><h1 data-title="<?php esc_html_e( 'Alumni', 'imera' ); ?>"><?php esc_html_e( 'Alumni', 'imera' ); ?></h1></div>
			<div class="title-section-one title-style-F"></div>
			<div class="title-section-two title-style-F">
				<?php echo file_get_contents( get_template_directory() . '/img/symbol.svg' ) ?>
			</div>
		</div>
		<?php
		if ( get_field( 'archive_alumnis_intro', 'options' ) ) :
			?>
			<p class="archive-description"><?php the_field( 'archive_alumnis_intro', 'options' ); ?></p>
			<?php
		endif;
		?>
	</div>

	<div class="global-page archive">
		<?php
		if ( get_field( 'archive_alumnis_subtitle', 'options' ) ) :
			?>
			<h2><?php the_field( 'archive_alumnis_subtitle', 'options' ); ?></h2>
			<?php
		endif;
		?>
		<div class="archive-filters">
			<span><?php esc_html_e( 'Filtrer par', 'imera' ); ?></span>
			<select name="" id="archiveFilterDisciplin" method="GET">
				<option value=""><?php esc_html_e( 'Discipline', 'imera' ); ?></option>
				<?php
				$media_types = get_terms(
					array(
						'taxonomy'   => 'alumni_type',
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
			<select name="" id="archiveFilterYear" method="GET">
				<option value=""><?php esc_html_e( 'Année académique', 'imera' ); ?></option>
				<?php
				$categories = get_terms(
					array(
						'taxonomy'   => 'alumni_year',
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
		<?php
		$current_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
		$args          = array(
			'post_type'    => 'alumnis',
			'orderby'      => 'title',
			'order'        => 'ASC',
			'paged'        => $current_paged,
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'residence',
					'value' => '0',
				),
				array(
					'key' => 'residence',
					'compare' => 'NOT EXISTS',
				),
			),
		);

		$args['tax_query'] = array();
		if ( isset( $_GET['range'] ) ) {
			array_push(
				$args['tax_query'],
				array(
					'taxonomy' => 'alumni_year',
					'field'    => 'slug',
					'terms'    => wp_unslash( $_GET['range'] ),
				),
			);
		}
		if ( isset( $_GET['disciplin'] ) ) {
			array_push(
				$args['tax_query'],
				array(
					'taxonomy' => 'alumni_type',
					'field'    => 'slug',
					'terms'    => wp_unslash( $_GET['disciplin'] ),
				),
			);
		}
		if ( isset( $_GET['search'] ) ) {
			$args = array_merge(
				$args,
				array( 's' => $_GET['search'] ),
			);
		}

		$postslist = new WP_Query( $args );
		imera_load_more_scripts( $args );
		if ( $postslist->have_posts() ) :
			?>
			<div class="card-container">
			<?php
			while ( $postslist->have_posts() ) {
				$postslist->the_post();
				imera_get_card_html(
					array(
						'has_event' => false,
						'is_alumni' => true,
					)
				);
			}
			?>
			</div>
			<?php
			if ( $postslist->max_num_pages > 1 ) :
				?>
				<div class="imera-loadmore"><a class="imera-loadmore-button"><?php esc_html_e( __( 'Voir plus', 'imera' ) ); ?><span class="icon-chevron-down"></span></a></div>
			<?php endif; ?>
		<?php else : ?>
			<div class="no-posts">
				<?php echo esc_html_e( 'Aucun résultat', 'imera' ); ?>
			</div>
		<?php endif; ?>


		<div class="entry-content small">
			<?php
			echo apply_filters( 'the_content', get_post_field( 'post_content', 2381 ) );
			?>
		</div>
	</div>

<?php get_footer(); ?>

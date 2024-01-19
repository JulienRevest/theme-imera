<?php
/**
 * Template Name: Page événements passés
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
			<div class="title-scrolling halfwidth"><h1><?php the_title(); ?></h1></div>
			<div class="title-section-one title-style-F"></div>
			<div class="title-section-two title-style-F">
				<?php echo file_get_contents( get_template_directory() . '/img/symbol.svg' ) ?>
			</div>
		</div>
		<?php
		if ( get_field( 'archive_agenda_past_intro', 'options' ) ) :
			?>
			<p class="archive-description"><?php the_field( 'archive_agenda_past_intro', 'options' ); ?></p>
			<?php
		endif;
		?>
	</div>

	<div class="global-page archive-agenda archive">
		<a href="<?php echo get_post_type_archive_link( 'agenda' ); ?>" class="link-page-events"><?php esc_html_e( "Voir l'agenda", 'imera' ); ?> <span class="icon-chevron-next"></span></a>
		<?php
		if ( get_field( 'archive_agenda_past_subtitle', 'options' ) ) :
			?>
			<h2><?php the_field( 'archive_agenda_past_subtitle', 'options' ); ?></h2>
			<?php
		endif;
		?>
		<div class="archive-filters">
			<span><?php esc_html_e( 'Filtrer par', 'imera' ); ?></span>
			<select name="" id="archiveFilterYear" method="GET">
				<option value=""><?php esc_html_e( 'Année', 'imera' ); ?></option>
				<?php
				$years = array();
				$years_args = array(
					'type'      => 'yearly',
					'format'    => 'custom',
					'before'    => '',
					'after'     => '|',
					'echo'      => false,
					'post_type' => 'agenda',
					'order'     => 'ASC'
				);
				$years_content = wp_get_archives( $years_args );
				if ( ! empty( $years_content ) ) {
					$years_arr = explode('|', $years_content);
					$years_arr = array_filter( $years_arr, function( $item ) {
						return trim( $item ) !== '';
					} );
				}
				if ( $years_arr ) {
					foreach ( $years_arr as $year_item ) :
						$year_row = trim( $year_item );
						preg_match( '/href=["\']?([^"\'>]+)["\']>(.+)<\/a>/', $year_row, $year_vars );
						?>
						<option value="<?php echo esc_html( $year_vars[2] ); ?>">
							<?php echo esc_html( $year_vars[2] ); ?>
						</option>
							<?php
					endforeach;
				}
				?>
			</select>
			<div class="archive-searchbox">
				<button class="archive-search-button"><span class="icon-search"></span></button>
				<input id="archive-search" type="search" placeholder="<?php esc_html_e( 'Rechercher par nom, mots clés', 'imera' ); ?>"/>
			</div>
		</div>

			<?php
			$current_date = strtotime( gmdate( 'M d, Y' ) );
			$current_paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

			$args          = array(
				'post_type'    => 'agenda',
				'orderby'      => 'meta_value',
				'meta_key'     => 'event_date',
				'order'        => 'DESC',
				'paged'        => $current_paged,
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key'     => 'event_date',
						'compare' => '<=',
						'value'   => date( 'Ymd' ),
					),
					array(
						'relation' => 'OR',
						array(
							'key'     => 'event_date_end',
							'compare' => '<=',
							'value'   => date( 'Ymd' ),
						),
						array(
							'key'     => 'event_date_end',
							'compare' => 'NOT EXISTS',
						),
					),
				),
			);

			$postslist = new WP_Query( $args );
			imera_load_more_scripts( $args );
			if ( $postslist->have_posts() ) :
				?>
				<div class="card-container">
				<?php
				while ( $postslist->have_posts() ) {
					$postslist->the_post();
					imera_get_card_html();
				}
				?>
				</div>
				<?php
				if ( $postslist->max_num_pages > 1 ) :
					?>
					<div class="imera-loadmore"><a class="imera-loadmore-button"><?php esc_html_e( "Voir plus", 'imera' ); ?><span class="icon-chevron-down"></span></a></div>
					<?php
				endif;
			else :
			?>
			<div class="no-posts">
				<?php echo esc_html_e( 'Aucun résultat', 'imera' ); ?>
			</div>
				<?php
			endif;
			?>
	</div>
<?php get_footer(); ?>

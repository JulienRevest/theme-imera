<?php
/**
 * Front
 *
 * @package imera-theme
 */

/**
 * HTML5 theme support
 */
add_theme_support(
	'html5',
	array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
	)
);

/**
 * Remove WordPress version
 */
function elabo_remove_version() {
	return '';
}
add_filter( 'the_generator', 'elabo_remove_version' );

/**
 * Filter the except length to n words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function elabo_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'elabo_custom_excerpt_length', 999 );


/**
 * Feed rss
 *
 * @linked https://developer.wordpress.org/reference/functions/add_theme_support/#feed-links
 **/
function elabo_rss() {
	/* disable comments feed */
	add_filter( 'feed_links_show_comments_feed', '__return_false' );
}
add_action( 'after_setup_theme', 'elabo_rss' );

/**
 * Order agenda archive by custom date
 *
 * @param wp_query $query Query to order.
 */
function imera_agenda_orderby( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'agenda' ) ) {
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'event_date' );
		$query->set( 'order', 'ASC' );
		$query->set(
			'meta_query',
			array(
				'relation' => 'OR',
				array(
					'key'     => 'event_date',
					'compare' => '>=',
					'value'   => date( 'Ymd' ),
				),
				array(
					'key'     => 'event_date_end',
					'compare' => '>=',
					'value'   => date( 'Ymd' ),
				),
			)
		);
	}
	return $query;
}
add_action( 'pre_get_posts', 'imera_agenda_orderby' );


/**
 * Archive filters script
 */
function imera_archive_scripts() {
	// if ( ! is_archive() || ! is_search() ) {	//TODO: Disable JS if noy on archive or search results
	// 	return;
	// }

	wp_register_script( 'filters', get_template_directory_uri() . '/js/archives-filters.js', array( 'jquery' ) );
	wp_enqueue_script( 'filters' );
}
add_action( 'wp_enqueue_scripts', 'imera_archive_scripts' );


/**
 * Search block acf/alumni-info recursive
 */
function imera_search_recursive_block_alumni( $block_object ) {
	if ( 'acf/alumni-info' === $block_object['blockName'] ) {
		return $block_object;
	}
	if ( ! empty( $block_object['innerBlocks'] ) ) {
		foreach ( $block_object['innerBlocks'] as $inner_block ) {
			$inner_block_object = imera_search_recursive_block_alumni( $inner_block );
			if ( $inner_block_object ) {
				return $inner_block_object;
			}
		}
	}
	return false;
}

/**
 * Search block acf/post-infos recursive
 */
function imera_search_recursive_block_post( $block_object ) {
	if ( 'acf/post-info' === $block_object['blockName'] ) {
		return $block_object;
	}
	if ( ! empty( $block_object['innerBlocks'] ) ) {
		foreach ( $block_object['innerBlocks'] as $inner_block ) {
			$inner_block_object = imera_search_recursive_block_post( $inner_block );
			if ( $inner_block_object ) {
				return $inner_block_object;
			}
		}
	}
	return false;
}

/**
 * Print out the current card post HTML
 *
 * @param int  $parameters['post_id'] ID of the current post.
 * @param bool $parameters['has_event'] Should the card have an event section or not.
 */
function imera_get_card_html( $args = array() ) {
	$parameters = array_merge(
		array(
			'post_id' => null,
			'has_event' => true,
			'is_ressource' => false,
			'is_alumni' => false,
		),
		$args,
	);
	if ( empty( $parameters['post_id'] ) ) {
		$parameters['post_id'] = get_the_ID();
	}
	?>
	<div class="card">
		<a href="<?php echo get_post_permalink( $parameters['post_id'] ); ?>">
			<div class="card-thumbnail">
			<?php if ( has_post_thumbnail( $parameters['post_id'] ) ) : ?>
				<?php echo get_the_post_thumbnail( $parameters['post_id'], array( 448, 448 ) ); ?>
			<?php else : ?>
				<img src="<?php echo get_template_directory_uri() . '/img/placeholder.png'; ?>" width="448" height="448">
			<?php endif; ?>
			</div>
			<?php if ( $parameters['is_ressource'] ) : ?>
				<?php
				$type_name = wp_get_post_terms( $parameters['post_id'], 'ressource_type', array( 'fields' => 'names' ) );
				$type_slug = wp_get_post_terms( $parameters['post_id'], 'ressource_type', array( 'fields' => 'slugs' ) );
				$category_name = wp_get_post_terms( $parameters['post_id'], 'ressource_category', array( 'fields' => 'names' ) );
				$category_slug = wp_get_post_terms( $parameters['post_id'], 'ressource_category', array( 'fields' => 'slugs' ) );
				$ressource = '';
				if ( empty( $category_slug ) || empty( $type_slug ) ) {
					$ressource .= count( $type_name ) > 0 ? $type_name[0] : null;
					$ressource .= count( $category_name ) > 0 ? $category_name[0] : null;
				} else {
					$ressource .= count( $type_name ) > 0 ? $type_name[0] : null;
					$ressource .= ' · ';
					$ressource .= count( $category_name ) > 0 ? $category_name[0] : null;
				}
				if ( ! empty( $type_slug ) ) {
					$ressource_icon = 'icon-' . $type_slug[0];
				}
				?>
				<div class="card-ressource-info">
					<span class="card-ressource-icon <?php echo isset( $ressource_icon ) ? esc_html( $ressource_icon ) : ''; ?>"></span>
					<?php
						echo sprintf(
							'<div class="card-ressource-taxo">%1s</div>',
							esc_html( $ressource ),
						);
					?>
				</div>
			<?php endif; ?>
			<?php if ( $parameters['has_event'] ) : ?>
			<div class="card-event-info">
				<?php
				$date = get_field( 'event_date', $parameters['post_id'] );
				if ( get_field( 'event_date_end', $parameters['post_id'] ) ) {
					$date = $date . ' / ' . get_field( 'event_date_end', $parameters['post_id'] );
				}
				if ( ! empty( $date ) ) {
					$blocks = parse_blocks( get_the_content( $parameters['post_id'] ) );
					foreach ( $blocks as $block ) {
						$block_post = imera_search_recursive_block_post( $block );
						if ( $block_post ) {
							$info = $block_post['attrs']['data']['event_info'];
						}
					}
					echo sprintf(
						'<date class="card-date">%1s</date>%2s',
						esc_html( $date ),
						empty( $info ) ? '' : '<span class="card-info">, ' . esc_html( $info ) . '</span>',
					);
				}
				?>
			</div>
			<?php endif; ?>
			<h3><?php esc_html_e( get_the_title( $parameters['post_id'] ) ); ?></h3>
			<?php if ( $parameters['is_alumni'] ) : ?>
			<div class="card-alumni-info">
				<?php
				$type   = wp_get_post_terms( $parameters['post_id'], 'alumni_type', array( 'fields' => 'names' ) );
				$blocks = parse_blocks( get_the_content( $parameters['post_id'] ) );
				foreach ( $blocks as $block ) {
					$block_alumni = imera_search_recursive_block_alumni( $block );
					if ( $block_alumni && array_key_exists( 'data', $block_alumni['attrs'] ) ) {
						$year = $block_alumni['attrs']['data']['residence_period'];
					}
				}
				echo sprintf(
					'<div class="card-alumni-field">%1s</div><div class="card-alumni-year">%2s</div>',
					empty( $type ) ? '' : esc_html( implode( ', ', $type ) ),
					empty( $year ) ? '' : esc_html( $year ),
				);
				?>
			</div>
			<?php endif; ?>
		</a>
	</div>
	<?php
}

/**
 * Load more posts
 *
 * @param Array $query_args Argument of the WP_Query that needs to be infinitely loaded.
 */
function imera_load_more_scripts( $query_args, $simple = false ) {
	global $wp_query;

	wp_register_script( 'loadmore', get_template_directory_uri() . '/js/loadmore.js', array( 'jquery' ) );

	wp_localize_script(
		'loadmore',
		'imera_loadmore_params',
		array(
			'ajaxurl'      => site_url() . '/wp-admin/admin-ajax.php',
			'query_args'   => $simple ? json_encode( $wp_query->query_vars ) : $query_args,	// Pass all the query args
			'current_page' => get_query_var( 'paged', 0 ),	// Default value for paged, if it's not set after the first loop
			'simple'       => $simple,
		)
	);

	wp_enqueue_script( 'loadmore' );
}

/**
 * Handle loadmore AJAX requests, infinite scroll
 */
function imera_loadmore_ajax_handler() {
	if ( $_POST['simple'] ) {
		$args                = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged']       = $_POST['page'] + 1; // We need next page to be loaded.
		$args['post_status'] = 'publish';

		query_posts( $args );

		while ( have_posts() ) {
			the_post();
			imera_get_card_html(
				array(
					'has_event' => false,
					'is_ressource' => true,
				)
			);
		}
	} else {
		// Get the query args from the JS Ajax POST.
		$args          = $_POST['query'];
		$args['paged'] = $_POST['page'] + 1;	// Change the paged argument to the new page

		// Create new query with the same arguments.
		$postslist = new WP_Query( $args );
		if ( $postslist->have_posts() ) :
			?>
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
			<?php
		endif;
	}
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action( 'wp_ajax_loadmore', 'imera_loadmore_ajax_handler' );
add_action( 'wp_ajax_nopriv_loadmore', 'imera_loadmore_ajax_handler' );

<?php
/**
 * Filters for archive pages
 *
 * @package imera-theme
 */

/**
 * Filter ressources by taxonomy
 *
 * @param wp_query $query Query to order.
 */
function imera_ressources_filter( $query ) {
	if ( is_admin() ) {
		return $query;
	}
	if ( $query->is_main_query() && is_post_type_archive( 'ressources' ) ) {

		if ( isset( $_GET['search'] ) ) {
			$query->set( 's', $_GET['search'] );
		}

		$media = isset( $_GET['media'] ) ? wp_unslash( $_GET['media'] ) : false;
		$category     = isset( $_GET['category'] ) ? wp_unslash( $_GET['category'] ) : false;

		if ( ! $category && ! $media ) {
			return $query;
		}

		$taxquery = array();

		if ( $media ) {
			$taxquery[] = array(
				'taxonomy' => 'ressource_type',
				'field'    => 'slug',
				'terms'    => $media,
			);
		}

		if ( $category ) {
			$taxquery[] = array(
				'taxonomy' => 'ressource_category',
				'field'    => 'slug',
				'terms'    => $category,
			);
		}

		if ( 1 < count( $taxquery ) ) {
			$taxquery['relation'] = 'AND';
		}

		$query->set( 'tax_query', $taxquery );
	}
	return $query;
}
add_action( 'pre_get_posts', 'imera_ressources_filter' );

/**
 * Filter alumnis and residents by taxonomy
 *
 * @param wp_query $query Query to order.
 */
function imera_alumnis_filter( $query ) {
	if ( is_admin() ) {
		return $query;
	}

	if ( $query->is_main_query() ) {

		if ( is_post_type_archive( 'alumnis' ) ) {
			$prefix = 'alumni';
		} else if ( is_post_type_archive( 'residents' ) ) {
			$prefix = 'resident';
		} else {
			return $query;
		}
		if ( isset( $_GET['search'] ) ) {
			$query->set( 's', $_GET['search'] );
		}

		$disciplin = isset( $_GET['disciplin'] ) ? wp_unslash( $_GET['disciplin'] ) : false;
		$range     = isset( $_GET['range'] ) ? wp_unslash( $_GET['range'] ) : false;

		if ( ! $range && ! $disciplin ) {
			return $query;
		}

		$taxquery = array();

		if ( $disciplin ) {
			$taxquery[] = array(
				'taxonomy' => $prefix . '_type',
				'field'    => 'slug',
				'terms'    => $disciplin,
			);
		}

		if ( $range ) {
			$taxquery[] = array(
				'taxonomy' => $prefix . '_year',
				'field'    => 'slug',
				'terms'    => $range,
			);
		}

		if ( 1 < count( $taxquery ) ) {
			$taxquery['relation'] = 'AND';
		}

		$query->set( 'tax_query', $taxquery );
	}
	return $query;
}
add_action( 'pre_get_posts', 'imera_alumnis_filter' );


/**
 * Filter news 
 *
 * @param wp_query $query Query to order.
 */
function imera_news_filter( $query ) {
	if ( is_admin() ) {
		return $query;
	}

	if ( $query->is_main_query() ) {
		if ( is_home() ) {
			if ( isset( $_GET['search'] ) ) {
				$query->set( 's', $_GET['search'] );
			}
		}
	}
	return $query;
}
add_action( 'pre_get_posts', 'imera_news_filter' );
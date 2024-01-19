<?php
/**
 * CPT Agenda
 *
 * @package imera-theme
 *
 * @linked https://developer.wordpress.org/reference/functions/register_post_type/
 * Supports : title, editor, comments, revisions, trackbacks, author, excerpt, page-attributes, thumbnail, custom-fields, post-formats
 */

/**
 * Register post type
 */
function imera_register_cpt_candidatures() {
	$labels = array(
		'name'               => 'Candidatures',
		'singular_name'      => 'Candidature',
		'add_new'            => 'Ajouter une candidature',
		'add_new_item'       => 'Ajouter une candidature',
		'edit_item'          => 'Modifier une candidature',
		'new_item'           => 'Nouvel candidature',
		'view_item'          => 'Afficher la candidature',
		'search_items'       => 'Rechercher une candidature',
		'not_found'          => 'Aucune candidature trouvé',
		'not_found_in_trash' => 'Aucune candidature trouvé dans la corbeille',
		'parent_item_colon'  => 'Candidature parente',
		'menu_name'          => 'Candidature',
	);
	$args   = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-aside',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		// 'rewrite'             => array( 'slug' => 'faq' ),
		// Définir un modèle
		'template' => array(
			array(
				'core/shortcode',
				array(
					'text' => '[addtoany]',
					'lock' => array(
						'move'   => true,
						'remove' => true,
					),
				),
			),
			array(
				'core/paragraph',
				array(
					'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce urna nunc, iaculis nec leo at, ullamcorper egestas justo. Aliquam sit amet lacus vitae turpis elementum lacinia vel et sem. Mauris vehicula odio ligula, sit amet finibus felis faucibus at. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec a ex et massa molestie condimentum. Phasellus est tortor, laoreet nec lacinia sit amet, semper nec felis. Ut a fermentum tellus. Phasellus suscipit convallis hendrerit. Phasellus vel dolor metus. Morbi facilisis aliquet odio eu iaculis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean imperdiet erat in turpis sagittis, a viverra ante posuere. ',
					'align'       => 'center',
				),
			),
			array(
				'core/spacer',
				array(
					'height' => '64px',
				),
			),
			array(
				'gravityforms/form',
				array(
					'title' => false,
					'description' => false,
				),
			),
		),
		//'template_lock' => 'all', // Verrouiller le modèle pour empêcher les modifications
	);
	register_post_type( 'candidatures', $args );
}
add_action( 'init', 'imera_register_cpt_candidatures', 10 );


/**
 * Register taxonomy
 */

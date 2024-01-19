<?php
/**
 * CPT Ressource
 *
 * @package imera-theme
 *
 * @linked https://developer.wordpress.org/reference/functions/register_post_type/
 * Supports : title, editor, comments, revisions, trackbacks, author, excerpt, page-attributes, thumbnail, custom-fields, post-formats
 */

/**
 * Register post type
 */
function imera_register_cpt_ressource() {
	$labels = array(
		'name'               => 'Ressources',
		'singular_name'      => 'Ressource',
		'add_new'            => 'Ajouter une ressource',
		'add_new_item'       => 'Ajouter une ressource',
		'edit_item'          => 'Modifier une ressource',
		'new_item'           => 'Nouvelle ressource',
		'view_item'          => 'Afficher la ressource',
		'search_items'       => 'Rechercher une ressource',
		'not_found'          => 'Aucun ressource trouvée',
		'not_found_in_trash' => 'Aucun ressource trouvée dans la corbeille',
		'parent_item_colon'  => 'Ressource parente',
		'menu_name'          => 'Ressources',
	);
	$args   = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-media-document',
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
				'core/post-featured-image',
				array(),
			),
			array(
				'core/spacer',
				array(
					'height' => '64px',
				),
			),
		),
	);
	register_post_type( 'ressources', $args );
}
add_action( 'init', 'imera_register_cpt_ressource', 10 );


/**
 * Register taxonomy
 */
function imera_register_taxo_ressource_type() {
	$labels_type = array(
		'name'          => 'Types de média',
		'singular_name' => 'Type de média',
		'search_items'  => 'Rechercher un type',
		'all_items'     => 'Tous les types',
		'edit_item'     => 'Modifier le type',
		'update_item'   => 'Mettre à jour le type',
		'add_new_item'  => 'Ajouter un type',
		'menu_name'     => 'Types de média',
	);
	$args_type   = array(
		'labels'            => $labels_type,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'rewrite'           => true,
		'query_var'         => false,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'ressource_type', array( 'ressources' ), $args_type );
}
add_action( 'init', 'imera_register_taxo_ressource_type', 10 );

function imera_register_taxo_ressource_category() {
	$labels_type = array(
		'name'          => 'Catégories',
		'singular_name' => 'Catégorie',
		'search_items'  => 'Rechercher une catégorie',
		'all_items'     => 'Toutes les catégories',
		'edit_item'     => 'Modifier la catégorie',
		'update_item'   => 'Mettre à jour la catégorie',
		'add_new_item'  => 'Ajouter une catégorie',
		'menu_name'     => 'Catégories',
	);
	$args_type   = array(
		'labels'            => $labels_type,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'rewrite'           => true,
		'query_var'         => false,
		'show_in_rest'      => true,
	);
	register_taxonomy( 'ressource_category', array( 'ressources' ), $args_type );
}
add_action( 'init', 'imera_register_taxo_ressource_category', 10 );

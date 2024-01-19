<?php
/**
 * CPT
 *
 * @package imera-theme
 *
 * @linked https://developer.wordpress.org/reference/functions/register_post_type/
 * Supports : title, editor, comments, revisions, trackbacks, author, excerpt, page-attributes, thumbnail, custom-fields, post-formats
 */

/**
 * Register post type
 */
function elabo_register_cpt_documents() {
	$labels = array(
		'name'               => 'Documents',
		'singular_name'      => 'Document',
		'add_new'            => 'Ajouter un document',
		'add_new_item'       => 'Ajouter un document',
		'edit_item'          => 'Modifier un document',
		'new_item'           => 'Nouveau document',
		'view_item'          => 'Afficher le document',
		'search_items'       => 'Rechercher un document',
		'not_found'          => 'Aucun document trouvé',
		'not_found_in_trash' => 'Aucun document trouvé dans la corbeille',
		'parent_item_colon'  => 'Document parent',
		'menu_name'          => 'Documents',
	);
	$args   = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		// 'rewrite'             => array( 'slug' => 'faq' ),
	);
	register_post_type( 'documents', $args );
}
// add_action( 'init', 'elabo_register_cpt_documents', 10 );


/**
 * Register taxonomy
 */
function elabo_register_taxo_document_type() {
	$labels_type = array(
		'name'          => 'Type',
		'singular_name' => 'Type',
		'search_items'  => 'Rechercher un type',
		'all_items'     => 'Tous les types',
		'edit_item'     => 'Modifier le type',
		'update_item'   => 'Mettre à jour le type',
		'add_new_item'  => 'Ajouter un type',
		'menu_name'     => 'Types',
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
	register_taxonomy( 'document_type', array( 'documents' ), $args_type );
}
// add_action( 'init', 'elabo_register_taxo_document_type', 10 );

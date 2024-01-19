<?php
/**
 * CPT Alumni
 *
 * @package imera-theme
 *
 * @linked https://developer.wordpress.org/reference/functions/register_post_type/
 * Supports : title, editor, comments, revisions, trackbacks, author, excerpt, page-attributes, thumbnail, custom-fields, post-formats
 */

/**
 * Register post type
 */
function imera_register_cpt_alumni() {
	$labels = array(
		'name'               => 'Chercheurs',
		'singular_name'      => 'Chercheur',
		'add_new'            => 'Ajouter un chercheur',
		'add_new_item'       => 'Ajouter un chercheur',
		'edit_item'          => 'Modifier un chercheur',
		'new_item'           => 'Nouveau chercheur',
		'view_item'          => "Afficher le chercheur",
		'search_items'       => 'Rechercher un chercheur',
		'not_found'          => 'Aucun chercheur trouvé',
		'not_found_in_trash' => 'Aucun chercheur trouvé dans la corbeille',
		'parent_item_colon'  => 'Chercheur parent',
		'menu_name'          => 'Chercheurs',
	);
	$args   = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post',
		'rewrite'             => array( 'slug' => 'chercheur' ),
		'show_in_rest'        => true,
		'template' => array(
			array(
				'core/columns',
				array(
					'lock' => array(
						'move'   => true,
						'remove' => true,
					),
				),
				array(
					array(
						'core/column',
						array(
							'lock' => array(
								'move'   => true,
								'remove' => true,
							),
						),
						array(
							array(
								'core/post-featured-image',
								array(
									'lock' => array(
										'move'   => true,
										'remove' => false,
									),
								),
							),
							array(
								'core/group',
								array(
									'spacing' => array(
										'padding' => array(
											'top' => '32px',
											'left' => '32px',
											'right' => '32px',
											'bottom' => '32px',
										),
									),
								),
								array(
									array(
										'core/heading',
										array(
											'level'   => 3,
											'placeholder' => __( "Nom du chercheur", 'imera' ),
											'lock' => array(
												'move'   => true,
												'remove' => false,
											),
										),
									),
									array(
										'acf/alumni-info',
										array(
											'lock' => array(
												'move'   => true,
												'remove' => false,
											),
										),
									),
									array(
										'core/shortcode',
										array(
											'text' => '[curriculumvitae]',
											'lock' => array(
												'move'   => true,
												'remove' => false,
											),
										),
									),
								),
							),
						),
					),
					array(
						'core/column',
						array(
							'lock' => array(
								'move'   => true,
								'remove' => true,
							),
						),
						array(
							array(
								'core/spacer',
								array(
									'height' => '270px',
								),
							),
							array(
								'core/shortcode',
								array(
									'text' => '[status]',
									'lock' => array(
										'move'   => false,
										'remove' => false,
									),
								),
							),
							array(
								'core/heading',
								array(
									'content' => __( 'Projet de recherche', 'imera' ),
									'level'   => 3,
									'placeholder' => __( "Projet de recherche", 'imera' ),
									'lock' => array(
										'move'   => true,
										'remove' => false,
									),
								),
							),
							array(
								'core/paragraph',
								array(
									'placeholder' => '',
									'lock' => array(
										'move'   => true,
										'remove' => false,
									),
								),
							),
							array(
								'core/heading',
								array(
									'content' => __( 'Résumé du projet', 'imera' ),
									'level'   => 3,
									'placeholder' => __( "Résumé du projet", 'imera' ),
									'lock' => array(
										'move'   => true,
										'remove' => false,
									),
								),
							),
							array(
								'core/paragraph',
								array(
									'placeholder' => '',
									'lock' => array(
										'move'   => true,
										'remove' => false,
									),
								),
							),
							array(
								'core/heading',
								array(
									'content' => __( 'Biographie', 'imera' ),
									'level'   => 3,
									'placeholder' => __( "Biographie", 'imera' ),
									'lock' => array(
										'move'   => true,
										'remove' => false,
									),
								),
							),
							array(
								'core/paragraph',
								array(
									'placeholder' => '',
									'lock' => array(
										'move'   => true,
										'remove' => false,
									),
								),
							),
						),
					),
				),
			),
		),
	);
	register_post_type( 'alumnis', $args );
}
add_action( 'init', 'imera_register_cpt_alumni', 10 );


/**
 * Register taxonomy discipline
 */
function imera_register_taxo_alumni_discipline() {
	$labels_type = array(
		'name'          => 'Disciplines',
		'singular_name' => 'Discipline',
		'search_items'  => 'Rechercher une discipline',
		'all_items'     => 'Toutes les disciplines',
		'edit_item'     => 'Modifier la discipline',
		'update_item'   => 'Mettre à jour la discipline',
		'add_new_item'  => 'Ajouter une discipline',
		'menu_name'     => 'Disciplines',
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
	register_taxonomy( 'alumni_type', array( 'alumnis' ), $args_type );
}
add_action( 'init', 'imera_register_taxo_alumni_discipline', 10 );


/**
 * Register taxonomy chaire
 */
function imera_register_taxo_alumni_chaire() {
	$labels_type = array(
		'name'          => 'Chaire',
		'singular_name' => 'Chaire',
		'search_items'  => 'Rechercher une chaire',
		'all_items'     => 'Toutes les chaires',
		'edit_item'     => 'Modifier la chaire',
		'update_item'   => 'Mettre à jour la chaire',
		'add_new_item'  => 'Ajouter une chaire',
		'menu_name'     => 'Chaires',
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
	register_taxonomy( 'alumni_chaire', array( 'alumnis' ), $args_type );
}
add_action( 'init', 'imera_register_taxo_alumni_chaire', 10 );

/**
 * Register taxonomy programme de recherche
 */
function imera_register_taxo_alumni_programme() {
	$labels_type = array(
		'name'          => 'Programme de recherche',
		'singular_name' => 'Programme de recherche',
		'search_items'  => 'Rechercher un programme de recherche',
		'all_items'     => 'Tous les programmes de recherche',
		'edit_item'     => 'Modifier le programme de recherche',
		'update_item'   => 'Mettre à jour le programme de recherche',
		'add_new_item'  => 'Ajouter un programme de recherche',
		'menu_name'     => 'Programmes de recherche',
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
	register_taxonomy( 'alumni_programme', array( 'alumnis' ), $args_type );
}
add_action( 'init', 'imera_register_taxo_alumni_programme', 10 );


/**
 * Register taxonomy year
 */
function imera_register_taxo_alumni_year() {
	$labels_type = array(
		'name'          => 'Années académique',
		'singular_name' => 'Année académique',
		'search_items'  => 'Rechercher une année académique',
		'all_items'     => 'Toutes les année académique',
		'edit_item'     => 'Modifier l\'année académique',
		'update_item'   => 'Mettre à jour l\'année académique',
		'add_new_item'  => 'Ajouter une année académique',
		'menu_name'     => 'Années académique',
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
	register_taxonomy( 'alumni_year', array( 'alumnis' ), $args_type );
}
add_action( 'init', 'imera_register_taxo_alumni_year', 10 );


/**
 * Add column status
 */
function elabo_add_acf_column( $columns ) {
	if ( ! is_admin() ) {
		return;
	}
	$finalColumns = array();
	foreach ( $columns as $k => $v ) {
		$finalColumns[$k] = $v;
		if ( 'title' === $k)
			$finalColumns['alumni_status'] = 'Status';
	}
	return $finalColumns;
}
add_filter('manage_alumnis_posts_columns', 'elabo_add_acf_column');

/**
 * Add value in column status
 */
function elabo_add_acf_column_value( $column, $post_id ) {
	if ( ! is_admin() ) {
		return;
	}
	switch ( $column ) {
		case 'alumni_status':
			if ( get_field( 'residence', $post_id ) ) {
				echo 'En résidence';
			} else {
				echo 'Alumni';
			}
		break;
	}
}
add_action( 'manage_alumnis_posts_custom_column', 'elabo_add_acf_column_value', 10, 2 );

/**
 * Add sort by status
 */
function elabo_add_acf_column_sortable( $columns ) {
	if ( ! is_admin() ) {
		return;
	}
	$columns['alumni_status'] = 'Status';
	return $columns;
}
add_filter( 'manage_edit-alumnis_sortable_columns', 'elabo_add_acf_column_sortable' );

// modification de l'order by
function elabo_add_acf_column_orderby( $query ) {
	if(!is_admin())
		return;
	$orderby = $query->get( 'orderby');
	if('alumni_status' == $orderby) {
		$query->set('meta_key','resident');
		$query->set('orderby','meta_value_num');
	}
}
add_action('pre_get_posts', 'elabo_add_acf_column_orderby');
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
function imera_register_cpt_agenda() {
	$labels = array(
		'name'               => 'Agenda',
		'singular_name'      => 'Agenda',
		'add_new'            => 'Ajouter un évenement',
		'add_new_item'       => 'Ajouter un évenement',
		'edit_item'          => 'Modifier un évenement',
		'new_item'           => 'Nouvel évenement',
		'view_item'          => "Afficher l'évenement",
		'search_items'       => 'Rechercher un évenement',
		'not_found'          => 'Aucun évenement trouvé',
		'not_found_in_trash' => 'Aucun évenement trouvé dans la corbeille',
		'parent_item_colon'  => 'Evenement parent',
		'menu_name'          => 'Agenda',
	);
	$args   = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-calendar-alt',
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
				'acf/post-info',    // Custom ACF block.
				array(
					'lock' => array(
						'move'   => true,
						'remove' => true,
					),
					'verticalAlignment' => 'center',
				),
			),
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
				'core/heading',
				array(
					'selectedLevel' => '2',
					'placeholder'   => 'Sujet de votre évenement',
					'align'         => 'full',
					'lock' => array(
						'move'   => true,
						'remove' => false,
					),
				),
			),
			array(
				'core/paragraph',
				array(
					'placeholder' => 'Rédigez votre évenement ici',
				),
			),
			array(
				'core/spacer',
				array(
					'height' => '64px',
				),
			),
		),
		//'template_lock' => 'all', // Verrouiller le modèle pour empêcher les modifications
	);
	register_post_type( 'agenda', $args );
}
add_action( 'init', 'imera_register_cpt_agenda', 10 );


/**
 * Register taxonomy
 */

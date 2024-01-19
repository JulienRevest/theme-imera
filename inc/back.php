<?php
/**
 * Back
 *
 * @package imera-theme
 */

/**
 * CSS editor
 */
function elabo_admin_editor_css() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/admin-editor.min.css' );
}
add_action( 'after_setup_theme', 'elabo_admin_editor_css' );

/**
 * Block full width
 */
function elabo_block_full_width() {
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'elabo_block_full_width' );


/**
 * Custom login
 *
 * @linked https://codex.wordpress.org/Customizing_the_Login_Form
 */
function elabo_custom_login() {
	?>
	<style type="text/css">
		html, body.login {
			height: auto;
		}
		body.login {
			background: #fafafa; /* bg color or image */
		}
		#login h1 a, .login h1 a {
			background-image: url( <?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/login.png ); /* logo img */
			height: 150px; /* logo height */
			width: 300px; /* logo width */
			background-color: white;
			background-repeat: no-repeat;
			background-position: 50% 50%;
			background-size: contain;
		}
		.login #backtoblog,
		.login #nav{
			text-align: center;
		}
		.login #login {
			box-shadow: 0 0 15px rgba(0,0,0,.8);
			border-radius: 10px;
			padding: 15px;
			margin: 2% auto 0;
			background: #fff;
		}
		.login.wp-core-ui .button.button-large,
		.login input[type="submit"] {
			width: 100%;
			padding: 10px;
			margin-top: 15px;
			font-size: 1.13em;
			height: auto;
		}
		body.login form {
			box-shadow: 0 0 0;
		}
		.language-switcher {
			width: 320px;
		}
	</style>
	<?php
}
add_action( 'login_enqueue_scripts', 'elabo_custom_login' );


/**
 * Modifier l'URL du logo de connexion sur la page d'administration
 */
function elabo_custom_login_url( $url ) {
	// On définit la nouvelle URL du lien ici
	return get_site_url();
}
add_filter( 'login_headerurl', 'elabo_custom_login_url' );


/**
 * Admin menu, hide tags
 */
function elabo_unregister_tags_for_posts() {
	unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action( 'init', 'elabo_unregister_tags_for_posts' );

/**
 * Curriculum Vitae button
 */
function cv_button() {
	$cv_link = get_field( 'curriculum_vitae' );
	if ( empty( $cv_link ) ) {
		return;
	}
	$cv = sprintf(
		'<div class="alumni-cv-button"><a href="%1s">%2s<span class="icon-arrow-down"></span></a></div>',
		$cv_link,
		__( 'Curriculum Vitae', 'imera' ),
	);
	return $cv;
}
add_shortcode( 'curriculumvitae', 'cv_button' );


/**
 * Sharing buttons
 */
function elabo_sharing_buttons() {
	return '<div class="imera-sharing">
	<a href="" class="facebook-btn"><span class="icon-facebook"></span></a>
	<a href="" class="twitter-btn"><span class="icon-twitter"></span></a>
	<a href="" class="linkedin-btn"><span class="icon-linkedin"></span></a>
	</div>';
}
add_shortcode( 'addtoany', 'elabo_sharing_buttons' );

/**
 * Remontée de l'agenda sur Home
 */
function remontee_agenda() {
	$out = '';
	$out .= '<div class="card-container">';
	$recent_posts = wp_get_recent_posts(
		array(
			'post_type'      => 'agenda',
			'posts_per_page' => 3,
			'post__not_in'   => array( get_the_ID() ),
			'orderby'        => 'meta_value',
			'meta_key'       => 'event_date',
			'order'          => 'ASC',
			'meta_query'     => array(
				array(
					'key'     => 'event_date',
					'compare' => '>=',
					'value'   => date( 'Ymd' ),
				),
			)
		),
	);
	ob_start();
	foreach ( $recent_posts as $recent_post ) {
		imera_get_card_html(
			array(
				'post_id' => $recent_post['ID'],
			)
		);
	}
	$out .= ob_get_contents();
	ob_end_clean();
	$out .= '</div>';
	return $out;
}
add_shortcode( 'remonteeagenda', 'remontee_agenda' );


/**
 * Remontée des actualités sur Home
 */
function remontee_actualites() {
	ob_start();
	?>
			<div class="card-container">
				<?php
				$recent_posts = wp_get_recent_posts(
					array(
						'post_type'      => 'post',
						'posts_per_page' => 3,
						'post__not_in'   => array( get_the_ID() ),
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
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'remonteeactualites', 'remontee_actualites' );


/**
 * Remontée des pages soeurs
 */
function remontee_pages_soeurs() {
	ob_start();
	?>
			<div class="card-container">
				<?php
				$pages = get_pages(
					array(
						'child_of' => wp_get_post_parent_id(),
						'exclude'  => array( get_the_ID() ),
					)
				);
				foreach ( $pages as $page ) {
					imera_get_card_html(
						array(
							'post_id' => $page->ID,
						)
					);
				}
				?>
			</div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode( 'remonteepagessoeurs', 'remontee_pages_soeurs' );



/**
 * Remontée des pages soeurs
 */
function view_status() {
	$out = '';
	if ( get_field( 'residence' ) && get_field( 'residence_view_txt' ) ) {
		$out = '<div class="chercheur-status">' . __( "Actuellement en résidence à l'Iméra", 'imera' ) . '</div>';
	}
	return $out;
}
add_shortcode( 'status', 'view_status' );


/**
 * Copie des taxonomies
 * https://polylang.pro/doc/filter-reference/#pll_copy_taxonomies
 *
 * @param array $taxonomies List of taxonomy names.
 * @param bool  $sync       True if it is synchronization, false if it is a copy.
 */
function copy_year( $taxonomies, $sync ) {
	$taxonomies[] = 'alumni_year';
	$taxonomies[] .= 'resident_year';
	$sync = false;
	return $taxonomies;
}
add_filter( 'pll_copy_taxonomies', 'copy_year', 10, 2 );


/**
 * Admin menu, hidde comments
 * $restricted = array( __( 'Links' ), __( 'Comments' ), __( 'Media' ), __( 'Plugins' ), __( 'Tools' ), __( 'Users' ) );
 */
function elabo_remove_menu_items() {
	global $menu;
	$restricted = array( __( 'Comments' ) );
	end( $menu );
	while ( prev( $menu ) ) {
		$value = explode( ' ', $menu[ key( $menu ) ][0] );
		if ( in_array( null !== $value[0] ? $value[0] : '', $restricted, true ) ) {
			unset( $menu[ key( $menu ) ] );
		}
	}
}
add_action( 'admin_menu', 'elabo_remove_menu_items' );

/**
 * Déclarer un bloc Gutenberg avec ACF
 * https://www.advancedcustomfields.com/resources/acf-blocks-with-block-json/
 */
function imera_register_acf_block_types() {
	register_block_type( get_template_directory() . '/inc/acf-blocks/alumni-info/block.json' );
	register_block_type( get_template_directory() . '/inc/acf-blocks/post-infos/block.json' );
}

add_action( 'init', 'imera_register_acf_block_types' );

/**
 * Register default template for Articles
 */
function imera_register_default_template() {
	$post_type_object = get_post_type_object( 'post' );
	$post_type_object->template = array(
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
			),
		),
		array(
			'core/heading',
			array(
				'selectedLevel' => '2',
				'placeholder'   => 'Sujet de votre article',
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
				'placeholder' => 'Rédigez votre article ici',
				// 'align'       => 'center',
			),
		),
		array(
			'core/spacer',
			array(
				'height' => '64px',
			),
		),
	);
}
add_action( 'init', 'imera_register_default_template' );

/**
 * Save ACF Agenda block values
 */
function save_block_data( $post ) {
	$blocks = parse_blocks( get_post( $post )->post_content );
	foreach ( $blocks as $block ) {
		if ( 'acf/post-info' === $block['blockName'] ) {
			if ( $block['attrs']['data'] ) {
				foreach ( $block['attrs']['data'] as $key => $value ) {
					if ( ! str_starts_with( $key, '_' ) ) {
						update_field( $key, $value, $post );
					}
				}
			}
		}
	}
}
add_action( 'save_post', 'save_block_data' );

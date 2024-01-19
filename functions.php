<?php
/**
 * Function
 *
 * @package WordPress
 * @subpackage imera-theme
 */

/**
 * Load theme updater functions.
 * Action is used so that child themes can easily disable.
 */
function elabo_theme_updater() {
	require get_template_directory() . '/updater/theme-updater.php';
}
add_action( 'after_setup_theme', 'elabo_theme_updater' );

/**
 * Chargement des traductions
 */
add_action(
	'after_setup_theme',
	function () {
		load_theme_textdomain( 'imera', get_template_directory() . '/languages' );
	}
);

/**
 * ACF
 */
require_once 'inc/acf.php';


/**
 * Images sizes, thumbnail, load js, css
 */
require_once 'inc/assets.php';


/**
 * Back office
 */
require_once 'inc/back.php';


/**
 * Front office
 */
require_once 'inc/front.php';

/**
 * Gravity Forms
 */
require_once 'inc/gform.php';


/**
 * Menu
 */
require_once 'inc/menu.php';


/**
 * SEO
 */
require_once 'inc/seo.php';


/**
 * CPT
 */
require_once 'inc/cpt/documents.php';
require_once 'inc/cpt/alumni.php';
require_once 'inc/cpt/ressource.php';
require_once 'inc/cpt/candidatures.php';
require_once 'inc/cpt/agenda.php';


/**
 * Block-patterns
 */
require_once 'inc/block-patterns/banner-menu.php';


/**
 * Block overwrite
 */
require_once 'inc/block-rendering/button.php';


/**
 * Sidebars
 */
require_once 'inc/sidebar.php';


/**
 * Optimization
 */
require_once 'inc/optimization.php';


/**
 * Metaboxes
 */
require_once 'inc/metabox.php';

/**
 * Archive filters & search
 */
require_once 'inc/filters.php';

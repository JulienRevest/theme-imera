<?php
/**
 * The 404 page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage imera-theme
 * @since 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

get_header(); ?>

	<div class="page-header header-404">
		<?php elabo_breadcrumb(); ?>
		<div class="page-title has-title-style">
			<div class="title-scrolling halfwidth"><h1 data-title="<?php esc_html_e( 'Page 404', 'imera' ); ?>"><?php esc_html_e( 'Page 404', 'imera' ); ?></h1></div>
			<div class="title-section-one title-style-B">
			</div>
			<div class="title-section-two title-style-B">
				<?php echo file_get_contents( get_template_directory() . '/img/symbol.svg' ) ?>
			</div>
		</div>
	</div>

	<div class="global-page page-404">
		<p>
		<?php
		esc_html_e( "Oups, voilà qui n'était pas prévu.", 'imera' );
		echo '<br>';
		esc_html_e( 'Désolé, mais la page que vous recherchez est introuvable.', 'imera' );
		?>
		</p>

		<div class="wp-block-button align-center back-home-button">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class=""><?php esc_html_e( 'Retour à la page d’accueil', 'imera' ); ?></a>
			<span class="icon-chevron-next"></span>
		</div>

	</div>

<?php get_footer(); ?>

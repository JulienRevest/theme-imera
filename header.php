<?php
/**
 * Header template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package imera-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/img/favicon/site.webmanifest">
		<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">

		<?php
		$twitter_thumb = get_template_directory_uri() . '/img/imera-logo.svg';
		if ( is_single() || is_page() ) {
			$twitter_url    = get_permalink();
			$twitter_title  = get_the_title();
			$twitter_desc   = get_the_excerpt();
			$twitter_thumbs = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			if ( ! empty( $twitter_thumbs[0] ) ) {
				$twitter_thumb = $twitter_thumbs[0];
			}
			?>
		<meta name="twitter:card" value="summary_large_image" />
		<meta name="twitter:url" value="<?php echo $twitter_url; ?>" />
		<meta name="twitter:title" value="<?php echo $twitter_title; ?>" />
		<meta name="twitter:description" value="<?php echo $twitter_desc; ?>" />
		<meta name="twitter:image" value="<?php echo $twitter_thumb; ?>" />
			<?php
		}
			wp_head();
		?>
	</head>

	<body <?php body_class(); ?>>
		<div class="direct-menu"> 
			<a href="#header1"><?php esc_html_e( 'Aller au premier menu', 'elabo' ); ?></a> 
			<a href="#header2"><?php esc_html_e( 'Aller au second menu', 'elabo' ); ?></a> 
			<a href="#main"><?php esc_html_e( 'Aller au contenu', 'elabo' ); ?></a> 
			<a href="#search"><?php esc_html_e( 'Aller à la recherche', 'elabo' ); ?></a>
		</div>

		<header id="header" role="banner">
			<div class="global-header">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/imera-logo.svg" width="230" height="120" alt="Logo Iméra"></a>
				<div class="header-navigation">
					<div class="navigation-container">
						<nav id="header1" role="navigation" aria-label="<?php esc_html_e( 'Premier menu', 'imera' ); ?>">
							<div class="pll-dropdown">
								<?php
								$pll_vals = pll_the_languages( array( 'raw' => 1 ) );
								foreach ( $pll_vals as $lang_opt ) {
									if ( $lang_opt['current_lang'] ) {
										echo '<img src="' . esc_html( $lang_opt['flag'] ) . '" class="language-flag"/>';
									}
								}
								?>
								<?php pll_the_languages( array( 'dropdown' => 1, 'display_names_as' => 'slug' ) ); ?>
							</div>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'header1',
									'items_wrap'     => '<ul id="menu-header-secondary" class="%1$s" role="menubar">%3$s</ul>',
									'walker'         => new Elabo_Walker_Nav_Menu(),
								)
							);
							?>
							<button class="open-search"><span class="icon-search" aria-hidden="true"></span></button>
						</nav>
						<nav id="header2" role="navigation" aria-label="<?php esc_html_e( 'Second menu', 'imera' ); ?>">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'header2',
									'items_wrap'     => '<ul id="menu-header-main" class="%1$s" role="menubar">%3$s</ul>',
									'walker'         => new Elabo_Walker_Nav_Menu(),
								)
							);
							//get_search_form( true );
							?>
						</nav>
					</div>
				</div>
				<button class="open-search-mobile open-search"><span class="icon-search" aria-hidden="true"></span></button>
				<div class="menu-mobile">
					<div class="menu-close-text"><?php esc_html_e( 'Fermer', 'imera' ); ?></div>
					<div class="menu-mobile-burger"><span class="screen-reader-text"><?php esc_html_e( 'Ouvrir le menu', 'imera' ); ?></span></div>
				</div>
			</div>
			<div class="header-search">
				<div class="global-page">
					<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
						<label>
							<span class="screen-reader-text"><?php echo _x( 'Rechercher :', 'imera' ) ?></span>
							<input id="search" type="search" class="search-field" placeholder="<?php esc_html_e( 'Rechercher sur Iméra', 'imera' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Rechercher :', 'imera' ) ?>" />
						</label>
						<button type="submit" class="search-submit action-button" value=""><span class="icon-search"></span></button>
					</form>
				</div>
				<button class="close-search" aria-hidden="true"><?php esc_html_e( 'Fermer', 'imera' ); ?> <span class="icon-close"></span></button>
			</div>
			<div class="overlay close-search"></div>
		</header>

		<main id="main" role="main">

<?php
/**
 * Block-pattern Banner menu
 *
 * @package theme-imera
 */

/**
 * Remove default Gutenberg block patterns
 */
function elabo_remove_patterns() {
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'elabo_remove_patterns' );


if ( function_exists( 'register_block_pattern' ) ) {

	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category( 'template_page', array( 'label' => 'Gabarits de page' ) );
		register_block_pattern_category( 'template_block', array( 'label' => 'Gabarits de bloc' ) );
	}

	register_block_pattern(
		'block-compo/banner-menu',
		array(
			'title'         => 'Bloc menu bannière',
			'categories'    => array( 'template_block' ),
			'description'   => 'Modèle de bloc pour un menu de liens',
			'content'       => '<!-- wp:cover {"url":"https://imera.e-labo.io/wp-content/uploads/2022/10/2331c0042db7920751b5bc7289a3de6f-min.png","id":57,"dimRatio":50,"contentPosition":"top center","align":"wide","className":"banner-menu"} -->
			<div class="wp-block-cover alignwide has-custom-content-position is-position-top-center banner-menu"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background wp-image-57" alt="" src="https://imera.e-labo.io/wp-content/uploads/2022/10/2331c0042db7920751b5bc7289a3de6f-min.png" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center"} -->
			<h2 class="has-text-align-center">Résidents</h2>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">L\'Iméra a pour vocation de constituer des communautés de chercheurs et d\'artistes internationaux qui entreprennent des projets interdisciplinaires très innovants.</p>
			<!-- /wp:paragraph -->
			
			<!-- wp:separator {"backgroundColor":"light-gray"} -->
			<hr class="wp-block-separator has-text-color has-light-gray-color has-alpha-channel-opacity has-light-gray-background-color has-background"/>
			<!-- /wp:separator -->
			
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left","flexWrap":"nowrap","orientation":"horizontal"}} -->
			<div class="wp-block-buttons"><!-- wp:button {"width":100,"style":{"border":{"radius":"0px"}},"className":"is-style-outline"} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link" style="border-radius:0px">Résidents Aix-Marseille Université</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
			
			<!-- wp:separator {"backgroundColor":"light-gray"} -->
			<hr class="wp-block-separator has-text-color has-light-gray-color has-alpha-channel-opacity has-light-gray-background-color has-background"/>
			<!-- /wp:separator -->
			
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left","flexWrap":"nowrap","orientation":"horizontal"}} -->
			<div class="wp-block-buttons"><!-- wp:button {"width":100,"style":{"border":{"radius":"0px"}},"className":"is-style-outline"} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link" style="border-radius:0px">Résidents Iméra</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
			
			<!-- wp:separator {"backgroundColor":"light-gray"} -->
			<hr class="wp-block-separator has-text-color has-light-gray-color has-alpha-channel-opacity has-light-gray-background-color has-background"/>
			<!-- /wp:separator -->
			
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left","flexWrap":"nowrap","orientation":"horizontal"}} -->
			<div class="wp-block-buttons"><!-- wp:button {"width":100,"style":{"border":{"radius":"0px"}},"className":"is-style-outline"} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link" style="border-radius:0px">Senior Fellow</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
			
			<!-- wp:separator {"backgroundColor":"light-gray","className":"is-style-default"} -->
			<hr class="wp-block-separator has-text-color has-light-gray-color has-alpha-channel-opacity has-light-gray-background-color has-background is-style-default"/>
			<!-- /wp:separator -->
			
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left","flexWrap":"nowrap","orientation":"horizontal"}} -->
			<div class="wp-block-buttons"><!-- wp:button {"width":100,"style":{"border":{"radius":"0px"}},"className":"is-style-outline"} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link" style="border-radius:0px">Devenir résident</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons -->
			
			<!-- wp:separator {"backgroundColor":"light-gray"} -->
			<hr class="wp-block-separator has-text-color has-light-gray-color has-alpha-channel-opacity has-light-gray-background-color has-background"/>
			<!-- /wp:separator --></div></div>
			<!-- /wp:cover -->',
		)
	);

	register_block_pattern(
		'block-compo/card',
		array(
			'title'         => 'Bloc carte',
			'categories'    => array( 'template_block' ),
			'description'   => 'Modèle de carte',
			'content'       => '<!-- wp:group {"layout":{"type":"constrained","contentSize":"448px"}} -->
			<div class="wp-block-group"><!-- wp:cover {"url":"https://imera.e-labo.io/wp-content/uploads/2022/11/Asheim.png","id":423,"dimRatio":0,"minHeight":448,"isDark":false,"align":"wide"} -->
			<div class="wp-block-cover alignwide is-light" style="min-height:448px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-423" alt="" src="https://imera.e-labo.io/wp-content/uploads/2022/11/Asheim.png" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Rédigez le titre…","fontSize":"large"} -->
			<p class="has-text-align-center has-large-font-size"> </p>
			<!-- /wp:paragraph --></div></div>
			<!-- /wp:cover -->
			
			<!-- wp:spacer {"height":"16px"} -->
			<div style="height:16px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			
			<!-- wp:heading {"level":3} -->
			<h3>Nom de la carte</h3>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p>Paragraphe de descriptions de la carte<br>2 lignes maximum recommandé</p>
			<!-- /wp:paragraph -->
			
			<!-- wp:spacer {"height":"46px"} -->
			<div style="height:46px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer --></div>
			<!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'block-compo/list-cards',
		array(
			'title'       => 'Groupe de 3 fiches',
			'categories'  => array( 'template_block' ),
			'description' => 'Modèle de 3 fiches en colonnes avec titre principal',
			'content'     => '<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
			<div class="wp-block-group alignwide"><!-- wp:heading {"textAlign":"center"} -->
			<h2 class="wp-block-heading has-text-align-center">Titre du bloc</h2>
			<!-- /wp:heading -->
			
			<!-- wp:columns -->
			<div class="wp-block-columns"><!-- wp:column -->
			<div class="wp-block-column"><!-- wp:image {"id":2429,"sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="https://imera.e-labo.io/wp-content/uploads/2023/04/placeholder.png" alt="" class="wp-image-2429"/></figure>
			<!-- /wp:image -->
			
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><a href="#">Titre du lien</a></h3>
			<!-- /wp:heading --></div>
			<!-- /wp:column -->
			
			<!-- wp:column -->
			<div class="wp-block-column"><!-- wp:image {"id":2429,"sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="https://imera.e-labo.io/wp-content/uploads/2023/04/placeholder.png" alt="" class="wp-image-2429"/></figure>
			<!-- /wp:image -->
			
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><a href="#">Titre du lien</a></h3>
			<!-- /wp:heading --></div>
			<!-- /wp:column -->
			
			<!-- wp:column -->
			<div class="wp-block-column"><!-- wp:image {"id":2429,"sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image size-full"><img src="https://imera.e-labo.io/wp-content/uploads/2023/04/placeholder.png" alt="" class="wp-image-2429"/></figure>
			<!-- /wp:image -->
			
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><a href="#">Titre du lien</a></h3>
			<!-- /wp:heading --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns --></div>
			<!-- /wp:group -->',
		)
	);
}

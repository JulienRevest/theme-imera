<?php
/**
 * Footer template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package imera-theme
 */

?>
			<?php get_template_part( 'template-parts/modal-example' ); ?>

		</main>

		<footer id="footer" role="contentinfo">
			<div class="global-footer">
				<div class="social-networks-container">
					<div class="social-networks">
						<div class="follow-us">
							<div class="follow-us-text"><?php esc_html_e( 'Nous suivre', 'imera' ); ?></div>
							<ul class="footer-social-butons">
								<?php  /* <li class="footer-linkedin"><a href="https://twitter.com/imera_amu" target="_blank"><span class="icon-linkedin"></span></a></li> */ ?>
								<li class="footer-facebook"><a href="https://www.facebook.com/institutimera/" target="_blank"><span class="icon-facebook"></span></a></li>
								<li class="footer-twitter"><a href="https://twitter.com/imera_amu" target="_blank"><span class="icon-twitter"></span></a></li>
								<li class="footer-youtube"><a href="https://www.youtube.com/@imeraamu/featured" target="_blank"><span class="icon-youtube"></span></a></li>
							</ul>
						</div>
						<div class="register-newsletter">
							<div class="register-newsletter-text"><?php esc_html_e( "S'abonner à la newsletter", 'imera' ); ?></div>
							<a class="footer-newsletter" href="https://get.formulaire.info/form?p=3smV6GKi" target="_blank"><span class="icon-chevron-next"></span></a>
						</div>
					</div>
				</div>
				<div class="footer-nav-container">
					<div class="footer-nav">
						<div class="footer-informations">
							<div class="footer-logo"><img src="<?php echo get_template_directory_uri(); ?>/img/symbol.svg" width="50" height="64" alt="Logo Iméra"></div>
							<div class="footer-location">
								<div class="location-title">
									<?php esc_html_e( "Institut d'Études Avancées d'Aix-Marseille Université", 'imera' ); ?>
								</div>
								<address class="location-address">
									2, Place Leverrier<br>
									13004 Marseille<br>
									France<br>
								</address>
							</div>
						</div>
						<nav role="navigation" class="footer-menu3">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
								)
							);
							?>
						</nav>
					</div>
				</div>
				<div class="copyright-container">
					<div class="copyright">
					<div class="copyright-text"><?php esc_html_e( "© 2023 Institut d'Études Avancées d'Aix-Marseille Université", 'imera' ); ?></div>
					<a href="#" class="back-top"><?php esc_html_e( 'Retour en haut', 'imera' ); ?></a>
					</div>
				</div>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>

<?php
/**
 * Gravityform
 *
 * @package imera-theme
 */

/**
 * Load script in footer
 */
add_filter( 'gform_init_scripts_footer', '__return_true' );


/**
 * Add header & footer in GF email template
 *
 * @param string $template : The template for the html formatted message. Use {message} and {subject} as placeholders.
 */
function imera_skin_gf_email( $template ) {
	$url_logo   = get_bloginfo( 'template_directory' ) . '/img/logo.png';
	$color      = '#999999';
	$color_text = '#333333';
	$template   = '
		<html>
			<head>
				<style>p {padding:0;margin:15px 0}</style>
				<title>{subject}</title>
			</head>
			<body style="background: #ffffff">
				<div style="width:640px;max-width:100%;margin:0 auto;">
					<div style="padding: 40px 30px; text-align: left; border-bottom: 10px ' . $color . ' solid; font-size: 20px; font-family: Arial, sans-serif; color: ' . $color . '"><table border="0"><tr><td><a href="' . get_bloginfo( 'url' ) . '"><img src="' . $url_logo . '" alt="' . get_bloginfo( 'name' ) . '" border="0"></a></td></tr></table></div>
					<div style="margin: 30px auto; max-width: 600px; background: #ffffff; padding: 0 20px;">
						<div style="font-size: 16px; font-family: Arial, sans-serif; padding: 0 0 30px 0; color: ' . $color_text . ';">
							{message}
						</div>
					</div>
					 <div style="text-align: center; padding: 20px;font-size: 14px; font-family: Arial, sans-serif; color: #ffffff; background: ' . $color . ';">' . get_bloginfo( 'name' ) . ' <a href="' . get_bloginfo( 'url' ) . '" style="color: #ffffff;">' . get_bloginfo( 'url' ) . '</a></div>
				</div>
			</body>
		</html>';
	return $template;
}
add_filter( 'gform_html_message_template_pre_send_email', 'imera_skin_gf_email' );

/**
 * Populate form with post title
 */
function imera_populate_title() {
	return get_the_title();
}
add_filter( 'gform_field_value_form_post_title', 'imera_populate_title' );

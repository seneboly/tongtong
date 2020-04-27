<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * TGM Plugin Activation
 */

require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

if ( !function_exists('bubulla_action_theme_register_required_plugins') ) {

	function bubulla_action_theme_register_required_plugins() {

		$config = array(

			'id'           => 'bubulla',
			'menu'         => 'bubulla-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => false,
			'is_automatic' => false,
		);

		tgmpa( array(

			array(
				'name'      => esc_html__('Unyson', 'bubulla'),
				'slug'      => 'unyson',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('LT Extension', 'bubulla'),
				'slug'      => 'lt-ext',
				'source'   	=> get_template_directory() . '/inc/plugins/lt-ext.zip',
				'version'   => '2.3.0',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('WPBakery Page Builder', 'bubulla'),
				'slug'      => 'js_composer',
				'source'   	=> 'http://updates.like-themes.com/plugins/js_composer.zip',
				'required'  => true,
			),
			array(
				'name'      => esc_html__('Envato Market', 'bubulla'),
				'slug'      => 'envato-market',
				'source'   	=> get_template_directory() . '/inc/plugins/envato-market.zip',
				'required'  => false,
			),													
			array(
				'name'      => esc_html__('Breadcrumb-navxt', 'bubulla'),
				'slug'      => 'breadcrumb-navxt',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('Contact Form 7', 'bubulla'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
			array(
				'name'       => esc_html__('MailChimp for WordPress', 'bubulla'),
				'slug'       => 'mailchimp-for-wp',
				'required'   => false,
			),		
			array(
				'name'       => esc_html__('WooCommerce', 'bubulla'),
				'slug'       => 'woocommerce',
				'required'   => false,
			),
			array(
				'name'      => esc_html__('Post-views-counter', 'bubulla'),
				'slug'      => 'post-views-counter',
				'required'  => false,
			),			
			array(
				'name'      => esc_html__('User Profile Picture', 'bubulla'),
				'slug'      => 'metronet-profile-picture',
				'required'  => false,
			),
			array(
				'name'      => esc_html__('The Events Calendar', 'bubulla'),
				'slug'      => 'the-events-calendar',
				'required'  => false,
			),										
		), $config);
	}
}

add_action( 'tgmpa_register', 'bubulla_action_theme_register_required_plugins' );


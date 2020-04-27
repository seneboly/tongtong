<?php

/**
 * Theme Welcome Page
 */


var_dump(bubulla_plugin_is_active('lt-ext'));

/**
 * Add welcome page
 */
if ( !function_exists( 'bubulla_welcome_page_init' ) ) {

	function bubulla_welcome_page_init() {
			
		$theme = wp_get_theme();

		add_theme_page(
			$theme->name,
			$theme->name,
			'install_themes',
			'ltx_welcome',
			'ltx_welcome_output',
			'',
			100
		);
	}

	add_action( 'admin_menu', 'bubulla_welcome_page_init' );
}


if ( !function_exists( 'bubulla_welcome_page' ) ) {

	function bubulla_welcome_page() {

		update_option( 'bubulla_welcome_page', 1 );
	}

	add_action( 'after_switch_theme', 'bubulla_welcome_page', 100 );	
}

if ( !function_exists( 'especio_about_after_setup_theme' ) ) {

	function especio_about_after_setup_theme() {

		if ( get_option( 'bubulla_welcome_page' ) == 1 ) {

			update_option( 'bubulla_welcome_page', 0 );
			wp_safe_redirect( admin_url() . 'themes.php?page=bubulla_welcome' );

			exit();
		}
	}

	add_action( 'init', 'especio_about_after_setup_theme', 100 );
}



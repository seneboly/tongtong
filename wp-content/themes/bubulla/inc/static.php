<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Include static files
 * Some theme-specific frontend styles are also included in theme-config.php
 */

if ( is_admin() ) {

	return;
}

if ( function_exists( 'FW' ) ) {

	fw()->backend->option_type( 'icon-v2' )->packs_loader->enqueue_frontend_css();
}
	else {

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '1.0' );
}

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

	wp_enqueue_script( 'comment-reply' );
}



/**
 * Loading javascript plugins and custom bubulla js scripts
 */
wp_enqueue_script('jquery-masonry');

wp_enqueue_script('matchheight', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', array( 'jquery' ), '', true );
wp_enqueue_script('nicescroll', get_template_directory_uri() . '/assets/js/jquery.nicescroll.js', array( 'jquery' ), '3.7.6.0', true );
wp_enqueue_script('swipebox', get_template_directory_uri() . '/assets/js/jquery.swipebox.js', array( 'jquery' ), '1.4.4', true );
wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '4.1.3', true );
wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array( 'jquery' ), '4.5.0', true );
wp_enqueue_script('scrollreveal', get_template_directory_uri() . '/assets/js/scrollreveal.js', array( 'jquery' ), '3.3.4', true );
wp_enqueue_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.6.2.min.js', array( 'jquery' ), '2.6.2', false );
wp_enqueue_script('waypoint', get_template_directory_uri() . '/assets/js/waypoint.js', array( 'jquery' ), '1.6.2', true );
wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/js/parallax.min.js', array(), '1.1.3', true );

wp_enqueue_script('bubulla-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), wp_get_theme()->get('Version'), true );
wp_enqueue_script('bubulla-map-style', get_template_directory_uri() . '/assets/js/map-style.js', array( 'jquery' ), '1.0.0', true );


/**
 * Loading Pace Page Loader if enabled
 */
if ( function_exists( 'FW' ) ) {

	$bubulla_pace = fw_get_db_settings_option( 'page-loader' );
	if ( !empty($bubulla_pace) AND ((!empty($bubulla_pace['loader']) AND $bubulla_pace['loader'] != 'disabled') OR 
	( !empty($bubulla_pace) AND $bubulla_pace['loader'] != 'disabled') ) ) {

		wp_enqueue_script('pace', get_template_directory_uri() . '/assets/js/pace.js', array( 'jquery' ), '', true );
	}

}


/**
 * Customization
 */
if ( function_exists( 'FW' ) ) {

	require_once get_template_directory() . '/inc/theme-style/theme-style.php';
	wp_add_inline_style( 'bubulla-theme-style', bubulla_generate_css() );
}
	else {

	wp_enqueue_style( 'bubulla-google-fonts', bubulla_font_url(), array(), null );
}

/**
 * Loading FontAwesome 5 fonts
 */
wp_enqueue_style( 'vc_font_awesome_5' );



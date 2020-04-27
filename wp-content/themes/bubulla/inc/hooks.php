<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Filters and Actions
 */

/**
 * Enqueue Google fonts style to admin
 *
 * @internal
 */
function bubulla_action_theme_admin_fonts() {

	wp_enqueue_style( 'bubulla-theme-admin-font', bubulla_font_url(), array(), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'bubulla_action_theme_admin_fonts' );

/**
 * Theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 * @internal
 */
if ( ! function_exists( 'bubulla_theme_setup' ) ) {

	function bubulla_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'bubulla', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'assets/css/editor-style.css', bubulla_font_url() ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1150, 885, true );

		add_image_size( 'bubulla-portfolio', 460, 680, true );	
		add_image_size( 'bubulla-blog-300', 300, 195, true );	
		add_image_size( 'bubulla-blog-featured', 755, 521, true );	
		add_image_size( 'bubulla-blog-tiny', 128, 84, true );	
		add_image_size( 'bubulla-blog', 495, 380, true );	
		add_image_size( 'bubulla-wc-featured', 720, 1030, true );	
		add_image_size( 'bubulla-client', 480, 630, true );	
		add_image_size( 'bubulla-blog-full', 1120, 720, true );	
		add_image_size( 'bubulla-wc-cat', 250, 250, true );	
		add_image_size( 'bubulla-partners', 140, 140, true );	
		add_image_size( 'bubulla-tiny-square', 110, 110, true );	
		add_image_size( 'bubulla-tiny', 110, 80, true );	
		add_image_size( 'bubulla-gallery-grid', 275, 275, true );	
		add_image_size( 'bubulla-gallery-big', 800, 800 );	
		add_image_size( 'bubulla-gallery', 755, 500, true );	
		add_image_size( 'bubulla-team', 550, 550 );	

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'video',
			'audio',
			'quote',
			'link',
			'gallery',
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

	}
}
add_action( 'init', 'bubulla_theme_setup' );

/**
 * Load Gutenberg stylesheet.
 */
function bubulla_block_assets() {

	wp_enqueue_style( 'bubulla-block-assets', get_theme_file_uri( '/assets/css/block-editor-style.css' ), false );
}
add_action( 'enqueue_block_editor_assets', 'bubulla_block_assets' );


function bubulla_add_woocommerce_support() {

    add_theme_support( 'woocommerce' );

    if ( function_exists( 'fw_get_db_settings_option' ) ) $wc_zoom = fw_get_db_settings_option( 'wc_zoom' );
	if ( !empty($wc_zoom) AND $wc_zoom == 'enabled') add_theme_support( 'wc-product-gallery-zoom' );

	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );   
	add_theme_support( 'woocommerce', array( 'thumbnail_image_width' => 360 ) );	
}
add_action( 'after_setup_theme', 'bubulla_add_woocommerce_support' );
/**
 * Adjust content_width value for image attachment template.
 *
 * @internal
 */
function bubulla_action_theme_content_width() {

	if ( is_attachment() && wp_attachment_is_image() ) {
		
		$GLOBALS['content_width'] = 770;
	}
}

add_action( 'template_redirect', 'bubulla_action_theme_content_width' );

/**
 * Extend the default WordPress body classes.
 *
 * @param array $classes A list of existing body class values.
 *
 * @return array The filtered body class list.
 * @internal
 */
function bubulla_filter_theme_body_classes( $classes ) {

	global $wp_query;

	if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) {

		$current_position = fw_ext_sidebars_get_current_position();
		if ( in_array( $current_position, array( 'full', 'left' ) )
		     || empty( $current_position )
		     || is_page_template( 'page-templates/full-width.php' )
		     || is_page_template( 'page-templates/contributors.php' )
		     || is_attachment()
		) {
			$classes[] = 'full-width';
		}
	} else {
		$classes[] = 'full-width';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	$sidebar_layout = 'hidden';
	$bubulla_pace = 'disabled';
	if ( function_exists( 'FW' ) ) {

		$bubulla_pace = fw_get_db_settings_option( 'page-loader' );
		if ( !empty($bubulla_pace) AND !empty($bubulla_pace['loader'])) $bubulla_pace = $bubulla_pace['loader'];
		
		$body_color = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'body-bg' );
		if ( !empty($body_color) AND $body_color != 'default' ) $classes[] = "body-".esc_attr($body_color);

		$body_border = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'margin-layout' );
		if ( !empty($body_border) AND $body_border == 'body-border' ) $classes[] = "ltx-body-border";

		$sidebar_layout = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'sidebar-layout' );

		$bubulla_footer_cols = bubulla_get_footer_cols_num();

		$bg_404 = fw_get_db_settings_option( '404_bg' );
		if (! empty( $bg_404 ) ) {		

			$classes[] = 'ltx-bg-404';
		}

		$current_scheme = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'color-scheme' );
		if ( !empty( $current_scheme) ) {

			$classes[] = 'ltx-color-scheme-'.esc_attr($current_scheme);
		}
	}
		else {

	}

	if ( empty($bubulla_footer_cols) ) {

		$classes[] = 'no-footer-widgets';
	}

	$classes[] = 'paceloader-'.esc_attr($bubulla_pace);


	$sidebar_active = bubulla_check_active_sidebar();
	if ( $sidebar_active === true ) {

		$sidebar_layout = 'visible';
	}

	if ( empty($sidebar_layout) OR $sidebar_layout == 'hidden' OR is_page_template( 'page-templates/full-width.php' ) OR !function_exists('FW') ) {

		$classes[] = 'full-width';
		$classes[] = 'no-sidebar';
	}


	return $classes;
}

add_filter( 'body_class', 'bubulla_filter_theme_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 *
 * @return array The filtered post class list.
 * @internal
 */
function bubulla_filter_theme_post_classes( $classes ) {

	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {

		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'bubulla_filter_theme_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 *
 * @return string The filtered title.
 * @internal
 */
function bubulla_filter_theme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'bubulla' ), max( $paged, $page ) );
	}

	return $title;
}

add_filter( 'wp_title', 'bubulla_filter_theme_wp_title', 10, 2 );


/**
 * Add wp_kses allowed html tags
 */
function bubulla_kses_allowed_html($tags, $context) {
	switch($context) {

		case 'header': 
		  $tags = array( 
		    'span' => array(),
		    'em' => array(),
		    'b' => array(),
		    'p' => array(),
		    'sup' => array(),
		    'a' => array('href' => array(), 'target' => array()),
		  );
		  return $tags;
		default: 
		  return $tags;
	}
}
add_filter( 'wp_kses_allowed_html', 'bubulla_kses_allowed_html', 10, 2);

/**
 * Flush out the transients used in bubulla_categorized_blog.
 *
 * @internal
 */
function bubulla_action_theme_category_transient_flusher() {

	delete_transient( 'bubulla_category_count' );
}

add_action( 'edit_category', 'bubulla_action_theme_category_transient_flusher' );
add_action( 'save_post', 'bubulla_action_theme_category_transient_flusher' );


	function bubulla_theme_custom_framework_customizations_dir_rel_path($rel_path) {

	    return '/inc/fw';
	}
	add_filter(
	    'fw_framework_customizations_dir_rel_path', 
	    'bubulla_theme_custom_framework_customizations_dir_rel_path'
	);


/**
 * @param FW_Ext_Backups_Demo[] $demos
 * @return FW_Ext_Backups_Demo[]
 */
function bubulla_filter_theme_fw_ext_backups_demos( $demos ) {
	$demos_array = array(
		'bubulla-demo' => array(
			'title' => esc_html__( 'Bubulla Demo Content', 'bubulla' ),
			'screenshot' => 'http://updates.like-themes.com/bubulla/screenshot.png',
			'preview_link' => 'http://bubulla.like-themes.com/',
		),
	);

	$download_url = 'http://updates.like-themes.com/bubulla/';

	foreach ( $demos_array as $id => $data ) {
		$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
			'url' => $download_url,
			'file_id' => $id,
		));
		$demo->set_title( $data['title'] );
		$demo->set_screenshot( $data['screenshot'] );
		$demo->set_preview_link( $data['preview_link'] );

		$demos[ $demo->get_id() ] = $demo;

		unset( $demo );
	}

	return $demos;
}
add_filter( 'fw:ext:backups-demo:demos', 'bubulla_filter_theme_fw_ext_backups_demos' );




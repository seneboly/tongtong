<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Theme Configuration and Custom CSS initializtion
 */

/**
 * Global theme config for header/footer/sections/colors/fonts
 */
if ( !function_exists('bubulla_theme_config') ) {

	add_filter( 'ltx_get_theme_config', 'bubulla_theme_config', 10, 1 );
	function bubulla_theme_config() {

	    return array(
	    	'navbar'	=>	array(
				'white'  	=> esc_html__( 'White Background', 'bubulla' ),
				'transparent'  	=> esc_html__( 'Transparent Dark Background', 'bubulla' ),
				'desktop-center-transparent'  	=> esc_html__( 'Transparent Logo Center', 'bubulla' ),
				'full-width'  => esc_html__( 'Hamburger Full-Width ', 'bubulla' ),		
			),
			'navbar-default' => 'white',

			'footer' => array(
				'default'  => esc_html__( 'Default', 'bubulla' ),		
				'copyright'  => esc_html__( 'Copyright Only', 'bubulla' ),
				'copyright-transparent'  => esc_html__( 'Copyright Transparent', 'bubulla' ),						
			),
			'footer-default' => 'default',

			'color_main'	=>	'#9C2330',
			'color_second'	=>	'#A9976F',
			'color_black'	=>	'#191716',
			'color_gray'	=>	'#F1EEE7',
			'color_white'	=>	'#FFFFFF',
			'color_red'		=>	'#751E27',
			'color_main_header'	=>	esc_html__( 'Red', 'bubulla' ),

			'logo_height'		=>	80,
			'navbar_dark'		=>	'rgba(0,0,0,0.75)',

			'font_main'					=>	'Poppins',
			'font_main_var'				=>	'regular',
			'font_main_weights'			=>	'200,400,400i,700',
			'font_headers'				=>	'Barlow',
			'font_headers_var'			=>	'regular',
			'font_headers_weights'		=>	'700,700i',
			'font_subheaders'			=>	'Sacramento',
			'font_subheaders_var'		=>	'regular',
			'font_subheaders_weights'	=>	'',
		);
	}
}

/**
 *  Editor Settings
 */
function bubulla_editor_settings() {

	$cfg = bubulla_theme_config();

    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'Main', 'bubulla' ),
            'slug' => 'main-theme',
            'color' => $cfg['color_main'],
        ),
        array(
            'name' => esc_html__( 'Gray', 'bubulla' ),
            'slug' => 'gray',
            'color' => $cfg['color_gray'],
        ),
        array(
            'name' => esc_html__( 'Black', 'bubulla' ),
            'slug' => 'black',
            'color' => $cfg['color_black'],
        ),
        array(
            'name' => esc_html__( 'Red', 'bubulla' ),
            'slug' => 'red',
            'color' => $cfg['color_red'],
        ),        
    ) );

	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => esc_html__( 'small', 'bubulla' ),
			'shortName' => esc_html__( 'S', 'bubulla' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => esc_html__( 'regular', 'bubulla' ),
			'shortName' => esc_html__( 'M', 'bubulla' ),
			'size'      => 16,
			'slug'      => 'regular'
		),
		array(
			'name'      => esc_html__( 'large', 'bubulla' ),
			'shortName' => esc_html__( 'L', 'bubulla' ),
			'size'      => 24,
			'slug'      => 'large'
		),
	) );    
}
add_action( 'after_setup_theme', 'bubulla_editor_settings', 10 );

/**
 * Get Google default font url
 */
if ( !function_exists('bubulla_font_url') ) {

	function bubulla_font_url() {

		$cfg = bubulla_theme_config();
		$q = array();
		foreach ( array('font_main', 'font_headers', 'font_subheaders') as $item ) {

			if ( !empty($cfg[$item]) ) {

				$w = '';
				if ( !empty($cfg[$item.'_weights']) ) {

					$w .= ':'.$cfg[$item.'_weights'];
				}
				$q[] = $cfg[$item].$w;
			}
		}

		$query_args = array( 'family' => implode('%7C', $q), 'subset' => 'latin' );

		$font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		return esc_url( $font_url );
	}
}

/**
 * Config used for lt-ext plugin to set Visual Composer configuration
 */
if ( !function_exists('bubulla_vc_config') ) {

	add_filter( 'ltx_get_vc_config', 'bubulla_vc_config', 10, 1 );
	function bubulla_vc_config( $value ) {

	    return array(
	    	'sections'	=>	array(
				esc_html__("Overflow visible section", 'bubulla') 	=> "displaced-top",				
				esc_html__("Background move on hover", 'bubulla') 	=> "ltx-mouse-move",				
				esc_html__("Banners grid", 'bubulla') 	=> "ltx-banners-grid",				


			),
			'background' => array(
				esc_html__( "Main", 'bubulla' ) => "theme_color",	
				esc_html__( "Second", 'bubulla' ) => "second",	
				esc_html__( "Gray", 'bubulla' ) => "gray",
				esc_html__( "White", 'bubulla' ) => "white",
				esc_html__( "Black", 'bubulla' ) => "black",			
				esc_html__( "True Black", 'bubulla' ) => "true-black",			
			),
			'overlay'	=> array(
				esc_html__( "Black Overlay (50%)", 'bubulla' ) => "black",
				esc_html__( "Dark Overlay (40%)", 'bubulla' ) => "dark",
				esc_html__( "Light Overlay (20%)", 'bubulla' ) => "white",
				esc_html__( "White Overlay (50%)", 'bubulla' ) => "gray",
				esc_html__( "Radial Gradient", 'bubulla' ) => "gradient",
			),
		);
	}
}


/*
* Adding additional TinyMCE options
*/
if ( !function_exists('bubulla_mce_before_init_insert_formats') ) {

	add_filter('mce_buttons_2', 'bubulla_wpb_mce_buttons_2');
	function bubulla_wpb_mce_buttons_2( $buttons ) {

	    array_unshift($buttons, 'styleselect');
	    return $buttons;
	}

	add_filter( 'tiny_mce_before_init', 'bubulla_mce_before_init_insert_formats' );
	function bubulla_mce_before_init_insert_formats( $init_array ) {  

	    $style_formats = array(

	        array(  
	            'title' => esc_html__('Main Color', 'bubulla'),
	            'block' => 'span',  
	            'classes' => 'color-main',
	            //'wrapper' => true,
	        ),  
	        array(  
	            'title' => esc_html__('White Color', 'bubulla'),
	            'block' => 'span',  
	            'classes' => 'color-white',
	            'wrapper' => true,   
	        ),
	        array(  
	            'title' => esc_html__('Medium Text', 'bubulla'),
	            'block' => 'span',  
	            'classes' => 'text-md',
	            'wrapper' => true,
	        ),    	        
	        array(  
	            'title' => esc_html__('Large Text', 'bubulla'),
	            'block' => 'span',  
	            'classes' => 'text-lg',
	            'wrapper' => true,
	        ),    
	        array(  
	            'title' => 'List Checkbox',
	            'selector' => 'ul',
	            'classes' => 'check',
	        ),     
	        array(  
	            'title' => 'List Checkbox Inverted',
	            'selector' => 'ul',
	            'classes' => 'check-invert',
	        ),     	        
	        array(  
	            'title' => 'List Bullets',
	            'selector' => 'ul',
	            'classes' => 'disc',
	        ),     	        
	        array(  
	            'title' => 'Multi-Column List',
	            'selector' => 'ul',
	            'classes' => 'multicol',
	        ),	          
	    );  
	    $init_array['style_formats'] = json_encode( $style_formats );  
	     
	    return $init_array;  
	} 
}


/**
 * Register widget areas.
 *
 */
if ( !function_exists('bubulla_action_theme_widgets_init') ) {

	add_action( 'widgets_init', 'bubulla_action_theme_widgets_init' );
	function bubulla_action_theme_widgets_init() {

		$span_class = 'widget-icon';

		$header_class = $theme_icon = '';
		if ( function_exists('FW') ) {

			if ( !empty($theme_icon['icon-class']) ) $header_class = 'hasIcon';
		}


		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Default', 'bubulla' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'bubulla' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="ltx-sidebar-header"><h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar WooCommerce', 'bubulla' ),
			'id'            => 'sidebar-wc',
			'description'   => esc_html__( 'Displayed in the right/left section of the site.', 'bubulla' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="ltx-sidebar-header"><h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'bubulla' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'bubulla' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'bubulla' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'bubulla' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'bubulla' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'bubulla' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );			

		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'bubulla' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Displayed in the footer section of the site.', 'bubulla' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="header-widget '.esc_attr($header_class).'"><span class="'.esc_attr($span_class).'"></span>',
			'after_title'   => '<span class="last '.esc_attr($span_class).'"></span></h3>',
		) );			

	}
}



/**
 * Additional styles init
 */
if ( !function_exists('bubulla_css_style') ) {

	add_action( 'wp_enqueue_scripts', 'bubulla_css_style', 10 );
	function bubulla_css_style() {

		global $wp_query;

		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap-grid.css', array(), '1.0' );

		wp_enqueue_style( 'bubulla-plugins', get_template_directory_uri() . '/assets/css/plugins.css', array(), wp_get_theme()->get('Version') );

		wp_enqueue_style( 'bubulla-theme-style', get_stylesheet_uri(), array( 'bootstrap', 'bubulla-plugins' ), wp_get_theme()->get('Version') );
	}
}


/**
 * Wp-admin styles and scripts
 */
if ( !function_exists('bubulla_admin_init') ) {

	add_action( 'after_setup_theme', 'bubulla_admin_init' );
	function bubulla_admin_init() {

		add_action("admin_enqueue_scripts", 'bubulla_admin_scripts');
	}

	function bubulla_admin_scripts() {

		if ( function_exists('fw_get_db_settings_option') ) {

			$fontello['css'] = fw_get_db_settings_option( 'fontello-css' );
			$fontello['eot'] = fw_get_db_settings_option( 'fontello-eot' );
			$fontello['ttf'] = fw_get_db_settings_option( 'fontello-ttf' );
			$fontello['woff'] = fw_get_db_settings_option( 'fontello-woff' );
			$fontello['woff2'] = fw_get_db_settings_option( 'fontello-woff2' );
			$fontello['svg'] = fw_get_db_settings_option( 'fontello-svg' );

			if ( !empty($fontello['css']) AND !empty( $fontello['eot']) AND  !empty( $fontello['ttf']) AND  !empty( $fontello['woff']) AND  !empty( $fontello['woff2']) AND  !empty( $fontello['svg']) ) {

				wp_enqueue_style(  'bubulla-fontello',  $fontello['css']['url'], array(), wp_get_theme()->get('Version') );

				$randomver = wp_get_theme()->get('Version');
				$css_content = "@font-face {
				font-family: 'bubulla-fontello';
				  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."');
				  src: url('". esc_url ( $fontello['eot']['url']. "?" . $randomver )."#iefix') format('embedded-opentype'),
				       url('". esc_url ( $fontello['woff2']['url']. "?" . $randomver )."') format('woff2'),
				       url('". esc_url ( $fontello['woff']['url']. "?" . $randomver )."') format('woff'),
				       url('". esc_url ( $fontello['ttf']['url']. "?" . $randomver )."') format('truetype'),
				       url('". esc_url ( $fontello['svg']['url']. "?" . $randomver )."#" . pathinfo(wp_basename( $fontello['svg']['url'] ), PATHINFO_FILENAME)  . "') format('svg');
				  font-weight: normal;
				  font-style: normal;
				}";

				wp_add_inline_style( 'bubulla-fontello', $css_content );
			}

			wp_enqueue_script( 'bubulla-theme-admin', get_template_directory_uri() . '/assets/js/scripts-admin.js', array( 'jquery' ) );
		}
	}
}




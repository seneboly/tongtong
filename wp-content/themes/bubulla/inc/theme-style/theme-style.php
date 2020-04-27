<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Generating inline css styles for customization
 */

if ( !function_exists('bubulla_generate_css') ) {

	function bubulla_generate_css() {

		global $wp_query;

		include get_template_directory() . '/inc/theme-style/google-fonts.php';		

		// List of attributes
		$css = array(
			'main_color' 			=> true,
			'second_color' 			=> true,			
			'second_lighter_color' 	=> true,			
			'gray_color' 			=> true,
			'white_color' 			=> true,
			'black_color' 			=> true,			
			'red_color' 			=> true,			
			'footer_color' 			=> true,			

			'nav_bg' 				=> true,
			'nav_opacity_top' 		=> true,
			'nav_opacity_scroll'	=> true,

			'border_radius' 		=> true,
		);

		// Escaping all the attributes
		$css_rgb = array();
		foreach ($css as $key => $item) {

			$css[$key] = esc_attr(fw_get_db_customizer_option($key));
			$css_rgb[$key] = sscanf(esc_attr(fw_get_db_customizer_option($key)), "#%02x%02x%02x");
		}

		// Setting different color scheme for page
		if ( function_exists( 'FW' ) ) {

			$bubulla_color_schemes = array();
			$bubulla_color_schemes_ = fw_get_db_settings_option( 'items' );

			if ( !empty($bubulla_color_schemes_) ) {
				foreach ($bubulla_color_schemes_ as $v) {

					$bubulla_color_schemes[$v['slug']] = $v;
				}			
			}
		}

		$bubulla_current_scheme =  apply_filters('bubulla_current_scheme', array());	
		if ($bubulla_current_scheme == 'default' OR empty($bubulla_current_scheme)) $bubulla_current_scheme = 1;

		if ( function_exists( 'FW' ) AND !empty($bubulla_current_scheme) ) {

			foreach (array(
					'main_color' => 'main-color',
					'second_color' => 'second-color',
					'gray_color' => 'gray-color',
					'black_color' => 'black-color') as $k => $v) {

				if ( !empty($bubulla_color_schemes[$bubulla_current_scheme][$v]) ) {

					$css[$k] = esc_attr($bubulla_color_schemes[$bubulla_current_scheme][$v]);
					$css_rgb[$k] = sscanf(esc_attr($bubulla_color_schemes[$bubulla_current_scheme][$v]), "#%02x%02x%02x");
				}
			}
		}


		$css['black_darker_color'] = bubulla_adjustBrightness($css['black_color'], -50);
		$css['main_darker_color'] = bubulla_adjustBrightness($css['main_color'], -30);
		$css['main_lighter_color'] = bubulla_adjustBrightness($css['main_color'], 30);

		$css = bubulla_get_google_fonts($css);		

		$theme_style = "";

		$theme_style .= "
			:root {
			  --black:  {$css['black_color']};
			  --black-darker:  {$css['black_darker_color']};
			  --black-text:  rgba({$css_rgb['black_color'][0]},{$css_rgb['black_color'][1]},{$css_rgb['black_color'][2]},1);
			  --black-light:  rgba({$css_rgb['black_color'][0]},{$css_rgb['black_color'][1]},{$css_rgb['black_color'][2]},.7);
			  --gray:   {$css['gray_color']};
			  --gray-lighter:   rgba({$css_rgb['gray_color'][0]},{$css_rgb['gray_color'][1]},{$css_rgb['gray_color'][2]},.5);
			  --white:  {$css['white_color']};
			  --white-text:  rgba({$css_rgb['white_color'][0]},{$css_rgb['white_color'][1]},{$css_rgb['white_color'][2]},.75);
			  --main:   {$css['main_color']};
			  --main-darker: {$css['main_darker_color']};
			  --main-lighter:  rgba({$css_rgb['main_color'][0]},{$css_rgb['main_color'][1]},{$css_rgb['main_color'][2]},.5);
			  --second:   {$css['second_color']};
			  --red:   {$css['red_color']};";

			  foreach ( array('font_main', 'font_headers', 'font_subheaders') as $font ) {

			  	if ( !empty($css[$font]) ) {

			  		$theme_style .= "--".str_replace('_', '-', $font).": '{$css[$font]}';";
			  	}
			  }

		$theme_style .= "			  
			}		
		";


		/**
		 * Theme Specific inline styles
		 */
		if ( function_exists( 'FW' ) ) {

			$heading_bg = fw_get_db_settings_option( 'heading_bg' );
			if (! empty( $heading_bg ) ) {

				$theme_style .= '.heading.bg-image { background-image: url(' . esc_url( $heading_bg['url'] ) . ') !important; } ';
			}

			$header_bg = fw_get_db_settings_option( 'header_bg' );
			$header_icon = fw_get_db_settings_option( 'header_icon' );
			$wc_bg = fw_get_db_settings_option( 'wc_bg' );
			$wc_icon = fw_get_db_settings_option( 'wc_icon' );


			$featured_bg = fw_get_db_settings_option( 'featured_bg' );
			if (! empty( $header_bg ) OR $featured_bg == 'enabled'  ) {

				if ( bubulla_is_wc('product_category') OR bubulla_is_wc('product_tag') ) {

					$cat = $wp_query->get_queried_object();
					$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id , 'full' );
					$theme_style .= '.page-header { background-image: url(' . esc_url( $image ) . ') !important; } ';
				}
					else
				if ( has_post_thumbnail() && $featured_bg == 'enabled') {

					$theme_style .= '.page-header { background-image: url(' . esc_url( get_the_post_thumbnail_url( $wp_query->get_queried_object_id(), 'full') ) . ') !important; } ';
				}
					else
				if ( !empty( $wc_bg['url'] ) AND bubulla_is_wc('shop') ) {

					$theme_style .= '.page-header { background-image: url(' . esc_url( $wc_bg['url'] ) . ') !important; } ';
				}
					else
				if ( !empty( $header_bg['url'] ) ) {

					$theme_style .= '.page-header { background-image: url(' . esc_url( $header_bg['url'] ) . ') !important; } ';
				}

				if ( !empty( $wc_icon['url'] ) AND bubulla_is_wc('shop') ) {

					$theme_style .= '.page-header .ltx-header-icon { background-image: url(' . esc_url( $wc_icon['url'] ) . ') !important; } ';
				}
					else
				if ( !empty( $header_icon['url'] ) ) {

					$theme_style .= '.page-header .ltx-header-icon { background-image: url(' . esc_url( $header_icon['url'] ) . ') !important; } ';
				}				
			}

			$header_overlay_mode = fw_get_db_settings_option( 'pageheader-overlay' );
			if ( $header_overlay_mode == 'disabled' ) {

				$theme_style .= '.header-wrapper::before { display: none; } ';
			}

			$header_overlay = fw_get_db_settings_option( 'header_overlay' );
			if (! empty( $header_overlay ) ) {

				$theme_style .= '.header-wrapper::after { background-image: url(' . esc_url( $header_overlay['url'] ) . ') !important; } ';
			}


			$bg_404 = fw_get_db_settings_option( '404_bg' );
			if (! empty( $bg_404 ) ) {

				$theme_style .= '.error404 { background-image: url(' . esc_url( $bg_404['url'] ) . ') !important; } ';
			}

			$body_bg = fw_get_db_post_option( $wp_query->get_queried_object_id(), 'background-image' );
			if (! empty( $body_bg ) ) {

				$theme_style .= '.ltx-content-wrapper { background-image: url(' . esc_url( $body_bg['url'] ) . ') !important; background-color: transparent !important; } ';
			}

			$footer_bg = fw_get_db_settings_option( 'footer_bg' );
			if (! empty( $footer_bg ) ) {

				$theme_style .= '.ltx-footer-wrapper { background-image: url(' . esc_url( $footer_bg['url'] ) . ') !important; } ';
			}

			$widgets_bg = fw_get_db_settings_option( 'widgets_bg' );
			if (! empty( $widgets_bg ) ) {

				$theme_style .= '#content-sidebar .widget_search { background-image: url(' . esc_url( $widgets_bg['url'] ) . ') !important; } ';
			}
			

			$go_top_img = fw_get_db_settings_option( 'go_top_img' );
			if (! empty( $go_top_img ) ) {

				$theme_style .= '.go-top:before { background-image: url(' . esc_url( $go_top_img['url'] ) . ') !important; } ';
			}

			$nav_color = fw_get_db_customizer_option('navbar_dark_color');
			if ( isset($nav_color) ) {

				$theme_style .= '#nav-wrapper.navbar-layout-transparent nav.navbar.dark { background-color: '.esc_attr($nav_color).' !important; } ';
			}

			$logo_height = fw_get_db_settings_option('logo_height');
			if ( !empty($logo_height) ) {

				$theme_style .= 'nav.navbar .logo img { max-height: '.esc_attr($logo_height).'px !important; } ';
			}

			$pace = fw_get_db_settings_option( 'page-loader' );
			if ( !empty($pace) AND !empty($pace['image']) AND !empty($pace['image']['loader_img'])) {

				wp_add_inline_style( 'bubulla-theme-style', '.paceloader-image .pace-image { background-image: url(' . esc_attr( $pace['image']['loader_img']['url'] ) . ') !important; } ' );
			}

			$inline_style = bubulla_get_inline_style();
			if ( !empty($inline_style) ) {

				wp_add_inline_style( 'bubulla-theme-style', $inline_style );
			}
			
			$fontello['css'] = fw_get_db_settings_option( 'fontello-css' );
			$fontello['eot'] = fw_get_db_settings_option( 'fontello-eot' );
			$fontello['ttf'] = fw_get_db_settings_option( 'fontello-ttf' );
			$fontello['woff'] = fw_get_db_settings_option( 'fontello-woff' );
			$fontello['woff2'] = fw_get_db_settings_option( 'fontello-woff2' );
			$fontello['svg'] = fw_get_db_settings_option( 'fontello-svg' );

			if ( !empty($fontello['css']) AND !empty( $fontello['eot']) AND  !empty( $fontello['ttf']) AND  !empty( $fontello['woff']) AND  !empty( $fontello['woff2']) AND  !empty( $fontello['svg']) ) {

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

				wp_add_inline_style( 'bubulla-theme-style', $css_content );
				wp_enqueue_style(  'bubulla-fontello',  $fontello['css']['url'], array(), wp_get_theme()->get('Version') );
			}
		}

		$theme_style = str_replace( array( "\n", "\r" ), '', $theme_style );

		return $theme_style;
	}
}

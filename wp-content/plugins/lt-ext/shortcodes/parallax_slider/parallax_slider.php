<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode Header
 */

// Shortcode fields configuration
if ( !function_exists( 'ltx_vc_parallax_slider_params' ) ) {

	function ltx_vc_parallax_slider_params() {

		$fields = array(
			array(
				"param_name" => "image",
				"heading" => esc_html__("Main Image", 'lt-ext'),
				"type" => "attach_image"
			),
			array(
				"param_name" => "image_left",
				"heading" => esc_html__("Left Icons", 'lt-ext'),
				"type" => "attach_image"
			),
			array(
				"param_name" => "image_right",
				"heading" => esc_html__("Right Icons", 'lt-ext'),
				"type" => "attach_image"
			),
			array(
				'param_name' => 'header1',
				'heading' => esc_html__( 'Header 1', 'lt-ext' ),
				'type' => 'textarea',
			),	
			array(
				'param_name' => 'header2',
				'heading' => esc_html__( 'Header 2', 'lt-ext' ),
				'type' => 'textarea',

			),	
		);

		return $fields;
	}
}

// Add Wp Shortcode
if ( !function_exists( 'like_sc_parallax_slider' ) ) {

	function like_sc_parallax_slider($atts, $content = null) {	

		$atts = like_sc_atts_parse('like_sc_parallax_slider', $atts, array_merge( array(

			'image'		=> '',
			'image_left'		=> '',
			'image_right'		=> '',
			'header1'		=> '',
			'header2'		=> '',

			), array_fill_keys(array_keys(ltx_vc_default_params()), null) )
		);

		wp_enqueue_script( 'parallax-scroll', ltxGetPluginUrl('/shortcodes/parallax_slider/parallax-scroll.min.js'), array('jquery'), '1.0', true );

		return like_sc_output('parallax_slider', $atts, $content);
	}

	if (ltx_vc_inited()) add_shortcode("like_sc_parallax_slider", "like_sc_parallax_slider");
}


// Adding shortcode to VC
if (!function_exists('ltx_vc_parallax_slider_add')) {

	function ltx_vc_parallax_slider_add() {
		
		vc_map( array(
			"base" => "like_sc_parallax_slider",
			"name" 	=> esc_html__("Parallax Slider", 'lt-ext'),
//			"description" => esc_html__("Background changing with Ken Burns effect", 'lt-ext'),
			"class" => "like_sc_parallax_slider",
//			"icon"	=>	ltxGetPluginUrl('/shortcodes/parallax_slider/parallax_slider.png'),
			//"is_container" => true,
			//"js_view" => 'VcColumnView',
			"category" => esc_html__('LTX-Themes', 'lt-ext'),
			//'content_element' => true,
			"params" => array_merge(
				ltx_vc_parallax_slider_params(),
				ltx_vc_default_params()
			),
		) );
/*
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		    class WPBakeryShortCode_like_sc_parallax_slider extends WPBakeryShortCodesContainer {
		    }
		}
*/		
	}

	if (ltx_vc_inited()) add_action('vc_before_init', 'ltx_vc_parallax_slider_add', 30);
}



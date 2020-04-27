<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Shortcode
 */

$args = get_query_var('like_sc_video_popup');

if ( !empty($atts['header_type']) ) $tag = 'h'.$atts['header_type']; else $tag = 'h4';

$class = '';
if ( !empty($atts['class']) ) $class .= ' '. esc_attr($atts['class']);
if ( !empty($atts['id']) ) $id = ' id="'. esc_attr($atts['id']). '"'; else $id = '';

$class .= ' style-'.$atts['style'];

$image = ltx_get_attachment_img_url( $atts['image'] );
$image2 = ltx_get_attachment_img_url( $atts['image2'] );
$atts['header'] = str_replace(array('{{', '}}'), array('<span>', '</span>'), $atts['header']);

echo '<a href="'.esc_url($atts['href']).'" class="swipebox ltx-video-popup ' . esc_attr( $class ) .'" '.$id.'>';

	echo '<span class="image">
			<span class="ltx-video-bg-2 ltx-sr-id-'.$atts['id'].mt_rand().' ltx-sr ltx-sr-effect-slide_from_right ltx-sr-el-block ltx-sr-delay-0 ltx-sr-duration-1000 ltx-sr-sequences-50 " style="background-image: url(' . esc_url($image2[0]) . ');"></span>';

			if ( !empty($image[0]) ) {

				echo '<img src="' . esc_url($image[0]) . '" class="image" alt="'.esc_attr($atts['header']).'">';
			}
			echo '<span class="ltx-play-wrap"></span>';

			if ( !empty($atts['header']) AND $atts['style'] != 'bg' ) {

				$icon = '';
				if ( !empty($atts['icon_fontawesome']) ) {

					$icon = '<span class="'.esc_attr($atts['icon_fontawesome']).'"></span>';
				}

				echo '<span class="ltx-video-header">'.$icon.esc_html($atts['header']).'</span>';

			}

	echo '</span>';
		
echo '</a>';



<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Zoom Slider Shortcode
 */

$args = get_query_var('like_sc_parallax_slider');

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$image = ltx_get_attachment_img_url($atts['image']);
$image_left = ltx_get_attachment_img_url($atts['image_left']);
$image_right = ltx_get_attachment_img_url($atts['image_right']);
$header1 = $atts['header1'];
$header2 = $atts['header2'];


?>
<div class="ltx-home-slider">
	<?php

		if ( function_exists('ltx_nav_social_shortcode') ) {

			ltx_nav_social_shortcode( array() );
		}

	?>	
	<div class="ltx-slider-inner"><?php echo do_shortcode( $content ); ?></div>
	<div class="ltx-parallax-slider">
		
		<div data-depth="0.6" class="ltx-layer header-bg">
			<?php if ( !empty($header1) ): ?><h2><?php echo esc_html( $header1 ); ?></h2><?php endif; ?>
			<?php if ( !empty($header2) ): ?><h2><?php echo esc_html( $header2 ); ?></h2><?php endif; ?>
		</div>
		
		<?php if ( !empty($image) ): ?>
		<div data-depth="0.3" class="ltx-layer ltx-floating-image">
			<img class="" alt="bg" src="<?php echo esc_url($image[0]); ?>" >
		</div>		
		<?php endif; ?>
		<?php if ( !empty($image_left) ): ?>
		<div data-depth="0.5" class="ltx-layer ltx-floating-image-left">
			<img class="" alt="bg" src="<?php echo esc_url($image_left[0]); ?>" >
		</div>		
		<?php endif; ?>
		<?php if ( !empty($image_right) ): ?>
		<div data-depth="0.4" class="ltx-layer ltx-floating-image-right">
			<img class="" alt="bg" src="<?php echo esc_url($image_right[0]); ?>" >
		</div>		
		<?php endif; ?>				
	</div>	
</div>
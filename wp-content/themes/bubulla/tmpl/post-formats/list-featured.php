<?php
/**
 * The default template for displaying standard post format
 */

$post_class = '';
$featured = get_query_var( 'bubulla_featured_disabled' );
if ( function_exists( 'FW' ) AND empty ( $featured ) ) {

	$post_class = 'ltx-featured-post';
}

if ( function_exists( 'FW' ) ) {

	$gallery_files = fw_get_db_post_option(get_The_ID(), 'gallery');
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>
	<?php 
	
		if ( !empty( $gallery_files ) ) {

			$atts['swiper_arrows'] = 'sides-tiny';
			$atts['swiper_autoplay'] = fw_get_db_settings_option( 'blog_gallery_autoplay' );
		
			echo ltx_vc_swiper_get_the_container('ltx-post-gallery', $atts, '', ' id="ltx-slide-'.get_the_ID().'" ');
			echo '<div class="swiper-wrapper">';

			foreach ( $gallery_files as $item ) {

				echo '<a href="'.esc_url(get_the_permalink()).'" class="swiper-slide">';
					echo wp_get_attachment_image( $item['attachment_id'], 'bubulla-blog-full' );
				echo '</a>';
			}

			echo '</div>
			</div>
			</div>';
		}
			else
		if ( has_post_thumbnail() ) {

			$bubulla_photo_class = 'ltx-photo';
        	$bubulla_layout = get_query_var( 'bubulla_layout' );

			$bubulla_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_The_ID()), 'bubulla-blog-featured' );

			if ($bubulla_image_src[2] > $bubulla_image_src[1]) $bubulla_photo_class .= ' vertical';
			
		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($bubulla_photo_class).'">';

		    	if ( empty($bubulla_layout) OR $bubulla_layout == 'classic'  ) {

		    		the_post_thumbnail('bubulla-blog-featured');
		    	}
		    		else
		    	if ( $bubulla_layout == 'two-cols'  ) {	    	

		    		the_post_thumbnail();
		    	}
		    		else {


					$sizes_hooks = array( 'bubulla-blog', 'bubulla-blog-featured' );
					$sizes_media = array( '1199px' => 'bubulla-blog' );

					bubulla_the_img_srcset( get_post_thumbnail_id(), $sizes_hooks, $sizes_media );
	    		}

	    		echo '<div class="ltx-description-featured">';
		    		echo '<span class="ltx-date"><span class="ltx-date-day">'.get_the_date('d').'</span> <span class="ltx-date-my">'.get_the_date('M').', '.get_the_date('y').'</span></span>';

		    		echo '<h3>'.get_the_title().'</h3>';
		    	echo '</div>';

		    echo '</a>';
		}
	?>
</article>
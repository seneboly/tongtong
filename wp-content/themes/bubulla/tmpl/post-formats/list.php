<?php
/**
 * The default template for displaying standard post format
 */

$post_class = '';
$featured = get_query_var( 'bubulla_featured_disabled' );
if ( function_exists( 'FW' ) AND empty ( $featured ) ) {

	$featured_post = fw_get_db_post_option(get_The_ID(), 'featured');
	if ( !empty($featured_post) ) {

		$post_class = 'ltx-featured-post-none';
	}
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

			$bubulla_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_The_ID()), 'full' );

			if ($bubulla_image_src[2] > $bubulla_image_src[1]) $bubulla_photo_class .= ' vertical';
			
		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($bubulla_photo_class).'">';

		    	if ( empty($bubulla_layout) OR $bubulla_layout == 'classic'  ) {

		    		the_post_thumbnail();
		    	}
		    		else
		    	if ( $bubulla_layout == 'two-cols'  ) {	    	

		    		the_post_thumbnail();
		    	}
		    		else {


					$sizes_hooks = array( 'bubulla-blog', 'bubulla-blog-full' );
					$sizes_media = array( '1199px' => 'bubulla-blog' );

					bubulla_the_img_srcset( get_post_thumbnail_id(), $sizes_hooks, $sizes_media );
	    		}

	    		echo '<span class="ltx-date-big"><span class="ltx-date-day">'.get_the_date('d').'</span><span class="ltx-date-my">'.get_the_date('M').', '.get_the_date('y').'</span></span>';

		    echo '</a>';
		}
	?>
    <div class="ltx-description">
    	<?php

    		if ( !has_post_thumbnail() ) {
    			
    			echo '<a href="'.esc_url(get_the_permalink()).'" class="ltx-date-small">'.get_the_date().'</a>';
    		}

    		bubulla_get_the_cats_archive();
    		
    	?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="ltx-header"><h3><?php the_title(); ?></h3></a>
        <?php
        	$display_excerpt = 'visible';
        ?>
        <div class="ltx-excerpt">
			<?php
				if ( !empty( $display_excerpt ) AND $display_excerpt == 'visible' ) {

					set_query_var( 'bubulla_excerpt_activity', 'enable' );
					add_filter( 'the_content', 'bubulla_excerpt' );

				    if( strpos( $post->post_content, '<!--more-->' ) ) {

				        the_content( esc_html__( 'Read more', 'bubulla' ) );
				    }
				    	else  {

				    	the_excerpt();			    	
				    }	

				    set_query_var( 'bubulla_excerpt_activity', 'disable' );
				}
			?>
        </div>   
        <?php 

			bubulla_get_the_post_headline();

        ?>
    </div>    
</article>
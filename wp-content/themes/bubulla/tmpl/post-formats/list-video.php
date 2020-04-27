<?php
/**
 * Video Post Format
 */

$post_class = '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( esc_attr($post_class) ); ?>>	
	<?php
	if ( has_post_thumbnail() ) {

		$bubulla_photo_class = 'ltx-photo swipebox';

		echo '<div class="ltx-wrapper">';
		    echo '<a href="'.esc_url(bubulla_find_http(get_the_content())).'" class="'.esc_attr($bubulla_photo_class).'">';

			    the_post_thumbnail();
			    echo '<span class="ltx-icon-video"></span>';

				echo '<span class="ltx-date-big"><span class="ltx-date-day">'.get_the_date('d').'</span><span class="ltx-date-my">'.get_the_date('M').', '.get_the_date('y').'</span></span>';

		    echo '</a>';
		echo '</div>';
	}
		else {

		if ( !empty(wp_oembed_get(bubulla_find_http(get_the_content()))) ) {

			echo '<div class="ltx-wrapper">';
				echo wp_oembed_get(bubulla_find_http(get_the_content()));	
			echo '</div>';
		}
	}

	$headline = 'date';
	?>
    <div class="ltx-description">
    	<?php

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
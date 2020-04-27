<?php
/**
 * The default template for displaying inline posts
 */

?>
<article id="post-<?php the_ID(); ?>">
	<?php 
		if ( has_post_thumbnail() ) {

			$bubulla_photo_class = 'photo';
        	$bubulla_layout = get_query_var( 'bubulla_layout' );

			$bubulla_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_The_ID()), 'full' );

			if ($bubulla_image_src[2] > $bubulla_image_src[1]) $bubulla_photo_class .= ' vertical';
			
		    echo '<a href="'.esc_url(get_the_permalink()).'" class="'.esc_attr($bubulla_photo_class).'">';

	    		the_post_thumbnail();

		    echo '</a>';
		}
	?>
    <div class="description">
   		<?php

   			bubulla_get_the_cats_archive();
   			
   		?>
        <a href="<?php esc_url( the_permalink() ); ?>" class="header"><h3><?php the_title(); ?></h3></a>
        <?php if ( !has_post_thumbnail() ): ?>
        <div class="text text-page">
			<?php
				set_query_var( 'bubulla_excerpt_activity', 'enable' );
				add_filter( 'the_content', 'bubulla_excerpt' );
			    if( strpos( $post->post_content, '<!--more-->' ) ) {

			        the_content( esc_html__( 'Read more', 'bubulla' ) );
			    }
			    	else  {

			    	the_excerpt();
			    }	

			    set_query_var( 'bubulla_excerpt_activity', 'disable' );

			?>
        </div>            
    	<?php endif; ?>
    	<div class="blog-info">
    	<?php
			bubulla_the_post_info();
    	?>
    	</div>
    </div>  
</article>
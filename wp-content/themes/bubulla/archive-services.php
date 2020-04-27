<?php
/**
 * The Services template file
 *
 */

$bubulla_layout = '';
$bubulla_sidebar_hidden = false;
$bubulla_sidebar = 'right';
$wrap_class = 'col-lg-8 col-md-8 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$bubulla_layout = fw_get_db_settings_option( 'services_list_layout' );
	$bubulla_sidebar = fw_get_db_settings_option( 'services_list_sidebar' );

	if ( $bubulla_sidebar == 'hidden' ) {

		$bubulla_sidebar_hidden = true;
	}

	if ($bubulla_layout == 'three-cols') {

		$bubulla_sidebar_hidden = true;
	}

	if ( $bubulla_sidebar == 'left' ) {

		$wrap_class = 'col-xl-8 col-xl-push-4 col-lg-9 col-lg-push-3 col-lg-offset-0 col-md-12 col-xs-12';
	}

	$row_class = '';
	if ( $bubulla_layout == 'two-cols' OR $bubulla_layout == 'three-cols' ) {

		$row_class = 'masonry';
		if ( $bubulla_sidebar_hidden ) $wrap_class = 'col-lg-12 col-xs-12';
	}
		else {

		if ( $bubulla_sidebar_hidden ) $wrap_class = 'col-xl-8 col-lg-10 col-md-12 col-xs-12';	
	}
}

get_header(); ?>
<div class="inner-page margin-default">
	<div class="row <?php if ( $bubulla_sidebar_hidden ) { echo 'centered'; } ?>">
        <div class="<?php echo esc_attr( $wrap_class ); ?>">
            <div class="blog blog-block layout-<?php echo esc_attr($bubulla_layout); ?>">
				<?php

				if ( get_query_var( 'paged' ) ) {

					$paged = get_query_var( 'paged' );

				} elseif ( get_query_var( 'page' ) ) {

					$paged = get_query_var( 'page' );
					
				} else {

					$paged = 1;
				}

				$wp_query = new WP_Query( array(
					'post_type' => 'services',
					'paged' => (int) $paged,
				) );

            	echo '<div class="row '.esc_attr($row_class).'">';
				if ( $wp_query->have_posts() ) :

					while ( $wp_query->have_posts() ) : the_post();

						if ( !function_exists( 'fw_get_db_settings_option' ) ) {

							get_template_part( 'tmpl/content-post-one-col', $wp_query->get_post_format() );
						}
							else {

							set_query_var( 'bubulla_layout', $bubulla_layout );

							if ($bubulla_layout == 'three-cols') {

								get_template_part( 'tmpl/content-post-three-cols', $wp_query->get_post_format() );
							}
								else
							if ($bubulla_layout == 'two-cols') {

								get_template_part( 'tmpl/content-post-two-cols', $wp_query->get_post_format() );
							}
								else {

								get_template_part( 'tmpl/content-post-one-col', $wp_query->get_post_format() );
							}
						}

						endwhile;

					else :
						// If no content, include the "No posts found" template.
						get_template_part( 'tmpl/content', 'none' );

					endif;
				echo '</div>';
				?>
	        </div>
			<?php
			if ( have_posts() ) {

				bubulla_paging_nav();
			}
            ?>	        
	    </div>
	    <?php
	    if ( !$bubulla_sidebar_hidden ) {

            if ( $bubulla_sidebar == 'left' ) {

            	get_sidebar( 'left' ); 
            }
            	else  {

            	get_sidebar();
            }
	    }
	    ?>
	</div>
</div>
<?php

get_footer();

<?php
/**
 * The Template for displaying all single blog posts
 */

$bubulla_sidebar_hidden = false;
$bubulla_sidebar = 'right';
$blog_wrap_class = 'col-xl-8 col-lg-8 col-md-12 col-xs-12';

if ( function_exists( 'FW' ) ) {

	$bubulla_sidebar = fw_get_db_settings_option( 'blog_post_sidebar' );

	if ( $bubulla_sidebar == 'left' ) {

		$blog_wrap_class = 'col-xl-7 col-xl-push-4 col-lg-8 col-lg-push-4 col-lg-offset-0 col-md-12 col-xs-12';	
	}
		else
	if ( $bubulla_sidebar == 'hidden' ) {

		$blog_wrap_class = 'col-xl-9 col-lg-10 col-md-12 col-xs-12';	
		$bubulla_sidebar_hidden = true;
	}
}

if ( !bubulla_check_active_sidebar() ) {

	$blog_wrap_class = 'col-xl-8 col-lg-10 col-md-12 col-xs-12';	
	$bubulla_sidebar_hidden = true;	
}

get_header();

while ( have_posts() ) : 

	the_post();
?>
<div class="inner-page margin-post">
    <div class="row <?php if ( $bubulla_sidebar_hidden ) echo 'row-center'; ?>">  
        <div class="<?php echo esc_attr( $blog_wrap_class ); ?>">
            <section class="blog-post">
				<?php
					get_template_part( 'tmpl/content-post-full', get_post_format() );

					if ( comments_open() || get_comments_number() ) {

						comments_template();
					}
				?>                    
            </section>
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

endwhile;

get_footer();

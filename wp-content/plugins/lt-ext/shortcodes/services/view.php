<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Services Shortcode
 */

$args = get_query_var('like_sc_services');

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$class .= ' layout-'.$args['layout'];

$query_args = array(
	'post_type' => 'services',
	'post_status' => 'publish',
	'posts_per_page' => (int)($args['limit']),
);


if ( !empty($args['ids']) ) $query_args['post__in'] = explode(',', esc_attr($args['ids']));
	else
if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
		array(
            'taxonomy'  => 'services-category',
            'field'     => 'if', 
            'terms'     => array(esc_attr($args['cat'])),
		)
    );
}

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	$swiper_item_class = '';
	if ( !empty($args['swiper']) ) {

		$swiper_item_class = 'swiper-slide';
		echo ltx_vc_swiper_get_the_container('ltx-services-sc', $atts, $class, $id);
		echo '<div class="swiper-wrapper">';
	}
		else {

		echo '<div class="ltx-ltx-services-sc-wrapper ltx-services-sc '.esc_attr($class).'" '.$id.'><div class=" row centered">';
		$swiper_item_class = ' col-lg-4 col-md-6 ';
	}	

	while ( $query->have_posts() ) {

		$query->the_post();

		$subheader = fw_get_db_post_option(get_The_ID(), 'header');
		$price = fw_get_db_post_option(get_The_ID(), 'price');
		$cut = fw_get_db_post_option(get_The_ID(), 'cut');
		$image = fw_get_db_post_option(get_The_ID(), 'image');
		$header = get_the_title();
		$link = fw_get_db_post_option(get_The_ID(), 'link');
		$link_more = fw_get_db_post_option(get_The_ID(), 'link_more');
		$link_header = fw_get_db_post_option(get_The_ID(), 'link_header');
		$more_header = fw_get_db_post_option(get_The_ID(), 'more_header');

		if ( empty($link) ) {

			$link = get_the_permalink();
		}		

		$bg = get_the_post_thumbnail_url(get_The_ID(), 'bubulla-service');
		if ( !empty($bg) ) {

			$bg = ' style="background-image: url('.esc_url($bg).');"';
		}
			else {

			$bg = '';
		}

		if ( !empty($image) ) {

			$bg2 = ' style="background-image: url('.esc_url($image['url']).');"';
		}
			else {

 			$bg2 = '';
		}

		if ( $args['layout'] == 'product' ):

			?>
			<div class="ltx-item <?php echo esc_attr($swiper_item_class); ?>"<?php echo $bg2; ?>>
				<div class="ltx-item-inner"<?php echo $bg; ?>>
				    <div class="description">
				        <a href="<?php esc_url( the_permalink() ); ?>" class="header">
				        	<h5 class="header"><?php echo wp_kses_post($header); ?></h5>
				        </a>
			        	<p>
			        		<?php echo wp_kses_post(nl2br(ltx_header_parse($cut))); ?>
			        	</p>
				        <?php

							if ( !empty($link_header) ) {

								echo '<a href="'.esc_url( $link ).'" class="btn btn-xs btn-second">'.esc_html($link_header).'</a>';
							}		 	

							if ( !empty($more_header) ) {

								echo '<a href="'.esc_url( $link_more ).'" class="btn btn-xs btn-transparent">'.esc_html($more_header).'</a>';
							}		 							
						?>
				    </div>
				</div>
			</div>
			<?php

		endif;

		if ( $args['layout'] == 'photos' ):

			?>
			<div class="ltx-item <?php echo esc_attr($swiper_item_class); ?>"<?php echo $bg2; ?>>
				<div class="ltx-item-inner">
					<a href="<?php esc_url( the_permalink() ); ?>" class="ltx-image">
					<?php
						the_post_thumbnail('bubulla-gallery-grid');
					?>
					</a>
				    <div class="description">
				        <a href="<?php esc_url( the_permalink() ); ?>" class="header">
				        	<h5 class="header"><?php echo wp_kses_post($header); ?></h5>
				        </a>
			        	<p>
			        		<?php echo wp_kses_post(nl2br(ltx_header_parse($cut))); ?>
			        	</p>
				        <?php

							if ( !empty($atts['more_text']) ) {

								echo '<a href="'.esc_url( $link ).'" class="btn btn-xxs btn-second">'.esc_html($atts['more_text']).'</a>';
							}		 	
						?>
				    </div>
				</div>
			</div>
			<?php

		endif;		

	}

	if ( !empty($args['swiper']) ) {

		echo '</div>';	
	}
		
	echo '</div></div>';


	wp_reset_postdata();
}


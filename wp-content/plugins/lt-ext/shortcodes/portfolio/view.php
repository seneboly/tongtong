<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );
/**
 * Portfolio Shortcode
 */

$args = get_query_var('like_sc_portfolio');

$class = '';
if ( !empty($args['class']) ) $class .= ' '. esc_attr($args['class']);
if ( !empty($args['id']) ) $id = ' id="'. esc_attr($args['id']). '"'; else $id = '';

$class .= ' layout-'.$args['layout'];

$query_args = array(
	'post_type' => 'portfolio',
	'post_status' => 'publish',
	'posts_per_page' => (int)($args['limit']),
);

if ( !empty($args['ids']) ) $query_args['post__in'] = explode(',', esc_attr($args['ids']));
	else
if ( !empty($args['cat']) ) {

	$query_args['tax_query'] = 	array(
		array(
            'taxonomy'  => 'portfolio-category',
            'field'     => 'if', 
            'terms'     => array(esc_attr($args['cat'])),
		)
    );
}

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) {

	if ( !empty($args['swiper']) AND $args['layout'] != 'filter' ) {

		$item_class = 'swiper-slide';
		echo ltx_vc_swiper_get_the_container('ltx-portfolio-sc ltx-'.esc_attr($atts['layout']), $atts, $class, $id);
		echo '<div class="swiper-wrapper">';
	}
		else {

		$item_class = ' col-lg-6 col-md-6';

		if ( $query->found_posts >= 5 ) $item_class = ' col-lg-2 col-md-4 col-ms-6 ';
			else
		if ( $query->found_posts >= 4 ) $item_class = ' col-lg-3 col-md-4 ';
			else
		if ( $query->found_posts >= 3 ) $item_class = ' col-lg-4 col-md-4 ';

		echo '<div class="ltx-portfolio-sc-wrapper '.esc_attr($class).'" '.$id.'>';
		echo '<div class="ltx-portfolio-sc ltx-filter-container ltx-'.esc_attr($atts['layout']).'">';

			if ( $args['layout'] == 'filter' ) {
				
				$cats = ltxGetCats('portfolio-category');

				echo '<ul class="ltx-tabs-cats">';

					echo '<li class="ltx-cat" data-filter="0"><span class="ltx-item">'.esc_html__("All", 'lt-ext').'</span></li>';				
				
					$x = 0;
					foreach ($cats as $catId => $cat) {

						$term = get_term( $catId, 'portfolio-category' );

						$x++;
						if ( !empty($cat['name']) ) {

							echo '<li class="ltx-cat" data-filter="'.esc_attr($catId).'"><span class="ltx-item">'.esc_html($cat['name']).' <span>('.$term->count.')</span></span></li>';
						}

						if ( $x == 6 ) {

							break;
						}

					}
				echo '</ul>';		
			}

			echo '<div class="row">';
	}

		while ( $query->have_posts() ):

			$query->the_post();

			$year = fw_get_db_post_option(get_The_ID(), 'year');
			$rate = fw_get_db_post_option(get_The_ID(), 'rate');
			$link = fw_get_db_post_option(get_The_ID(), 'link');
			$header = get_the_title();

			$comments = get_comments_number();

			if ( empty($link) ) {

				$link = get_the_permalink();
			}		

			if ( $args['layout'] == 'filter' ) {
			
				$item_class .= ' ltx-filter-item ';
				$cats = wp_get_post_terms( get_the_ID(), 'portfolio-category' );

				if ( !empty($cats) ) {

					foreach ( $cats as $cat ){

						$item_class .= ' ltx-filter-id-'.$cat->term_id;
					}
				}
			}

			set_query_var( 'bubulla_item_class', $item_class );

			get_template_part( 'tmpl/content-portfolio' );

			?>

			

			<?php

		endwhile;

	echo '</div>
	</div>
	</div>';

	wp_reset_postdata();
}


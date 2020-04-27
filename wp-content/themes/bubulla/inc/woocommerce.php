<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Woocommerce Hooks
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_before_shop_loop_item',	'woocommerce_template_loop_product_link_open', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action( 'woocommerce_after_subcategory',	'woocommerce_template_loop_category_link_close', 10);


add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action('woocommerce_before_main_content', 'bubulla_wc_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'bubulla_wc_wrapper_end', 10);

if ( !function_exists( 'bubulla_wc_wrapper_start' ) ) {

	function bubulla_wc_wrapper_start() {

		$bubulla_sidebar = bubulla_get_wc_sidebar_pos();

		if ( is_active_sidebar( 'sidebar-wc' ) AND !empty( $bubulla_sidebar ) ) {

	  		echo '<div class="inner-page margin-default">
	  				<div class="row">';
	  		
	  		if ( $bubulla_sidebar == 'left' ) {

		  		echo '<div class="col-xl-9 col-xl-push-3 col-lg-8 col-lg-push-4 col-md-12 text-page products-column-with-sidebar matchHeight" >';
	  		}
	  			else {

	  			echo '<div class="col-xl-9 col-lg-8 col-md-12 col-xs-12 text-page products-column-with-sidebar matchHeight" >';
  			}
		}
			else {

	  		echo '<div class="inner-page margin-default">
	  				<div class="row centered"><div class="col-xl-9 col-lg-12 text-page">';
		}	  
	}
}

if ( !function_exists( 'bubulla_wc_wrapper_end' ) ) {

	function bubulla_wc_wrapper_end() {

		echo '</div>';
	}
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_before_subcategory_title',	'bubulla_woocommerce_item_wrapper_start', 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'bubulla_woocommerce_item_wrapper_start', 9 );

add_action( 'woocommerce_before_subcategory_title',	'bubulla_woocommerce_title_wrapper_start', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'bubulla_woocommerce_title_wrapper_start', 20 );

add_action( 'woocommerce_after_shop_loop_item_title',	'bubulla_woocommerce_title_wrapper_end', 7);

add_action( 'woocommerce_after_subcategory', 'bubulla_woocommerce_item_wrapper_end', 20 );
add_action( 'woocommerce_after_shop_loop_item',	'bubulla_woocommerce_item_wrapper_end', 20 );


remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary', 'bubulla_woocommerce_title',5);

if ( ! function_exists( 'bubulla_woocommerce_title' ) ) {

	function bubulla_woocommerce_title() {
  		
		return false;
  	}
}


if ( !function_exists( 'bubulla_woocommerce_item_wrapper_start' ) ) {

	function bubulla_woocommerce_item_wrapper_start($cat='') {

		global $product;

			echo '<div class="item">';
	
		?>
			<div class="image">
		<?php
	}
}

function ltx_filter_product_post_class( $classes, $class, $post_id ){

    if ( !empty(get_The_ID()) AND get_post_type(get_The_ID()) == 'product' AND function_exists('FW')) {

		$featured = fw_get_db_post_option(get_The_ID(), 'featured');
		if ( !empty($featured) ) {

		    $classes[] = 'ltx-featured-product';
		}
    }

	return $classes;
}
add_filter( 'post_class', 'ltx_filter_product_post_class', 10, 3 );

/**
 * Replace image size for featured products
 */
if ( !function_exists( 'bubulla_wc_archive_image' ) ) {

	function bubulla_wc_archive_image() {

		global $product;

		$wc_id = $product->get_id();

		if ( function_exists('FW') ) {

			$featured = fw_get_db_post_option($wc_id, 'featured');
		}

		if ( !empty($featured) ) {

			echo woocommerce_get_product_thumbnail('bubulla-wc-featured');
		}	
			else {

			echo woocommerce_get_product_thumbnail();
		}

	}
}
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'bubulla_wc_archive_image', 10);


if ( !function_exists( 'bubulla_woocommerce_item_wrapper_end' ) ) {

	function bubulla_woocommerce_item_wrapper_end($cat='') {

		global $product;

		if ( !empty($product) ) {


			if ( function_exists('FW') AND !empty($product) )  {

				$wc_show_more = fw_get_db_settings_option( 'wc_show_more' );
				if ( $wc_show_more == 'enabled' ) {

					echo '<a href="'.get_permalink( $product->get_id() ).'" class="ltx-btn-more btn btn-xs btn-transparent color-main">'.esc_html__('Read more', 'bubulla').'</a>';
				}
			}
		
			echo '</div>
			</div>';
		}
			else {

			echo '</a></div>';
		}
	}
}

if ( !function_exists( 'bubulla_woocommerce_title_wrapper_start' ) ) {

	function bubulla_woocommerce_title_wrapper_start($cat='') {

		global $product;

		echo '</div>';

		if ( function_exists('FW') AND !empty($product) )  {

			$rate = fw_get_db_settings_option( 'wc_show_list_rate' );
			if ( $rate == 'enabled' )  {

				echo wc_get_rating_html( $product->get_average_rating() );	
			}
		}

		if ( !empty($product) ) {

			echo '<div class="ltx-item-descr"><a href="'.get_permalink( $product->get_id() ).'">';
		}
			else {

			echo '<a href="'.get_term_link( $cat, 'product_cat' ).'">';
		}
	}
}


if ( !function_exists( 'bubulla_woocommerce_title_wrapper_end' ) ) {

	function bubulla_woocommerce_title_wrapper_end() {

		global $product;

		echo '</a>';	

		if ((is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() || !empty($product) )  && !is_product()) {

		    $excerpt = apply_filters('the_excerpt', get_the_excerpt());

		    if ( function_exists('FW') ){

				$cut_db = $cut = (int) fw_get_db_settings_option( 'excerpt_wc_auto' );
		    }

		    $cut = 50;
			$cut = apply_filters('ltx_wc_excerpt_size', $cut);

			if ( empty($cut) AND !empty($cut_db) ) {

				$cut = $cut_db;
			}
				else
			if ( empty($cut) ) {

				$cut = 50;
			}

			$display_excerpt = true;
			if ( function_exists('FW') ) {

				$display_excerpt = fw_get_db_settings_option( 'wc_show_list_excerpt' );
				$excerpt_query = get_query_var( 'ltx-wc-excerpt' );
				if ( $display_excerpt == 'disabled' AND empty($excerpt_query) ) {

					$display_excerpt = false;
				}
			}

			if ( function_exists('FW') ) {

				$attr = fw_get_db_settings_option( 'wc_show_list_attr' );
				$attr_query = get_query_var( 'ltx-wc-attr' );
				if ( $attr == 'enabled' OR !empty($attr_query) )  {

					bubulla_woocommerce_display_attr();
				}
			}

			if ( !empty($display_excerpt) ) {

				echo '<div class="post_content entry-content">'. esc_html( bubulla_cut_text( $excerpt, $cut ) ) .'</div>';
			}
		}
	}
}

add_filter( 'post_class', 'bubulla_woocommerce_loop_shop_columns_class' );
add_filter( 'product_cat_class', 'bubulla_woocommerce_loop_shop_columns_class', 10, 3 );

if ( !function_exists( 'bubulla_woocommerce_loop_shop_columns_class' ) ) {
	function bubulla_woocommerce_loop_shop_columns_class($classes, $class='', $cat='') {
		global $woocommerce_loop;

		return $classes;
	}
}


if ( !function_exists( 'bubulla_woocommerce_display_attr' ) ) {

	function bubulla_woocommerce_display_attr() {

		global $product;

		$attributes = $product->get_attributes();

		if ( !empty($attributes) ) {

			echo '<div class="ltx-wc-attr-list">';

			foreach ( $attributes as $attribute ) {

				if ( !empty($attribute['value']) ) {

			        $product_attributes = array();
			        $product_attributes = explode('|', $attribute['value']);

					$items = array();
			        foreach ( $product_attributes as $pa ) {
			            $items[] = trim($pa);
			        }

			        echo '<div class="item">'.$attribute['name'] . ": <span>" . implode(', ', $items).'</span></div>';
			    }   
			    	else {

			    	echo '<div class="item">';
						echo wc_attribute_label($attribute->get_name(), $product). ": <span>".$product->get_attribute ( $attribute->get_name() )."</span>";
			    	echo '</div>';
			   	}	   	
			}

			echo '</div>';
		}
	}
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	
	$bubullaWoocommerceNewLabel = new bubullaWoocommerceNewLabel();
}

/*
	New Label
*/
if ( !class_exists( 'bubulla_woocommerce_new_label' ) ) {

	class bubullaWoocommerceNewLabel {

		public function __construct() {

			add_action( 'woocommerce_settings_image_options_after', array( $this, 'bubulla_woocommerce_admin_settings' ), 20 );
			add_action( 'woocommerce_update_options_catalog', array( $this, 'bubulla_woocommerce_save_admin_settings' ) );
			add_action( 'woocommerce_update_options_products', array( $this, 'bubulla_woocommerce_save_admin_settings' ) );

			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'bubulla_woocommerce_product_loop_new_label' ), 30 );
		}

		function bubulla_woocommerce_product_loop_new_label() {

			$product_date = strtotime( get_the_time( 'Y-m-d' ) );
			
			if ( function_exists('FW') ) {

				$new_days = fw_get_db_settings_option( 'wc_new_days' );
			}
			
			$item = wc_get_product( get_the_ID() );

			if ( empty($new_days)) {

				$new_days = 0;
			}

			if ( !$item->is_on_sale() AND ( time() - ( 60 * 60 * 24 * $new_days ) ) < $product_date ) {

				echo '<span class="wc-label-new">' . esc_html__( 'New', 'bubulla' ) . '</span>';
			}
		}

		function bubulla_woocommerce_admin_settings() {

			woocommerce_admin_fields( $this->settings );
		}

		function bubulla_woocommerce_save_admin_settings() {

			woocommerce_update_options( $this->settings );
		}

	}
}

add_filter('woocommerce_sale_flash', 'bubulla_custom_sale_text', 10, 3);
function bubulla_custom_sale_text($text, $post, $_product) {

    return '<span class="onsale">' . esc_html__( 'Sale', 'bubulla' ) . '</span>';
}

function bubulla_related_products_limit() {

	global $product;
	
	$args['posts_per_page'] = 3;
	return $args;
}

add_filter('loop_shop_columns', 'bubulla_wc_loop_columns');
if (!function_exists('bubulla_wc_loop_columns')) {

	function bubulla_wc_loop_columns() {

	    if ( function_exists('FW') ){

			$cols = fw_get_db_settings_option( 'wc_columns' );
			return $cols;
	    }		
	    	else {

			return 3;
    	}
	}
}

add_filter( 'loop_shop_per_page', 'bubulla_wc_loop_shop_per_page', 20 );
if (!function_exists('bubulla_wc_loop_shop_per_page')) {

	function bubulla_wc_loop_shop_per_page( $cols ) {

	    if ( function_exists('FW') ){

			$rows = fw_get_db_settings_option( 'wc_per_page' );
			return $rows;
	    }		
	    	else {

			return 6;
    	}
	}
}

add_filter( 'woocommerce_output_related_products_args', 'bubulla_related_products_args', 20 );
function bubulla_related_products_args( $args ) {

	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}

add_filter('woocommerce_cross_sells_total', 'bubulla_CrossSellTotal');
function bubulla_CrossSellTotal($total) {

	$total = 2;
	return $total;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'bubulla_refresh_mini_cart_count');
function bubulla_refresh_mini_cart_count($fragments){
    
    $out = '<span class="cart-contents header-cart-count count">'.esc_html(WC()->cart->get_cart_contents_count()).'</span>';
	$fragments['.cart-contents'] = $out;
    return $fragments;
}

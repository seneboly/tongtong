<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://fuji-9.com/
 * @since      1.0.0
 *
 * @package    Lrr_For_Woocommerce
 * @subpackage Lrr_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Lrr_For_Woocommerce
 * @subpackage Lrr_For_Woocommerce/public
 * @author     Fuji 9 <info@fuji-9.com>
 */
class Lrr_For_Woocommerce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lrr_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lrr_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lrr-for-woocommerce-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Lrr_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Lrr_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lrr-for-woocommerce-public.js', array( 'jquery' ), $this->version, false );

	}



	/**
	 * Override the redirect URL when user is logged in WooCommerce
	 *
	 * @since    1.0.0
	 * @param    string    $url       The redirect URL
	 * @return   string    URL for redirection
	 */
	public function lrr_woocommerce_login_redirect ($url) {
		$redirect_url = Lrr_For_Woocommerce_Settings::get_option('lrrfw_basic_login_redirect_url', 'lrrfw_basic');
		if ($redirect_url != '') {
			return $redirect_url;
		}
		return $url;
	}


	/**
	 * Override the redirect URL when user is registred in WooCommerce
	 *
	 * @since    1.0.0
	 * @param    string    $url       The redirect URL
	 * @return   string    URL for redirection
	 */
	public function lrr_woocommerce_registration_redirect ($url) {
		$redirect_url = Lrr_For_Woocommerce_Settings::get_option('lrrfw_basic_register_redirect_url', 'lrrfw_basic');
		if ($redirect_url != '') {
			return $redirect_url;
		}
		return $url;
	}

}

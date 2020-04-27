<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://fuji-9.com/
 * @since             1.0.0
 * @package           Lrr_For_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Login & Register Redirect for WooCommerce
 * Plugin URI:        https://fuji-9.com/login-register-redirect-for-woocommerce
 * Description:       Login & Register Redirect for WooCommerce
 * Version:           1.0.0
 * Author:            Fuji 9
 * Author URI:        https://fuji-9.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lrr-for-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LRR_FOR_WOOCOMMERCE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lrr-for-woocommerce-activator.php
 */
function activate_lrr_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lrr-for-woocommerce-activator.php';
	Lrr_For_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lrr-for-woocommerce-deactivator.php
 */
function deactivate_lrr_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lrr-for-woocommerce-deactivator.php';
	Lrr_For_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lrr_for_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_lrr_for_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lrr-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lrr_for_woocommerce() {

	$plugin = new Lrr_For_Woocommerce();
	$plugin->run();

}
run_lrr_for_woocommerce();

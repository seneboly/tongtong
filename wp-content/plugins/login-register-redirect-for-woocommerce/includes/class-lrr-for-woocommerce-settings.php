<?php
/**
 * Settings class
 *
 * @link       https://fuji-9.com/
 * @since      1.0.0
 *
 * @package    Lrr_For_Woocommerce
 * @subpackage Lrr_For_Woocommerce/includes
 */

/**
 * Settings class
 *
 * @package    Lrr_For_Woocommerce
 * @subpackage Lrr_For_Woocommerce/includes
 * @author     Fuji 9 <info@fuji-9.com>
 */


class Lrr_For_Woocommerce_Settings {

    private $settings_api;

    public function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    public function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    public function admin_menu() {
        add_options_page( 'Login & Register Redirect for WooCommerce', 'Login & Register Redirect for WooCommerce', 'manage_options', 'lrr-for-woocommerce-admin', array($this, 'plugin_page') );
    }

    private function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'lrrfw_basic',
                'title' => __( 'Basic Settings', 'lrr-for-woocommerce' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    private function get_settings_fields() {
        $settings_fields = array(
            'lrrfw_basic' => array(
                array(
                    'name'              => 'lrrfw_basic_login_redirect_url',
                    'label'             => __( 'Login redirect URL', 'lrr-for-woocommerce' ),
                    'desc'              => __( 'Enter the URL on which user will redirect after the login.<br>Leave
                        empty to user WooCommerce default one.', 'lrr-for-woocommerce' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'strval'
                ),
                array(
                    'name'              => 'lrrfw_basic_register_redirect_url',
                    'label'             => __( 'Register redirect URL', 'lrr-for-woocommerce' ),
                    'desc'              => __( 'Enter the URL on which user will redirect after the registration<br>Leave
                        empty to user WooCommerce default one.', 'lrr-for-woocommerce' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'strval'
                )
            )
        );

        return $settings_fields;
    }

    public function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    public static function get_option( $option, $section, $default = '' ) {

        $options = get_option( $section );

        if ( isset( $options[$option] ) and $options[$option] != '') {
            return $options[$option];
        }

        return $default;
    }

}


$lrrfw_basic_settings = new Lrr_For_Woocommerce_Settings();
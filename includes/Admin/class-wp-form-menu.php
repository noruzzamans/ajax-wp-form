<?php

class WP_Form_Menu {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'wp_form_register_menu' ) );
    }

    public function wp_form_register_menu() {

        add_menu_page (
            __('WP Form', 'wp-form'),
            __('WP Form', 'wp-form'),
            'manage_options',
            'wp-form',
            [$this, 'wp_form_menu_page'],
            'dashicons-feedback',
            6
        );
    }

    public function wp_form_menu_page() {
        echo '<h1>WP Form</h1>';
    }

}
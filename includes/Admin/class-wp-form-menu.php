<?php
class WP_Form_Menu {

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'wp_form_register_menu' ) );
    }

    public function wp_form_register_menu() {

        $parent_slug = 'wp-form';
        $capability  = 'manage_options';

        add_menu_page(
            __( 'WP Form', 'wp-form' ),
            __( 'WP Form', 'wp-form' ),
            $capability,
            $parent_slug,
            [$this, 'wp_form_menu_page'],
            'dashicons-feedback',
            6
        );
    }

    public function wp_form_menu_page() {
        require WP_FORM_PATH . 'includes/Admin/views/view.php';
    }
}
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

        $action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id     = isset( $_GET['id'] ) ? $_GET['id'] : 0;

        switch ( $action ) {
            case 'edit':
                $data     = wp_form_get_data_by_id( $id );
                $template = __DIR__ . '/views/edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/view.php';
                break;

            default:
                $template = __DIR__ . '/views/list.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include $template;
        }

    }

}

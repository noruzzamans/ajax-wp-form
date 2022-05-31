<?php

class WP_Form_Ajax {
    public function wp_form_submit( $args = [] ) {

        if ( ! wp_verify_nonce( $nonce, 'wp_form_nonce' ) ) {
            die( 'Busted!' );
        }

        $fname = isset( $_POST['fname'] ) ? sanitize_text_field( $_POST['fname']) : '';
        $lname = isset( $_POST['lname'] ) ? sanitize_text_field( $_POST['lname']) : '';
        $email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email']) : '';
        $subject = isset( $_POST['subject'] ) ? sanitize_text_field( $_POST['subject']) : '';
        $message = isset( $_POST['message'] ) ? sanitize_textarea_field( $_POST['message']) : '';



        global $wpdb;

        if ( empty( $_POST['fname'] ) ) {
            return new \WP_Error( 'fname_error', 'First Name is required' );
        }

        if ( empty( $_POST['lname'] ) ) {
            return new \WP_Error( 'lname_error', 'Last Name is required' );
        }

        if ( empty( $_POST['email'] ) ) {
            return new \WP_Error( 'email_error', 'Email is required' );
        }

        if ( empty( $_POST['subject'] ) ) {
            return new \WP_Error( 'subject_error', 'Subject is required' );
        }

        if ( empty( $_POST['message'] ) ) {
            return new \WP_Error( 'message_error', 'Message is required' );
        }

        $defaults = [
            'fname'      => '',
            'lname'      => '',
            'email'      => '',
            'subject'    => '',
            'message'    => '',
            'created_at' => current_time( 'mysql' ),
            'created_by' => get_current_blog_id(),
        ];

        $data     = wp_parse_args( $args, $defaults );
        $inserted = $wpdb->insert(
            "{$wpdb->prefix}wp_form",
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
            ]
        );

        if ( ! $inserted ) {
            return new \WP_Error( 'There was an error saving the form' );
        }

        return $wpdb->insert_id;

        exit;
    }

}

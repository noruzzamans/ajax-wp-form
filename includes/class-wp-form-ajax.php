<?php

class WP_Form_Ajax {
    public function wp_form_submit() {

        $nonce = $_POST['nonce'];

        if ( ! wp_verify_nonce( $nonce, 'wp_form_nonce' ) ) {
            die( 'Busted!' );
        }

        $data    = $_POST['data'];
        $fname   = isset( $data['fname'] ) ? sanitize_text_field( $data['fname'] ) : '';
        $lname   = isset( $data['lname'] ) ? sanitize_text_field( $data['lname'] ) : '';
        $email   = isset( $data['email'] ) ? sanitize_email( $data['email'] ) : '';
        $subject = isset( $data['subject'] ) ? sanitize_text_field( $data['subject'] ) : '';
        $message = isset( $data['message'] ) ? sanitize_textarea_field( $data['message'] ) : '';

        if ( empty( $data['fname'] ) ) {
            return new \WP_Error( 'fname_error', 'First Name is required' );
        }

        if ( empty( $data['lname'] ) ) {
            return new \WP_Error( 'lname_error', 'Last Name is required' );
        }

        if ( empty( $data['email'] ) ) {
            return new \WP_Error( 'email_error', 'Email is required' );
        }

        if ( empty( $data['subject'] ) ) {
            return new \WP_Error( 'subject_error', 'Subject is required' );
        }

        if ( empty( $data['message'] ) ) {
            return new \WP_Error( 'message_error', 'Message is required' );
        }

        global $wpdb;
        $inserted = $wpdb->insert(
            "{$wpdb->prefix}wp_form",
            [
                'fname'      => $fname,
                'lname'      => $lname,
                'email'      => $email,
                'subject'    => $subject,
                'message'    => $message,
                'created_by' => get_current_blog_id(),
                'created_at' => current_time( 'mysql' ),
            ],
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
                '%s',
            ]
        );

        if ( ! $inserted ) {
            return new \WP_Error( 'There was an error saving the form' );
        }

        wp_send_json_success( [
            'message' => 'Form submitted successfully',
        ] );

        return $wpdb->insert_id;
    }

}


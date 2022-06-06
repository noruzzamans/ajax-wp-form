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


        global $wpdb;

        //email validation
        $query   = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wp_form WHERE email = %s", $email );
        $results = $wpdb->get_results( $query );

        if ( count( $results ) > 0 ) {
            wp_send_json_error( 'Email already exits. Please entered another email', 409 );
        }

        //insert data
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

        //success message
        if ( $inserted ) {
            wp_send_json_success( [
                'message' => 'Your message has been sent successfully.',
            ], 200 );
        }

        return $wpdb->insert_id;
    }

}

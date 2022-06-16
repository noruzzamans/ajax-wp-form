<?php

class WP_Form_Ajax {

    public $errors = [];

    public function wp_form_submit() {

        $nonce = $_POST['nonce'];

        if ( ! wp_verify_nonce( $nonce, 'wp_form_nonce' ) ) {
            die( 'Busted!' );
        }

        // sanitize user input
        $data    = $_POST['data'];
        $id      = isset( $data['id'] ) ? intval( $data['id'] ) : 0;
        $fname   = isset( $data['fname'] ) ? sanitize_text_field( $data['fname'] ) : '';
        $lname   = isset( $data['lname'] ) ? sanitize_text_field( $data['lname'] ) : '';
        $email   = isset( $data['email'] ) ? sanitize_email( $data['email'] ) : '';
        $subject = isset( $data['subject'] ) ? sanitize_text_field( $data['subject'] ) : '';
        $message = isset( $data['message'] ) ? sanitize_textarea_field( $data['message'] ) : '';

        // validate user input
        if ( empty( $fname ) || empty( $lname ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
            $this->errors['fname']   = __( 'First name is required', 'wp-form' );
            $this->errors['lname']   = __( 'Last name is required', 'wp-form' );
            $this->errors['email']   = __( 'Email is required', 'wp-form' );
            $this->errors['subject'] = __( 'Subject is required', 'wp-form' );
            $this->errors['message'] = __( 'Message is required', 'wp-form' );
        }

        if ( ! empty( $this->errors ) ) {
            wp_send_json_error( $this->errors );
        }

        global $wpdb;

        //unique email validation
        $query   = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wp_form WHERE email = %s", $email );
        $results = $wpdb->get_results( $query );

        if ( count( $results ) > 0 ) {
            wp_send_json_error( [
                'message' => __( 'Email already exits. Please entered another email', 'wp-form' ),
            ] );
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
                'message' => __( 'Your message has been sent successfully.', 'wp-form' ),
            ], 200 );
        }

        return $wpdb->insert_id;
    }

}

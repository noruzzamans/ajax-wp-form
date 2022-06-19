<div class="wrap">
    <h1><?php _e( 'WP Form Single Information', 'wp-form' );?></h1>
    <table class="form-table" role="presentation">
            <tr>
                <th scope="row">
                    <label for="fname"><?php _e( 'First Name', 'wp-form' );?></label>
                </th>
                <td>
                    <p><?php echo esc_attr( $data->fname ); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="lname"><?php _e( 'Last Name', 'wp-form' );?></label>
                </th>
                <td>
                    <p><?php echo esc_attr( $data->lname ); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="email"><?php _e( 'Email', 'wp-form' );?></label>
                </th>
                <td>
                    <p><?php echo esc_attr( $data->email ); ?></p>
                </td>
            </tr>
                <th scope="row">
                    <label for="subject"><?php _e( 'Subject', 'wp-form' );?></label>
                </th>
                <td>
                    <p><?php echo esc_attr( $data->subject ); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="message"><?php _e( 'Message', 'wp-form' );?></label>
                </th>
                <td>
                    <p><?php echo esc_attr( $data->message ); ?></p>
                </td>
            </tr>
        </table>

</div>
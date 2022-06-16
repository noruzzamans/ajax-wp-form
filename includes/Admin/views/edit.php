<div class="wrap">
    <h1><?php _e( 'WP Form Feadback Edit', 'wp-form' );?></h1>

    <form method="post" action=" " novalidate="novalidate">
        <table class="form-table" role="presentation">
            <tr>
                <th scope="row">
                    <label for="fname"><?php _e( 'First Name', 'wp-form' );?></label>
                </th>
                <td>
                    <input type="text" class="regular-text" name="fname" id="fname" value="<?php echo esc_attr( $data->fname ); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="lname"><?php _e( 'Last Name', 'wp-form' );?></label>
                </th>
                <td>
                    <input type="text" class="regular-text" name="lname" id="lname" value="<?php echo esc_attr( $data->lname ); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="email"><?php _e( 'Email', 'wp-form' );?></label>
                </th>
                <td>
                    <input type="email" class="regular-text" name="email" id="email" value="<?php echo esc_attr( $data->email ); ?>">
                </td>
            </tr>
                <th scope="row">
                    <label for="subject"><?php _e( 'Subject', 'wp-form' );?></label>
                </th>
                <td>
                    <input type="text" class="regular-text" name="subject" id="subject" value="<?php echo esc_attr( $data->subject ); ?>">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="message"><?php _e( 'Message', 'wp-form' );?></label>
                </th>
                <td>
                    <textarea class="regular-text" name="message" id="message"><?php echo esc_attr( $data->message ); ?></textarea>
                </td>
            </tr>
        </table>

        <input type="hidden" name="id" value="<?php echo esc_attr( $data->id ) ?>">

        <?php submit_button( __( 'Update', 'wp-form' ), 'primary', 'update' );?>
    </form>
</div>
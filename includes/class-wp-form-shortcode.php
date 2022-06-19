<?php
    class WP_From_Shortcode {
        public function shortcode_generator() {
            add_shortcode( 'wp_form', [$this, 'render_shortcode'] );
            add_shortcode( 'wp_form_entries', [$this, 'render_form_entries'] );
        }

        public function render_shortcode() {

            static $i = 0;
            $i++;

            $id_prefix = 'wp_form_' . $i;

            $fname = '';
            $lname = '';
            $email = '';

            if(is_user_logged_in()) {
                $current_user = wp_get_current_user();
                $fname = $current_user->user_fname;
                $lname = $current_user->user_lname;
                $email = $current_user->user_email;
            }

            ob_start();

        ?>
            <div class="wp-form-container" id="wp_custom_form">
                <h3>Submit your feedback</h3>
                <form class="wp-form" id="Wp_Form<?php echo($id_prefix); ?>" action="#" method="POST">
                    <div class="form-row">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="<?php echo($id_prefix); ?>_fname" minlength="2" value="<?php echo esc_html($fname) ;?>">
                    </div>
                    <div class="form-row">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="<?php echo($id_prefix); ?>_lname" minlength="2" value="<?php echo esc_html($lname) ;?>">
                    </div>
                    <div class="form-row">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="<?php echo($id_prefix); ?>_email" value="<?php echo esc_html($email) ;?>">
                    </div>
                    <div class="form-row">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="<?php echo($id_prefix); ?>_subject">
                    </div>
                    <div class="form-row">
                        <label for="message">Message</label>
                        <textarea name="message" id="<?php echo($id_prefix); ?>_message"></textarea>
                    </div>
                    <div class="form-row">
                        <input class="form_submit" type="submit" value="Send">
                    </div>
                    <div class="form-row" id="result_message">
                    </div>
                </form>
            </div>

        <?php

            return ob_get_clean();
        }
    }

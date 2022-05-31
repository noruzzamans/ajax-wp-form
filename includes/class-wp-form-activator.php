<?php

/**
 * Fired during plugin activation
 *
 * @link       https://profiles.wordpress.org/noruzzaman/
 * @since      1.0.0
 *
 * @package    Wp_Form
 * @subpackage Wp_Form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Form
 * @subpackage Wp_Form/includes
 * @author     Noruzzaman <noruzzamanrubel@gmail.com>
 */
class Wp_Form_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {

        $installer = new Form_installer();
        $installer->run();

    }

}

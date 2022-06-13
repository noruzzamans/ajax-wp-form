<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://profiles.wordpress.org/noruzzaman/
 * @since             1.0.0
 * @package           Wp_Form
 *
 * @wordpress-plugin
 * Plugin Name:       WP Form
 * Plugin URI:        https://github.com/noruzzamanrubel/wp-form
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Noruzzaman
 * Author URI:        https://profiles.wordpress.org/noruzzaman/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.

if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

/**
 * Plugin basic information.
 */
define( 'WP_FORM_VERSION', '1.0.0' );
define( 'WP_FORM_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_FORM_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_FORM_NAME', 'wp-form' );
define( 'WP_FORM_FULL_NAME', 'WP Form' );
define( 'WP_FORM_BASE_NAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-form-activator.php
 */
function activate_wp_form() {
    require_once WP_FORM_PATH . 'includes/class-wp-form-activator.php';
    Wp_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-form-deactivator.php
 */
function deactivate_wp_form() {
    require_once WP_FORM_PATH . 'includes/class-wp-form-deactivator.php';
    Wp_Form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_form' );
register_deactivation_hook( __FILE__, 'deactivate_wp_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require WP_FORM_PATH . 'includes/class-wp-form.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_form() {

    $plugin = new Wp_Form();
    $plugin->run();

}

run_wp_form();

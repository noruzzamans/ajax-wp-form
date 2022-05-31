<?php

class Form_installer {
    public function run() {
        $this->create_table();
    }

    public function create_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $schema          = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}wp_form` ( `id` INT(11) NOT NULL AUTO_INCREMENT ,
        `fname` VARCHAR(100) NOT NULL ,
        `lname` VARCHAR(100) NOT NULL ,
        `email` VARCHAR(50) NOT NULL ,
        `subject` VARCHAR(100) NOT NULL ,
        `message` VARCHAR(255) NOT NULL ,
        `created_by` BIGINT NOT NULL ,
        `created_at` DATETIME NOT NULL ,
        PRIMARY KEY (`id`)) $charset_collate";

        if ( ! function_exists( 'dbDelta' ) ) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta( $schema );

    }

}

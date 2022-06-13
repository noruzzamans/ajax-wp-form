<?php
class WP_Form_Data_Fetch {
    //Fetch data from database
    public function wp_form_data_fetch( $args = [] ) {

        global $wpdb;
        $defaults = [
            'number'  => 10,
            'offset'  => 0,
            'orderby' => 'id',
            'order'   => 'ASC',
        ];

        $args = wp_parse_args( $args, $defaults );

        $items = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}wp_form
            ORDER BY {$args['orderby']} {$args['order']}
                LIMIT %d, %d",
                $args['offset'],
                $args['number']
            )
        );
        return $items;

    }

    //Fetch data from database

    public function wp_form_data_count() {
        global $wpdb;
        $count = $wpdb->get_var(
            "SELECT COUNT(*) FROM {$wpdb->prefix}wp_form"
        );
        return $count;
    }
}

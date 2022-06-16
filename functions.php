<?php

//Fetch data from database
function wp_form_data_fetch( $args = [] ) {

    global $wpdb;
    $defaults = [
        'number'  => 10,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC',
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

function wp_form_data_count() {
    global $wpdb;
    $count = $wpdb->get_var(
        "SELECT COUNT(*) FROM {$wpdb->prefix}wp_form"
    );
    return $count;
}

//fetch single data from database by id
function wp_form_get_data_by_id( $id ) {
    global $wpdb;
    $item = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}wp_form WHERE id = %d",
            $id
        )
    );
    return $item;
}

// delete single data from database
function wp_form_delete_data( $id ) {
    global $wpdb;
    $wpdb->delete(
        $wpdb->prefix . 'wp_form',
        ['id' => $id],
        ['%d']
    );
}

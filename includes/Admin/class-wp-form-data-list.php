<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class WP_Form_data_list extends WP_List_Table {

    function __construct() {
        parent::__construct( [
            'singular' => 'contact',
            'plural'   => 'contacts',
            'ajax'     => false,
        ] );
    }

    /**
     * Get the column names
     *
     * @return array
     */
    public function get_columns() {
        return [
            'cb'         => '<input type="checkbox" />',
            'fname'      => __( 'First Name', 'wp-form' ),
            'lname'      => __( 'Last Name', 'wp-form' ),
            'email'      => __( 'Email', 'wp-form' ),
            'subject'    => __( 'Subject', 'wp-form' ),
            'message'    => __( 'Message', 'wp-form' ),
            'created_at' => __( 'Created At', 'wp-form' ),
        ];
    }

    /**
     * Message to show if no designation found
     *
     * @return void
     */
    function no_items() {
        _e( 'No contact information found', 'wp-form' );
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = [
            'fname'      => ['fname', true],
            'created_at' => ['created_at', true],
        ];

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'trash'  => __( 'Move to Trash', 'wp-form' ),
            'delete' => __( 'Delete Permanently', 'wp-form' ),
        );

        return $actions;
    }

    /**
     * Render the "name" column
     *
     * @param  object $item
     *
     * @return string
     */
    public function column_fname( $item ) {
        $actions = [];

        $actions['edit']   = sprintf( '<a href="%s" title="%s">%s</a>', admin_url( 'admin.php?page=wp-form&action=edit&id=' . $item->id ), $item->id, __( 'Edit', 'wp-form' ), __( 'Edit', 'wp-form' ) );
        $actions['delete'] = sprintf( '<a href="#" class="submitdelete" data-id="%s">%s</a>', $item->id, __( 'Delete', 'wp-form' ) );

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=wp-form&action=view&id' . $item->id ), $item->fname, $this->row_actions( $actions )
        );
    }

    /**
     * Render the "cb" column
     *
     * @param  object $item
     *
     * @return string
     */
    protected function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="form_id[]" value="%d" />', $item->id
        );
    }

    protected function column_default( $item, $column_name ) {

        switch ( $column_name ) {

            case 'created_at':
                return wp_date( get_option( 'date_format' ), strtotime( $item->created_at ) );

            default:
                return isset( $item->$column_name ) ? $item->$column_name : '';
        }

    }

    public function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$columns, $hidden, $sortable];

        $per_page     = 10;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'];
        }

        $this->items = wp_form_data_fetch( $args );

        // pagination
        $this->set_pagination_args( [
            'total_items' => wp_form_data_count(),
            'per_page'    => $per_page,
        ] );

        $search = isset( $_REQUEST['s'] ) ? $_REQUEST['s'] : '';

        if ( $search ) {
            $this->items = array_filter( $this->items, function ( $item ) use ( $search ) {
                return strpos( $item->fname, $search ) !== false || strpos( $item->lname, $search ) !== false || strpos( $item->email, $search ) !== false || strpos( $item->subject, $search ) !== false || strpos( $item->message, $search ) !== false;
            } );
        }

    }

}

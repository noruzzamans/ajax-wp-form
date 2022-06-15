<div class="wrap">
    <h1><?php _e( 'WP Form Feadback Details', 'wp-form' );?></h1>
    <form action=" " method="post">
        <?php
            $table = new WP_Form_Data_List();
            $table->prepare_items();
            $table->search_box( 'Search', 'search_id' );
            $table->display();
        ?>
    </form>
</div>
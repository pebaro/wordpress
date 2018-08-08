<?php
// ============================================
// =====> Adding Columns to Events Admin <=====
//
function our_events_columns( $columns ) {
    $columns = array(
        'cb'       	        => '<input type="checkbox" />',
        'title'    	        => __( 'Event' ),
        'dates'             => __( 'Start / Finish' ),
        'status'            => __( 'Status' ),
        'featured'          => __( 'Featured' ),
        'events_taxonomies' => __( 'Taxonomies' ),
        'date'     	        => __( 'Date' ),
        'administrator'     => __( 'Event Admin' )
    );
    return $columns;
}
add_filter( 'manage_our_events_posts_columns', 'our_events_columns' );


// =====================================================
// =====> Manage Columns Content for Events Admin <=====
//
function our_events_manage_columns( $column ) {

    global $post;
    global $wp_query;

    // pull in the ACF meta data
    require_once('events-get_post_meta.php')

    switch( $column ) {

        # Start / Finish
        case 'dates':
            if( $event_start == $event_end ){
                echo '<strong><small>Exhibition/Conf Date:</small></strong><br>';
                echo '<strong style="color:#862585;">' . $event_date . '</strong>';
            } else {
                echo '<strong><small>Exhibition/Conf Dates:</small></strong><br>';
                echo '<small>starts: </small><strong style="color:#862585;">' . $event_date . '</strong><br>';
                echo '<small>ends: </small><strong style="color:#862585;">' . $end_date . ' ' . $event_year . '</strong>';
            }
        break;

        # Event Status
        case 'status':
            if( $today < $check_event_start ){
                echo '<strong style="color:#256B86;">Future</strong>';
            } elseif ( ($today >= $check_event_start) && ($today <= $check_event_end) ){
                echo '<strong style="color:#862585;">Live!!!</strong>';
            } else {
                echo '<span style="color:#999;">Past</span>';
            }
        break;

        # Featured
        case 'featured':
            if( $featured != '' ){
                echo '<strong style="color:#862585;">Yes</strong>';
            } else {
                echo '<span style="color: #999;">No</span>';
            }
        break;

        # Taxonomies
        case 'events_taxonomies':

            $technologies   = get_the_terms( $post->ID, 'event_technologies' );
            $markets        = get_the_terms( $post->ID, 'event_markets' );
            $categories     = get_the_terms( $post->ID, 'event_categories' );


            if ( !empty( $technologies ) || !empty( $markets ) || !empty( $categories ) ) { ?>
                <span class="view-events-taxonomies" style="cursor: pointer; color: #b71a8b; text-decoration: underline;"><small><strong>View Taxonomies</strong></small></span>
                <script>
                    jQuery('.view-events-taxonomies').on('click', function(e){
                        jQuery(this).closest('td.events_taxonomies').find('div.events-taxonomies').slideToggle(500);
                        e.stoppropogation();
                    });
                </script><?php
            } ?>
            <div class="events-taxonomies" style="display:none;"><?php
                if ( !empty( $technologies ) ){
                    echo '<strong><small>Technologies</small></strong><br>';
                    $technologies_out = array();

                    foreach ( $technologies as $technology ){
                        $technologies_out[] = sprintf(
                            '<a href="%s">%s</a>',
                            esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'event_technologies' => $technology->slug ), 'edit.php' ) ),
                            esc_html( sanitize_term_field( 'name', $technology->name, $technology->term_id, 'event_technologies', 'display' ) )
                        );
                    }
                    echo join( ',<br>', $technologies_out ).'<br><br>';
                }
                if ( !empty( $markets ) ){
                    echo '<strong><small>Markets</small></strong><br>';

                    $markets_out = array();

                    foreach ( $markets as $market ){
                        $markets_out[] = sprintf(
                            '<a href="%s">%s</a>',
                            esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'event_markets' => $market->slug ), 'edit.php' ) ),
                            esc_html( sanitize_term_field( 'name', $market->name, $market->term_id, 'event_markets', 'display' ) )
                        );
                    }
                    echo join( ',<br>', $markets_out ).'<br><br>';
                }
                if ( !empty( $categories ) ){
                    echo '<strong><small>Categories</small></strong><br>';

                    $categories_out = array();

                    foreach ( $categories as $category ){
                        $categories_out[] = sprintf(
                            '<a href="%s">%s</a>',
                            esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'event_categories' => $category->slug ), 'edit.php' ) ),
                            esc_html( sanitize_term_field( 'name', $category->name, $category->term_id, 'event_categories', 'display' ) )
                        );
                    }
                    echo join( ',<br>', $categories_out ).'<br><br>';
                } ?>
            </div><?php
        break;

		# Event Administrator / Manager
		case 'administrator':
            echo the_author_meta('first_name');
            echo '&nbsp;';
            echo the_author_meta('last_name');
		break;

	}
}
add_action( 'manage_our_events_posts_custom_column', 'our_events_manage_columns', 10, 2 );

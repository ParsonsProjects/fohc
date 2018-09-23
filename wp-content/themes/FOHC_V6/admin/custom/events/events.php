<?php 

// Create posts 
add_action( 'init', 'create_post_type' );
function create_post_type() {

    $labels = array(
        'name' => __( 'Events' ),
        'singular_name' => __( 'Event' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add New Event' ),
        'edit' => __( 'Edit' ),
        'edit_item' => __( 'Edit Event' ),
        'new_item' => __( 'New Event' ),
        'view' => __( 'View Event' ),
        'view_item' => __( 'View Event' ),
        'search_items' => __( 'Search Events' ),
        'not_found' => __( 'No Events found' ),
        'not_found_in_trash' => __( 'No Events found in Trash' ),
        'parent' => __( 'Parent Event' )
    );

    register_post_type( 'events',
        array(
        'labels' => $labels,
        'public' => true,
        'capability_type' => 'post',
        'capabilities' => array(
            'edit_post'             => "edit_events",
            'read_post'             => "read_events",
            'delete_post'           => "delete_events",
            'edit_others_posts'     => "edit_others_events",
            'publish_posts'         => "publish_events",
            'read_private_posts'    => "read_private_events",
            'delete_private_posts'   => "delete_private_events",
            'delete_published_posts' => "delete_published_events",
            'delete_others_posts'    => "delete_others_events",
            'edit_private_posts'     => "edit_private_events",
            'edit_published_posts'   => "edit_published_events"
        ),
        'show_ui' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'taxonomies' => array( 'event_categories' ),
        'menu_icon' => get_bloginfo('template_directory') . '/admin/custom/events/images/menu.png',
        'supports' => array( 
                'title',
                'thumbnail',
                'comments',
                'editor'
            )
        )
    );

}

add_action( 'init', 'create_taxonomy' );

// Create taxonomy these link to the users teams 
function create_taxonomy( ) {

    $labels = array( 
        'name'                         => __( 'Categories', 'mstw-loc-domain' ),
        'singular_name'                =>  __( 'Category', 'mstw-loc-domain' ),
        'search_items'                 => __( 'Search Categories', 'mstw-loc-domain' ),
        'popular_items'                => __( 'Popular Categories', 'mstw-loc-domain' ),
        'all_items'                    => __( 'All Categories', 'mstw-loc-domain' ),
        'parent_item'                  => null,
        'parent_item_colon'            => null,
        'edit_item'                    => __( 'Edit Category', 'mstw-loc-domain' ), 
        'update_item'                  => __( 'Update Category', 'mstw-loc-domain' ),
        'add_new_item'                 => __( 'Add New Category', 'mstw-loc-domain' ),
        'new_item_name'                => __( 'New Category Name', 'mstw-loc-domain' ),
        'separate_items_with_commas'   => __( 'Separate Categories with commas', 'mstw-loc-domain' ),
        'add_or_remove_items'          => __( 'Add or Remove Categories', 'mstw-loc-domain' ),
        'choose_from_most_used'        => __( 'Choose from the most used Categories', 'mstw-loc-domain' ),
        'not_found'                    => __( 'No Categories found', 'mstw-loc-domain' ),
        'menu_name'                    => __( 'Categories', 'mstw-loc-domain' ),
    );
              
    $args = array( 
        'hierarchical'          => true, 
        'labels'                => $labels, 
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true, 
        'rewrite'               => true 
    );
        
    register_taxonomy( 'event_categories', 'events', $args );
            
}

// http://wp.smashingmagazine.com/2012/11/08/complete-guide-custom-post-types/
// Custom messages
function my_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['events'] = array(
        0 => '', 
        1 => sprintf( __('Event updated. <a href="%s">View event</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Event updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Event published. <a href="%s">View event</a>.'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Event saved.'),
        8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );

// http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types
// Add to admin_init function
add_filter( 'manage_edit-events_columns', 'my_edit_events_columns' ) ;

function my_edit_events_columns( $columns ) {

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'id' => __( 'ID' ),
        'title' => __( 'FOHC Event', 'column name' ),
        'author' => __( 'Author' ),
        'start_date' => __( 'Start Date' ),
        'attendance' => __( 'Attendance' ),
        'date' => __( 'Created' )
    );

    return $columns;
}

// Add to admin_init function
add_action( 'manage_events_posts_custom_column', 'my_manage_events_columns', 10, 2 );

function my_manage_events_columns( $column, $post_id ) {
    global $post;

    switch( $column ) {

        case 'id':

            echo $post_id;
            
        break;

        case 'start_date':

            $event_start_time = get_post_meta($post_id, '_event_start_time', true);

            echo date("d/m/Y", $event_start_time);
            
        break;

        /* If displaying the 'genre' column. */
        case 'teams' :

            /* Get the genres for the post. */
            $terms = get_the_terms( $post_id, 'teams' );

            /* If terms were found. */
            if ( !empty( $terms ) ) {

                $out = array();

                /* Loop through each term, linking to the 'edit posts' page for the specific term. */
                foreach ( $terms as $term ) {
                    $out[] = sprintf( '<a href="%s">%s</a>',
                        esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'teams' => $term->slug ), 'edit.php' ) ),
                        esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'teams', 'display' ) )
                    );
                }

                /* Join the terms, separating them with a comma. */
                echo join( ', ', $out );
            }

            /* If no terms were found, output a default message. */
            else {
                _e( 'No Teams' );
            }

        break;

        case 'attendance' :

            $post_meta              = get_post_meta($post_id, '_events_meta', true);
            $event_members          = get_post_meta($post_id, '_event_users', true);
            $total_count            = count($event_members);

            if(empty($event_members)) {

                _e( 'No Users Emailed' );

            } else {

                /* If terms were found. */
                if ( !empty( $post_meta ) ) {

                    $no_accepted = 0;
                    for ($row = 0; $row < 999; $row++) { // 999 number to go up to
                        if($post_meta[$row]["status"]=="accepted") {
                             $no_accepted++; 
                        }
                    }

                    _e( $no_accepted . ' out of ' . $total_count );

                }

                /* If no terms were found, output a default message. */
                else {
                    _e( '0 out of ' . $total_count );
                }

            }

        break;

        /* Just break out of the switch statement for everything else. */
        default :
        break;
    }
}

?>
<?php 

// Create posts 
add_action( 'init', 'create_report_type' );
function create_report_type() {

    $labels = array(
        'name' => __( 'Match Reports' ),
        'singular_name' => __( 'Team Event' ),
        'add_new' => __( 'Add New' ),
        'add_new_item' => __( 'Add Match Report Event' ),
        'edit' => __( 'Edit' ),
        'edit_item' => __( 'Edit Team Event' ),
        'new_item' => __( 'Match Report Event' ),
        'view' => __( 'View Team Event' ),
        'view_item' => __( 'View Team Event' ),
        'search_items' => __( 'Search Match Reports' ),
        'not_found' => __( 'No Match Reports found' ),
        'not_found_in_trash' => __( 'No Match Reports found in Trash' ),
        'parent' => __( 'Parent Team Event' )
    );

    register_post_type( 'match_report',
        array(
        'labels' => $labels,
        'public' => true,
        'capability_type' => 'page',
        'capabilities' => array(
            'edit_post'             => "edit_match_report",
            'read_post'             => "read_match_report",
            'delete_post'           => "delete_match_report",
            'edit_others_posts'     => "edit_others_match_report",
            'publish_posts'         => "publish_match_report",
            'read_private_posts'    => "read_private_match_report",
            'delete_private_posts'   => "delete_private_match_report",
            'delete_published_posts' => "delete_published_match_report",
            'delete_others_posts'    => "delete_others_match_report",
            'edit_private_posts'     => "edit_private_match_report",
            'edit_published_posts'   => "edit_published_match_report"
        ),
        'show_ui' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'taxonomies' => array( 'teams' ),
        'supports' => array( 
                'title',
                'thumbnail',
                'comments',
                'editor'
            )
        )
    );

}

add_action( 'init', 'create_report_taxonomy' );

// Create taxonomy these link to the users teams 
function create_report_taxonomy( ) {

    $labels = array( 
        'name'                         => __( 'Teams', 'mstw-loc-domain' ),
        'singular_name'                =>  __( 'Team', 'mstw-loc-domain' ),
        'search_items'                 => __( 'Search Teams', 'mstw-loc-domain' ),
        'popular_items'                => __( 'Popular Teams', 'mstw-loc-domain' ),
        'all_items'                    => __( 'All Teams', 'mstw-loc-domain' ),
        'parent_item'                  => null,
        'parent_item_colon'            => null,
        'edit_item'                    => __( 'Edit Team', 'mstw-loc-domain' ), 
        'update_item'                  => __( 'Update Team', 'mstw-loc-domain' ),
        'add_new_item'                 => __( 'Add Match Report', 'mstw-loc-domain' ),
        'new_item_name'                => __( 'Match Report Name', 'mstw-loc-domain' ),
        'separate_items_with_commas'   => __( 'Separate Teams with commas', 'mstw-loc-domain' ),
        'add_or_remove_items'          => __( 'Add or Remove Teams', 'mstw-loc-domain' ),
        'choose_from_most_used'        => __( 'Choose from the most used Teams', 'mstw-loc-domain' ),
        'not_found'                    => __( 'No Teams found', 'mstw-loc-domain' ),
        'menu_name'                    => __( 'Teams', 'mstw-loc-domain' ),
    );
              
    $args = array( 
        'hierarchical'          => true, 
        'labels'                => $labels, 
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true, 
        'rewrite'               => true 
    );
        
    register_taxonomy( 'teams', 'match_report', $args );
            
}

// http://wp.smashingmagazine.com/2012/11/08/complete-guide-custom-post-types/
// Custom messages
function report_updated_messages( $messages ) {
    global $post, $post_ID;
    $messages['product'] = array(
        0 => '', 
        1 => sprintf( __('Event updated. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Event updated.'),
        5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Event published. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
        7 => __('Event saved.'),
        8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
    return $messages;
}
add_filter( 'post_updated_messages', 'report_updated_messages' );

// http://justintadlock.com/archives/2011/06/27/custom-columns-for-custom-post-types
// Add to admin_init function
add_filter( 'manage_edit-match_report_columns', 'my_edit_match_report_columns' ) ;

function my_edit_match_report_columns( $columns ) {

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'id' => __( 'ID' ),
        'title' => __( 'FOHC Event', 'column name' ),
        'author' => __( 'Author' ),
        'teams' => __( 'Teams' ),
        'date' => __( 'Date' )
    );

    return $columns;
}

// Add to admin_init function
add_action( 'manage_match_report_posts_custom_column', 'my_manage_match_report_columns', 10, 2 );

function my_manage_match_report_columns( $column, $post_id ) {
    global $post;

    switch( $column ) {

        case 'id':

            echo $post_id;
            
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

        /* Just break out of the switch statement for everything else. */
        default :
        break;
    }
}

?>
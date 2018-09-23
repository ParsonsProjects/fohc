<?php 
// Run these functions once
function my_big_function() {
    static $result;

    // Function has already run
    if ($result !== NULL)
        return $result;

    // add_action( 'admin_init', 'add_theme_caps');
    // add_action( 'admin_init', 'add_new_roles');
    // add_action( 'admin_init', 'remove_old_roles');

    $result = TRUE;
    return $result;
}


// Remove Old Roles
function remove_old_roles(){

    $roles = array(
        "subscriber",
        "author",
        "contributor",
        "basic_editor",
        "mid_editor"
    );

    foreach ( $roles as $role ){
        remove_role( $role );
    }

}

// Add New Role
function add_new_roles(){

    //add new role
    add_role('member', 'Member', array(
        'read' => true
    ));

    add_role('captain', 'Captain', array(
        'read' => true
    ));

}

// Add capabilities to new and old roles
function add_theme_caps() {

    // gets the author role
    $captain = get_role( 'captain' );
    $administrator = get_role( 'administrator' );

    $caps = array(
        "edit_events",
        "read_events",
        "delete_events",
        "edit_others_events",
        "publish_events",
        "read_private_events",
        "delete_events",
        "delete_private_events",
        "delete_published_events",
        "delete_others_events",
        "edit_private_events",
        "edit_published_events",
        "edit_match_report",
        "read_match_report",
        "delete_match_report",
        "edit_others_match_report",
        "publish_match_report",
        "read_private_match_report",
        "delete_private_match_report",
        "delete_published_match_report",
        "delete_others_match_report",
        "edit_private_match_report",
        "edit_published_match_report"
    );

    $captain_caps = array(
        "edit_events",
        "read_events",
        "publish_events",
        "upload_files",
        "read_posts",
        "edit_posts",
        "edit_published_events"
    );

    foreach ( $captain_caps as $captain_cap ){
        $captain->add_cap( $captain_cap ); 
    }

    foreach ( $caps as $cap ){
        $administrator->add_cap( $cap ); 
    }

}

// Custom profile fields

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

    <h3>User Information</h3>

    <?php
    // get product categories
    $tags = get_terms('event_categories', array('hide_empty' => false));
    $user_tags = get_the_author_meta( '_user_teams', $user->ID );
    $user_position = get_the_author_meta( '_user_position', $user->ID );

    if (current_user_can( 'add_users' )){ 
    ?>
    <table class="form-table">
        <tr>
            <th>My Teams:</th>
            <td>
            <?php 
            if ( count( $tags ) ) {
                foreach( $tags as $tag ) { ?>
                <p><label for="_user_teams_<?php echo esc_attr( $tag->slug); ?>">
                    <input id="_user_teams_<?php echo esc_attr( $tag->slug); ?>"
                        name="_user_teams[<?php echo esc_attr( $tag->term_id ); ?>]"
                        type="checkbox"
                        value="<?php echo esc_attr( $tag->term_id ); ?>"
                        <?php  if(!empty($user_tags)) { if ( in_array( $tag->term_id, $user_tags ) ) echo ' checked="checked"'; } ?> />
                    <?php echo esc_html($tag->name); ?>
                </label></p><?php
                }
            } ?>
            </td>
        </tr>
    </table>
    <table class="form-table">
        <tr>
            <th>My Position:</th>
            <td>
            <input id="_user_position" name="_user_position" value="<?php if($user_position != '') { echo $user_position; } ?>" />
            </td>
        </tr>
    </table>
    <?php } else { ?>
    <table class="form-table">
        <tr>
            <th>My Teams:</th>
            <td>
            <?php

                if(!empty($user_tags)) {

                    foreach( $user_tags as $user_tag ) { 

                        $tag_name = get_term_by( 'id', $user_tag, 'event_categories' );

                        echo esc_html($tag_name->name);

                    }

                }

            ?>
            </td>
        </tr>
    </table>
    <table class="form-table">
        <tr>
            <th>My Position:</th>
            <td>
            <?php if($user_position != '') { echo $user_position; } ?>
            </td>
        </tr>
    </table>
    <?php } ?>

<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_user_meta( $user_id, '_user_teams', $_POST['_user_teams'] );
    update_user_meta( $user_id, '_user_position', $_POST['_user_position'] );
}
?>
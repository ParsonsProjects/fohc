<?php 


add_filter ("wp_mail_content_type", "mail_content_type");
function mail_content_type() {
    return "text/html";
}

/* BREAKING SITE

add_filter ("wp_mail_from", "mail_from");
function mail_from() {
    return "noreply@folkestone-optimists.co.uk";
}
    
add_filter ("wp_mail_from_name", "mail_from_name");
function mail_from_name() {
    return "Folkestone Optimist";
}
*/

// Get Filtered Content By ID
function the_content_by_id($post_id) {
    $page_data = get_page($post_id);
    if ( $page_data )
    return apply_filters('the_content',$page_data->post_content);
    return false;
}

// Ajax re-send email
add_action("wp_ajax_re_send_email", "re_send_email");
add_action("wp_ajax_nopriv_re_send_email", "my_must_login");

function re_send_email() {

    // Make sure submit is valid
    if ( !wp_verify_nonce( $_REQUEST['nonce'], "user_nonce")) {
        exit("No naughty business please");
    }  

    $post_id          = $_REQUEST["post_id"];
    $user_id          = $_REQUEST["user_id"];
    $email_type       = $_REQUEST["email_type"];
    $user             = get_userdata($user_id);

    if($email_type == 'single') {
        re_send_event_email($post_id, $user_id);
        $result['feedback']   = "Email Sent To " . $user->display_name;  
    } elseif ($email_type == 'all') {
        send_event_email($post_id);
        $result['feedback']   = "Email Sent To All";  
    }  elseif ($email_type == 'cancel') {
        cancel_event_email($post_id);
        $result['feedback']   = "Cancel Email Sent To All";  
    }

    $result['type']   = "success";  

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }

    die();

}

// Send email on post publish

function notify_post($post_id) {

    if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) && ( $_POST['post_type'] == 'events' ) ) {

        send_event_email($post_id);

    }

}

//add_action( 'publish_events', 'notify_post' );
//add_action( 'pre_post_update', 'notify_post' );

function send_event_email($post_id) {

    $post           = get_post($post_id);
    $email_subject  = "Folkestone Optimist: " . the_title_attribute();
    $post_meta      = get_post_meta($post_id, '_event_users', true);
    $args           = array(
                        'include'      => $post_meta,
                        'orderby'      => 'nicename',
                        'order'        => 'ASC',
                    ); 
    $team_members   = get_users($args);
    $author         = get_userdata($post->post_author);

    ob_start(); ?>

    <?php include_once(THEME_ADMIN . '/email/email_template.php'); ?>

    <?php

    $message = ob_get_contents();

    ob_end_clean();

    foreach ($team_members as $team_member) {

        $members_email = $team_member->user_email;

        wp_mail( $members_email, $email_subject, $message );

    }

}

function cancel_event_email($post_id) {

    $post           = get_post($post_id);
    $email_subject  = "Folkestone Optimist: " . the_title_attribute();
    $post_meta      = get_post_meta($post_id, '_event_users', true);
    $args           = array(
                        'include'      => $post_meta,
                        'orderby'      => 'nicename',
                        'order'        => 'ASC',
                    ); 
    $team_members   = get_users($args);
    $author         = get_userdata($post->post_author);

    ob_start(); ?>

    <?php include_once(THEME_ADMIN . '/email/email_template_cancel.php'); ?>

    <?php

    $message = ob_get_contents();

    ob_end_clean();

    foreach ($team_members as $team_member) {

        $members_email = $team_member->user_email;

        wp_mail( $members_email, $email_subject, $message );

    }

}

function re_send_event_email($post_id, $user_id) {

    $post           = get_post($post_id);
    $email_subject  = "Folkestone Optimist: " . the_title_attribute();
    $team_member    = get_userdata($user_id);
    $author         = get_userdata($post->post_author);

    ob_start(); ?>

    <?php include_once(THEME_ADMIN . '/email/email_template.php'); ?>

    <?php

    $message = ob_get_contents();

    ob_end_clean();

    $members_email = $team_member->user_email;

    wp_mail( $members_email, $email_subject, $message );

}

?>
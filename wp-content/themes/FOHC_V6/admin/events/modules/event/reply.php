<div id="event-status">

    <?php 

    // If time run out of time dont show buttons
    if($date_passed == '1'){

        $nonce          = wp_create_nonce("event_nonce"); // Nonce for submission validation
        $link_accept    = admin_url('admin-ajax.php?action=user_attendance&post_id='.$post_id.'&total_count='.$total_count.'&user_id='.$user_id.'&attendance=accepted&nonce='.$nonce);
        $link_decline   = admin_url('admin-ajax.php?action=user_attendance&post_id='.$post_id.'&total_count='.$total_count.'&user_id='.$user_id.'&attendance=declined&nonce='.$nonce);

    ?>

    <div class="declined-reason" style="display:none;">
        <div class="control-group">
            <label for="declined-reason-input">Please leave the reason you cannot attend below. Thank you.</label>
            <div class="controls">
                <textarea id="declined-reason-input"></textarea>
            </div>
            <div style="display:none;" class="alert alert-danger">Please leave a reason as to why you cannot attend.</div>
        </div>              
        <a id="declined-event-submit" class="user-attendance btn btn-success" data-total="<?php echo $total_count; ?>"data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post_id; ?>" data-user_id="<?php echo $user_id; ?>" data-attendance="declined" href="<?php echo esc_url($link_decline); ?>">Submit</a>
        <a href="" class="cancel">Cancel</a>
    </div>
    
    <div class="btns">
    <?php if($event_location == '') { ?>

        <a id="accept-event" class="user-attendance btn btn-success" data-total="<?php echo $total_count; ?>" data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post_id; ?>" data-user_id="<?php echo $user_id; ?>" data-attendance="accepted" href="<?php echo esc_url($link_accept); ?>">Accept</a>

    <?php } else { ?>

        <a id="meet-club" class="user-attendance btn btn-success" data-total="<?php echo $total_count; ?>" data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post_id; ?>" data-user_id="<?php echo $user_id; ?>" data-attendance="accepted" href="<?php echo esc_url($link_accept); ?>">Meet at Clubhouse</a>
        <a id="meet-away" class="user-attendance btn btn-success" data-total="<?php echo $total_count; ?>" data-nonce="<?php echo $nonce; ?>" data-post_id="<?php echo $post_id; ?>" data-user_id="<?php echo $user_id; ?>" data-attendance="accepted" href="<?php echo esc_url($link_accept); ?>">Meet at Opposition's Ground</a>
    
    <?php } // END if away match ?>

        <a id="decline-event" href="#">Decline</a>
    </div>

    <?php } else { ?>

        <div class="alert alert-info">Event has passed.</div>

    <?php } // END if pass event date ?>

</div>
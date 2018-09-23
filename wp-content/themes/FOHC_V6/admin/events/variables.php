<?php

    // Some vars
    $user_id                = get_current_user_id();
    $post_id                = $post->ID;
    $post_meta              = get_post_meta($post_id, '_events_meta', true);
    $post_meta_status       = ($post_meta != '') ? $post_meta[$user_id]["status"] : array();
    $meet_location          = ($post_meta != '') ? $post_meta[$user_id]["meet_location"] : '';

    // Post Meta
    $event_members          = get_post_meta($post_id, '_event_users', true);
    $event_location         = get_post_meta($post_id, '_event_address', true);
    $event_price            = get_post_meta($post_id, '_event_price', true);
    $event_show_directions  = get_post_meta($post_id, '_event_show_directions', true);
    $event_venue            = get_post_meta($post_id, '_event_venue', true);

    $event_start_time       = get_post_meta($post_id, '_event_start_time', true);
    $event_end_time         = get_post_meta($post_id, '_event_end_time', true);

    $event_organizer        = get_post_meta($post_id, '_event_organizer', true);
    $event_email            = get_post_meta($post_id, '_event_email', true);
    $event_phone            = get_post_meta($post_id, '_event_phone', true);

    $match                  = get_post_meta($post_id, '_event_match', true);
    $match_meet             = get_post_meta($post_id, '_event_match_meet', true);
    $match_pushback         = get_post_meta($post_id, '_event_match_pushback', true);
    $opposition             = get_post_meta($post_id, '_event_opposition', true);

    // Times
    $datdiff                = _date_diff($event_start_time, time());
    
    $years_remaining        = $datdiff['y']; // Year
    $months_remaining       = $datdiff['m']; // Month
    $days_remaining         = $datdiff['d']; // Days
    $hours_remaining        = $datdiff['h']; // Hours
    $minutes_remaining      = $datdiff['i']; // Minutes
    $seconds_remaining      = $datdiff['s']; // Seconds  
    $date_passed            = $datdiff['invert'];   
    $month                  = date("M", $event_start_time);
    $day                    = date("d", $event_start_time);  



    // Numbers
    $no_accepted = 0;
    $no_declined = 0;
    if($post_meta != ''){
        for ($row = 0; $row < 999; $row++) { // 999 number to go up to
            if($post_meta[$row]["status"]=="accepted") {
                 $no_accepted++; 
            }
        }
        for ($row = 0; $row < 999; $row++) { // 999 number to go up to
            if($post_meta[$row]["status"]=="declined") {
                 $no_declined++;
            }
        }
    }

    $total_count            = count($event_members);
    $inactive_count         = ($no_declined + $no_accepted) - $total_count;
    $inactive_count         = ($inactive_count < 0) ? (-$inactive_count) : $inactive_count; // Converts minus back to plus value


?>  
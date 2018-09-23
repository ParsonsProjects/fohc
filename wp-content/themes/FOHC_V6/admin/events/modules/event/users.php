<div class="users-invited">
    <h4>Invited Members</h4>
    <div class="total-count"><span class="heading">Total: </span><span class="count"><?php echo $total_count ?></span></div>
    <ul>
    <?php
    if($event_members != ''){
        foreach ($event_members as $event_member) {
            $user_info              = get_userdata($event_member);
            $user_id                = $user_info->ID;
            $post_meta_status       = ($post_meta != '') ? $post_meta[$user_id]["status"] : array();
            $declined_reason        = ($post_meta != '') ? $post_meta[$user_id]["declined_reason"] : '';
            $concat                 = wpu_concat_single();
        ?>
            <li id="user-<?php echo $user_id; ?>" class="<?php echo $post_meta_status; ?>">
                <?php echo "<a href=\"" . get_option('home') . "/members" . $concat . "uid=$user_info->ID\" title=\"$user_info->display_name\">$user_info->user_nicename</a>"; ?>
                <div class="user-avatar"><?php echo get_avatar( $user_id, 42 ); ?></div>
                <div class="user-details">
                    <div class="user-name"><?php echo $user_info->user_nicename; ?></div>
                    <div class="user-status">
                        <?php 
                            switch ($post_meta_status) {
                              case 'accepted':
                                echo esc_html('Accepted');
                                break;

                              case 'declined':
                                echo esc_html('Declined');
                                break;

                              default:
                                echo esc_html('No Response');
                                break;
                            }
                        ?>
                    </div>
                    <?php if($post_meta_status == 'declined'){ ?>
                    <div class="declined-reason">
                        <?php echo $declined_reason; ?>
                    </div>
                    <?php } // END if user declined ?>
                </div>
            </li>
        <?php

        } // END foreach

    } // END if users exist

    ?>
    </ul>

</div>
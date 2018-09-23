                        
                        <?php if(!empty($event_members) && in_array($user_id, $event_members)) { ?>
                        <div class="user-feedback alert alert-warning">

                            <?php require_once(MODULE_DIR. '/event/status.php');  ?>  

                            <?php if($event_location != '' && $meet_location != '' && $post_meta_status != 'declined') { 
                                require_once(MODULE_DIR. '/event/status-location.php');
                            } // END if user accepted ?>

                        </div>
                        <?php } ?>

                        <?php 
                        if($event_start_time != '') { 
                            require_once(MODULE_DIR. '/event/date.php');
                        } // END if event date is empty 
                        ?>

                        <div id="event-details">

                            <div class="inset">

                                <?php 

                                require_once(MODULE_DIR. '/event/venue.php');
                                require_once(MODULE_DIR. '/event/location.php');

                                if($match == 'on') { 
                                    require_once(MODULE_DIR. '/match/time.php');
                                } else { 
                                    require_once(MODULE_DIR. '/event/time.php');
                                    require_once(MODULE_DIR. '/event/time-end.php');
                                } // END if pushback exists 

                                if($event_price != '') { 
                                    require_once(MODULE_DIR. '/event/cost.php');  
                                }

                                if($event_organizer != '') { 
                                    require_once(MODULE_DIR. '/event/contact.php');  
                                }

                                if($opposition != '') { 
                                    require_once(MODULE_DIR. '/match/opposition.php');
                                } // END if opposition exists 

                                if($event_show_directions != '') { 
                                    require_once(MODULE_DIR. '/event/directions.php');
                                } // END if location exists 

                                if($date_passed == '1') { 
                                    require_once(MODULE_DIR. '/event/time-remaining.php');
                                } else {
                                    // echo 'Event Passed';
                                } // END if date has passed 

                                ?>

                            </div>

                        </div>

                        <?php if(!empty($event_members) && $total_count != '0') { 
                            require_once(MODULE_DIR. '/event/attendance.php');
                        } // END if members have been invited ?>
                        <div class="clearfix"></div>
                        <?php 

                        the_content();

                        if(!empty($event_members)) {

                            $args = array();

                            if (is_user_logged_in()) {
                                if(in_array($user_id, $event_members)){
                                    $args[] = array(
                                        'tab_name' => 'Reply',
                                        'tab_content' => MODULE_DIR. '/event/reply.php'
                                    );
                                }
                                if($match == 'on') {
                                    $args[] = array(
                                        'tab_name' => 'Line Up',
                                        'tab_content' => MODULE_DIR. '/match/users.php'
                                    );
                                } else {
                                    $args[] = array(
                                        'tab_name' => 'Invited Members',
                                        'tab_content' => MODULE_DIR. '/event/users.php'
                                    );
                                }
                            } else {
                                $args[] = array(
                                    'tab_name' => 'Log In',
                                    'tab_content' => MODULE_DIR. '/event/login.php'
                                );
                            }

                            $args[] = array(
                                'tab_name' => 'Comments',
                                'tab_content' => MODULE_DIR. '/event/comments.php'
                            );

                            require_once(MODULE_DIR. '/event/tabs.php');

                        } else {

                            require_once(MODULE_DIR. '/event/comments.php');

                        }
                        
                        ?>
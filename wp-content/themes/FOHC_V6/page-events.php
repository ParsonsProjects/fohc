<?php  
/*
Template Name: Events
*/
get_header();  ?>

                <div class="row">
                    <?php get_sidebar('events'); ?>
                    <div class="column grid_9">

                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content(); ?>
                        <?php endwhile; wp_reset_query(); ?> 

                        <?php

                            $events = array(); // Create events array

                            $temp = $wp_query;
                            $wp_query= null;
                            $wp_query = new WP_Query();
                            $wp_query->query('post_type=events&showposts=999&meta_key=_event_start_time&orderby=meta_value&meta_compare=>=&meta_value=' . time() . '&order=ASC');
                            // The Loop
                            while ($wp_query->have_posts()) : $wp_query->the_post(); 

                                $event = array(); // Create event array

                                $post_id                = get_the_ID();
                                $category               = get_the_category($post_id);
                                $event_start_time       = get_post_meta($post_id, '_event_start_time', true);
                                $event_end_time         = get_post_meta($post_id, '_event_end_time', true);
                                $event_colour           = get_post_meta($post_id, '_event_colour', true);
                                $event_all_day          = get_post_meta($post_id, '_event_all_day', true);
                                $hide_calendar          = get_post_meta($post_id, '_event_hide_calendar', true);

                                $recurring              = get_post_meta($post_id, '_event_recurring', true);
                                $recurring_type         = get_post_meta($post_id, '_event_recurring_type', true);
                                $recurring_end          = get_post_meta($post_id, '_event_recurring_end', true);

                                if($recurring != '') {

                                    switch ($recurring_type) {
                                        case 'day':
                                            $recurring_count = 1;
                                        break;

                                        case 'week':
                                            $recurring_count = 7;
                                        break;

                                        case 'month':
                                            $recurring_count = 12;
                                        break;

                                        case 'year':
                                            $recurring_count = 365;
                                        break;

                                        default:
                                            $recurring_count = 0;
                                        break;
                                    }

                                    if($recurring_end != '') {

                                        $cdate = strtotime($recurring_end);
                                        $today = time();
                                        $difference = $cdate - $today;
                                        

                                    } else {

                                        $difference = 999999999;

                                    }

                                    $recurring_no = $difference / $recurring_count;
                                    if ($recurring_no < 0) { $recurring_no = 0; }

                                    $row_end = floor($recurring_no/60/60/24);

                                } else {

                                    $row_end = 1;

                                }

                                if($hide_calendar == '') {

                                    $event_start_time = $event_start_time;

                                    for ($row = 0; $row < $row_end; $row++) { // 999 number to go up to                          

                                        $event['id'] = $post_id;
                                        $event['title'] = get_the_title();
                                        
                                        if($event_all_day == '') {
                                            $event['start']     = $event_start_time;
                                            $event['end']       = $event_end_time;
                                            $event['allDay']    = false;
                                        } else {
                                            $event['start']     = $event_start_time;
                                            $event['allDay']    = true;
                                        } // END if all day event

                                        if($event_colour != '#') {
                                            $event['color'] = $event_colour;
                                        } else {
                                            $event['color'] = '#205CAC';
                                        }// Add category colour

                                        $event['url'] = get_permalink();

                                        $events[] = $event; // Add event to events array

                                        $event_start_time = strtotime('+1 ' . $recurring_type, $event_start_time);
                                        $event_end_time = strtotime('+1 ' . $recurring_type, $event_end_time);

                                    }

                                } // END if added to calendar                                
                            
                            endwhile;
                            $wp_query = null; $wp_query = $temp;
                                
                            $all_events = json_encode($events); // Return all the events

                            // print_r(strtotime('+1 day', $event_start_time));

                        ?>

                        <script>

                            jQuery(document).ready(function($) {

                                $('#full-calendar').fullCalendar({

                                    header: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: 'month,agendaWeek,agendaDay'
                                    },

                                    editable: false,
                                    
                                    events: <?php echo $all_events ?>,
                                    
                                });
                                
                            });

                        </script>

                        <div id='full-calendar'></div>
                        
                    </div>
                </div>

                <aside id="sponsors">
                    <div class="row" style="text-align: center;">
	                    <div class="column grid_1" style="min-height: 1px;"></div>
	                    <div class="column grid_10">
                        <img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/themes/FOHC_V4/images/logos/logo_01_big.GIF">
                        <img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/uploads/2017/09/Beresfords.png" style="width: 233px; margin: 15px 10px;">
                        <img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/uploads/2015/06/technical.png" style="width: 182px; margin: 6px 10px;">
                        <img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/uploads/2017/09/Cook-fabrications.png" style="width: 243px; margin: 15px 10px;">
                        <img style="height:85px;" alt="" src="http://www.folkestone-optimists.co.uk/wp-content/uploads/2015/06/arcus.png">
                        <img src="http://www.folkestone-optimists.co.uk/wp-content/uploads/2017/09/Screen-Shot-2017-07-15-at-14.25.28.png" style="width: 200px;">
                        <img style="height:85px;margin: 0 20px;" alt="" src="http://www.folkestone-optimists.co.uk/wp-content/uploads/2017/09/Screen-Shot-2017-07-12-at-13.30.52.png">
                      <img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/uploads/2015/06/Rainbow-Logo-and-Details.png" style="width: 134px;"></div>
	                    <div class="column grid_1" style="min-height: 1px;"></div>
	                </div>
                </aside>


<?php  get_footer(); ?>
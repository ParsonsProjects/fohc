				
                <aside class="column grid_3">
                    <section class="widget" id="calendar">
                        <div class="widget-title">Upcoming Dates</div>
                        <ul>
                            <?php
                            $temp = $wp_query;
                            $wp_query= null;
                            $wp_query = new WP_Query();
                            $wp_query->query('post_type=events&showposts=8&meta_key=_event_start_time&orderby=meta_value&meta_compare=>=&meta_value=' . time() . '&order=ASC');
                            // The Loop
                            while ($wp_query->have_posts()) : $wp_query->the_post(); 
                            $event_start_time = get_post_meta($post->ID, '_event_start_time', true); 
                            $hide_calendar = get_post_meta($post->ID, '_event_hide_calendar', true);
                            $event_colour = get_post_meta($post_id, '_event_colour', true);
                            $datdiff = _date_diff($event_start_time, time());
                            $date_passed = $datdiff['invert'];   

                            if($hide_calendar == '' || $date_passed != '1') {?>
                            <li>
                                <a <?php if($event_colour != '') { ?>style="border-top-color:<?php echo $event_colour; ?>"<?php } ?> href="<?php the_permalink(); ?>"><span class="title"><?php the_title(); ?></span> <span class="date"><?php echo date("M / d", $event_start_time);?></span></a>
                            </li> 
                            <?php }
                            endwhile; ?>
                            <?php $wp_query = null; $wp_query = $temp;?>
                        </ul>
                    </section>
                </aside>
               
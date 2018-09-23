				<aside class="column grid_3">
                    <section id="quick-overview">
                        <div class="tabs">
                            <ul class="tabs-nav clearfix">
                                <li class="active"><a href="#weekend-results" title=""><span>Weekend Results</span></a></li>
                                <li><a href="#tab02" title=""><span>Weekend Matches</span></a></li>
                                <li><a href="#tab03" title=""><span>Training Times</span></a></li>
                            </ul>
                            <div class="tabs-content">
                                <?php include('sidebar-results.php'); ?>
                                <?php include('sidebar-matches.php'); ?>
                                <?php include('sidebar-training.php'); ?>
                            </div>
                        </div>
                    </section>
                    <section class="widget" id="downloads">
                        <div class="widget-title">Downloads</div>
                        <?php sceletus_downloads(); ?>
                    </section>
                    <section class="widget" id="calendar">
                        <div class="widget-title">Upcoming Dates</div>
                        <ul>
                            <?php
                            $temp = $wp_query;
                            $wp_query= null;
                            $wp_query = new WP_Query();
                            $wp_query->query('post_type=events&showposts=5&meta_key=_event_start_time&orderby=meta_value&meta_compare=>=&meta_value=' . time() . '&order=ASC');
                            // The Loop
                            while ($wp_query->have_posts()) : $wp_query->the_post(); 
                            $event_start_time = get_post_meta($post->ID, '_event_start_time', true); 
                            $hide_calendar = get_post_meta($post->ID, '_event_hide_calendar', true);
                            $event_colour = get_post_meta($post_id, '_event_colour', true);

                            if($hide_calendar == '') {?>
                            <li>
                                <a <?php if($event_colour != '') { ?>style="border-top-color:<?php echo $event_colour; ?>"<?php } ?> href="<?php the_permalink(); ?>"><span class="title"><?php the_title(); ?></span> <span class="date"><?php echo date("M / d", $event_start_time);?></span></a>
                            </li> 
                            <?php }
                            endwhile; ?>
                            <?php $wp_query = null; $wp_query = $temp;?>
				        </ul>
				        <a class="btn" href="<?php echo get_option('home'); ?>/calendar" title="View Calendar"><span>View Calendar</span></a>
                    </section>
                    <section class="widget" id="facebook-feed">
                        <div class="widget-title">Facebook</div>
                        <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Ffolkestoneoptimist%2F&amp;width=292&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=123088881125717" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:258px;" allowTransparency="true"></iframe>

                    </section>
                </aside>
                <aside class="column grid_2">
                    <section class="widget" id="quick-jumps">
                        <a class="btn" href="<?php echo get_option('home'); ?>/contact" title="Get Directions"><span>Get Directions</span></a>
                        <a class="btn" href="http://www.grayshockeyshop.co.uk/FolkestoneOptimistHC/_CSmain.aspx?" target="_blank" title="Club Kit"><span>Club Kit</span></a>
                        <!-- <a class="btn" href="#club-newsletter" title="Club Newsletter" data-toggle="modal"><span>Club Newsletter</span></a> -->
                        <a class="btn" href="<?php echo get_option('home'); ?>/reports" title="Match Reports"><span>Match Reports</span></a>
                        <a class="btn btn-green" href="<?php echo get_option('home'); ?>/join" title="Join FOHC"><span>Join FOHC</span></a>
                    </section>
                    <section class="widget" id="fohc-news">
                        <div class="widget-title"><a href="<?php echo get_option('home'); ?>/news" title="News">FOHC News</a></div>

                        <?php
                        $args = array( 'posts_per_page' => 3 );
                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <article id="post-<?php the_ID(); ?>">
                            <header class="article-heading">
                                <h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                            </header>
                            <section class="article-body">
                                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo excerpt(20); ?></a>
                            </section>
                            <footer class="article-footer">
                                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="date"><?php the_date(); ?></a>
                            </footer>
                        </article> 
                        <?php endwhile; 
                        wp_reset_postdata(); ?>


                    </section>
                    <section class="widget" id="twitter-feed">
                        <div class="widget-title">Latest Tweets</div>
                        <a class="twitter-timeline" height="50" data-chrome="transparent noborders noheader nofooter" data-tweet-limit="2" href="https://twitter.com/FolkestoneOpsHC"  data-widget-id="378148190530174976">Tweets by @FolkestoneOpsHC</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </section>
                    <section class="widget" id="fohc-affiliate">
                        <img alt="" style="width: 50%; margin: 10px auto 0;" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logos/logo_clubmark_2016.gif">
                        <img alt="" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logos/logo_clubfirst.gif">
                        <a title="Teamer" target="_blank" href="http://teamer.net/"><img alt="" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logos/logo_teamer.gif"></a>
                    </section>
                </aside>
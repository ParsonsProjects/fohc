<?php 

get_header();  

define('EVENTS_DIR', THEME_DIR . '/admin/events');
define('MODULE_DIR', THEME_DIR . '/admin/events/modules');

require_once(EVENTS_DIR. '/variables.php');

?>

            <div class="row">
                <div class="column grid_7">
                    <section>
                        <?php

                        // The Loop
                        while ( have_posts() ) : the_post(); ?>

                        <a class="pull-right btn" href="<?php echo get_option('home'); ?>/calendar" title="Back to Calendar">Back to Calendar</a><h1><?php the_title(); ?></h1>

                        <small class="post-meta"><?php edit_post_link(__('Edit'), ''); ?></small>

                        <?php require_once(EVENTS_DIR . '/event.php');  ?>               

                    <?php endwhile; ?>                     
                    
                </section>
                </div>
                <?php get_sidebar(); ?>
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
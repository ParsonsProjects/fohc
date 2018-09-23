<?php
/*
Template Name: User Profile
*/
if (!is_user_logged_in()) { auth_redirect(); }
?>
<?php get_header();?>

<?php

?>
                <div class="row">
                    <div class="column grid_7">
                        <section>
                           <?php

                           // The Loop
                           while ( have_posts() ) : the_post(); ?>

                           <?php the_content(); ?>
                           <?php wpu_get_users(); ?>
                           <?php endwhile;

                           // Reset Query
                           wp_reset_query();
                       
                           ?> 

                       </section>
                   </div>
                   <?php  get_sidebar(); ?>
                </div>

                <aside id="sponsors">
                    <div class="row">
                        <div class="column grid_2"><img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/themes/FOHC_V4/images/logos/logo_01_big.GIF"></div>
                        <div class="column grid_2"><img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/themes/FOHC_V4/images/logos/logo_02_big.gif"></div>
                        <div class="column grid_2"><img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/themes/FOHC_V4/images/logos/logo_03_big.gif"></div>
                        <div class="column grid_2"><img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/themes/FOHC_V4/images/logos/logo_04_big.gif"></div>
                        <div class="column grid_2"><img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/themes/FOHC_V4/images/logos/logo_05_big.gif"></div>
                        <div class="column grid_2"><img alt="" src="http://www.folkestone-optimists.co.uk/wp-content/themes/FOHC_V4/images/logos/logo_06_big.gif"></div>
                    </div>
                </aside>

<?php get_footer(); ?>

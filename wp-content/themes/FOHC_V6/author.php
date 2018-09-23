<?php  get_header();  ?>

            <div class="row">
                <div class="column grid_7">
                    <section>
                         <?php
                          // The Loop
                          while ( have_posts() ) : the_post(); ?>
                              <h1><?php the_title(); ?></h1>
                              <small><?php the_date(); ?> <?php edit_post_link(__('Edit'), ''); ?></small>
                              <?php the_content(); ?>
                          <?php endwhile; ?> 
                          <div id="comments_wrapper"><?php comments_template(); ?></div>
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


<?php  get_footer(); ?>
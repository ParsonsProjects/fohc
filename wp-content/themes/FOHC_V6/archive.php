<?php  get_header();  ?>

            <div class="row">
                <div class="column grid_7">
                    <section>
                        <?php
                        $termname = $wp_query->queried_object->name;
                        $termdesc = $wp_query->queried_object->description;
                        ?>

                        <?php if ( have_posts() ) the_post();?>

                        <h1 class="page-title">
                            <?php if ( is_day() ) : ?>
                            <?php printf( __( 'Daily Archives: <span>%s</span>' ), get_the_date() ); ?>
                            <?php elseif ( is_month() ) : ?>
                            <?php printf( __( 'Monthly Archives: <span>%s</span>' ), get_the_date('F Y') ); ?>
                            <?php elseif ( is_year() ) : ?>
                            <?php printf( __( 'Yearly Archives: <span>%s</span>' ), get_the_date('Y') ); ?>
                            <?php else : ?>
                            Archive for: <?php echo $termname ?>

                        </h1>
                        <?php echo $termdesc ?>
                        <?php endif; ?>
                        <?php rewind_posts();?>


                        <?php if (have_posts()) : ?>
                          <?php while(have_posts()) : the_post(); ?>
                          <ul>
                           <li>
                            <?php the_time('d/m/y') ?>
                            : <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a></li>
                        </ul>

                        <?php endwhile; ?>
                        <?php else : ?>
                          <p>No results for <?php echo $termname ?></p>
                        <?php endif; ?>
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
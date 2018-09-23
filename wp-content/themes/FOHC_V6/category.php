<?php  get_header();  ?>

            <div class="row">
                <div class="column grid_7">
                    <section>
                        <h1 class="page-title">
                          <?php single_cat_title( 'Category Archives:', true );?>
                        </h1>
                        <?php while(have_posts()) : the_post(); ?>
                        <ul>
                          <li>
                            <?php the_time('d/m/y') ?>
                            : <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                            </a></li>
                        </ul>
                        <?php endwhile; ?>
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
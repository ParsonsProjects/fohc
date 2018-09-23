<?php  
/*
Template Name: Reports
*/
get_header();  ?>

                <div class="row">
                    <div class="column grid_7">
                        <div class="list">
                          <?php
                          $temp = $wp_query;
                          $wp_query= null;
                          $wp_query = new WP_Query();
                          $wp_query->query('post_type=match_report&showposts=5'.'&paged='.$paged);
                          $big = 999999999; // need an unlikely integer
                          // The Loop
                          while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                              <article id="post-<?php the_ID(); ?>">
                                <header class="article-heading">
                                    <h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="date"><?php the_date(); ?></a>
                                </header>
                                <section class="article-body">
                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo excerpt(200); ?></a>
                                </section>
                                <footer class="article-footer">
                                    <a class="btn" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">View</a>
                                </footer>
                              </article> 
                          <?php endwhile; ?>
                          <div class="navigation clearfix">
                          <?php echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $wp_query->max_num_pages
                          ) ); ?>
                          </div>
                          <?php $wp_query = null; $wp_query = $temp;?>
                        </div>
                   </div>
                   <?php  get_sidebar(); ?>
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
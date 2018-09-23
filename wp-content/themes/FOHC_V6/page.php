<?php  get_header();  ?>

                <div class="row">
                    <div class="column grid_7">
                        <?php if(is_home() || is_front_page() ) { ?>
                        <div id="primary-banner" class="slideshow">
                          <?php $banner_slides = get_option('slides_v4');
                          foreach($banner_slides as $num => $item) :

                          // retrieve the thumbnail size of our image
                          $src = wp_get_attachment_url($item['id'], 'full' );
                          $img_src = aq_resize( $src, 670, 350, true );?>

                              <div class="item">
                                  <?php if ($item['caption'] != '') { ?><span class="caption"><?php echo $item['caption']; ?></span><?php } ?><img src="<?php echo $img_src ?>" alt="" title="<?php echo $item['caption']; ?>" />
                              </div>

                          <?php endforeach; ?>
                        </div>
                        <div class="row">
                            <div id="primary-jumps" class="clearfix">
                              <div class="column grid_4">
                                <a class="btn" href="<?php echo get_option('home'); ?>/mens-section" title="Mens Info"><span>Mens Info</span></a>
                                <a class="btn" href="<?php echo get_option('home'); ?>/ladies-section" title="Ladies Info"><span>Ladies Info</span></a>
                              </div>
                              <div class="column grid_3">
                                <a class="btn" href="<?php echo get_option('home'); ?>/juniors" title="Juniors Info"><span>Juniors Info</span></a>
                                <a class="btn btn-green" href="<?php echo get_option('home'); ?>/join" title="Join FOHC"><span>Join FOHC</span></a>
                              </div>
                            </div>
                        </div>
                        <?php } ?>
                        <section <?php if(is_home() || is_front_page() ) { ?>id="home-page"<?php } ?>>
                           <?php
                           // The Loop
                           while ( have_posts() ) : the_post(); ?>
                           <h1><?php the_title(); ?></h1>
                           <small><?php the_modified_date(); ?></small>
                           <?php the_content(); ?>
                           <?php endwhile;

                                          // Reset Query
                           wp_reset_query();
                           ?>

                       </section>
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

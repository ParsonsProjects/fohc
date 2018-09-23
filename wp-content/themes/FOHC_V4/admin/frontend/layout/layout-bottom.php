<?php function global_layout_bottom($args) {
	
		extract($args); ?>

				<?php if ($pagination == '1') {
                if (function_exists('bones_page_navi')) { ?>
                    <?php bones_page_navi(); ?>
                <?php } else { ?>
                    <nav class="wp-prev-next">
                        <ul class="clearfix">
                            <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "bonestheme")) ?></li>
                            <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "bonestheme")) ?></li>
                        </ul>
                    </nav>
                <?php } 
				} ?>          
                
                <?php if ($social_position == 'bottom' || $social_position == 'both') {
					if($social_show != '1' || $social_exlude == '1') ; else if ($social_show == '1') echo bones_social($social_size, $social_share['facebook'], $social_share['twitter'], $social_share['email'], $social_share['gplus'], $social_share['addthis'], $social_share['counter']);
				} ?>
                
                <div class="clear"></div>
                
				<?php
				
				// comments form
				if($comments_form == '1' && is_single()) : comments_template(); endif;
				
				?>
                
            	<div class="clear"></div>	
		                
                <!-- end wordpress loop -->
	
				</section>
	
				<?php if($site_layout == 'right_sidebar' || $site_layout == 'two_sidebars') { ?>
                <!-- start sidebar -->
                <aside id="sidebar" class="span3">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar2')){ } else { echo 'No widgets activated'; } ?>
                </aside>
                <!-- end sidebar -->
                <?php } ?>
    			
                </div>
                
    		</div>
            <!-- end container -->
            
<?php } ?>
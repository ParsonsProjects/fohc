<?php function global_layout_top($args) {
	
		extract($args); ?>
            
            <!-- start container -->
            <div class="container">
            	
                
            	<div id="page-info">
					<?php if($breadcrumbs == 1) { the_breadcrumb(); } ?>
                </div>
        		
                <div class="row-fluid">
                
                <?php if($site_layout == 'two_sidebars' || $site_layout == 'left_sidebar') { ?>
                <!-- start sidebar -->
                <aside id="sidebar" class="span3">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar1')){ } else { echo 'No widgets activated'; } ?>
                </aside>
                <!-- end sidebar -->
                <?php } ?>
                
                <section id="content" class="<?php if ( $site_layout == 'two_sidebars' ): echo 'span6'; else: echo 'span9'; endif; ?>">
				
                <?php if ( is_front_page() && of_get_option('banner_layout', 'custom' ) == 'right-col-banner' ){ require_once(get_template_directory().'/home-banner.php'); } ?>
            	
                <?php if (is_category()) { ?>
                    <h1 class="archive-title h2">
                        <span><?php _e("Posts Categorized:", "bonestheme"); ?></span> <?php single_cat_title(); ?>
                    </h1>
                
                <?php } elseif (is_tag()) { ?> 
                    <h1 class="archive-title h2">
                        <span><?php _e("Posts Tagged:", "bonestheme"); ?></span> <?php single_tag_title(); ?>
                    </h1>
                
                <?php } elseif (is_author()) { 
                    global $post;
                    $author_id = $post->post_author;
                ?>
                    <h1 class="archive-title h2">
                        <span><?php _e("Posts By:", "bonestheme"); ?></span> <?php echo get_the_author_meta('display_name', $author_id); ?>
                    </h1>
                <?php } elseif (is_day()) { ?>
                    <h1 class="archive-title h2">
                        <span><?php _e("Daily Archives:", "bonestheme"); ?></span> <?php the_time('l, F j, Y'); ?>
                    </h1>
        
                <?php } elseif (is_month()) { ?>
                    <h1 class="archive-title h2">
                        <span><?php _e("Monthly Archives:", "bonestheme"); ?></span> <?php the_time('F Y'); ?>
                    </h1>
            
                <?php } elseif (is_year()) { ?>
                    <h1 class="archive-title h2">
                        <span><?php _e("Yearly Archives:", "bonestheme"); ?></span> <?php the_time('Y'); ?>
                    </h1>
                
                <?php } elseif (is_search()) { ?>
                    <h1 class="archive-title"><span>Search Results for:</span> <?php echo esc_attr(get_search_query()); ?></h1>
                <?php } ?>
                
                <?php if ($social_position == 'top' || $social_position == 'both') {
					if($social_show != '1' || $social_exlude == '1') ; else if ($social_show == '1') echo bones_social($social_size, $social_share['facebook'], $social_share['twitter'], $social_share['email'], $social_share['gplus'], $social_share['addthis'], $social_share['counter']);
				} ?>
                
<?php } ?>

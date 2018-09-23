<?php

function bones_global_loop($args) {
	
	extract($args);
	
	global $previous_IDs;
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	
	if ($loop_type == 'custom') {
	
		$terms = array(	'cat' => get_cat_id($category),
						'tag' => $tag,
						'orderby' => $sort,
						'paged' => $paged,
						'post_type' => $custom_post,
						'match-report' => $match_report,
						'posts_per_page' => $number_of_posts,
						'ignore_sticky_posts' => 1,
						'post__not_in' => get_option('sticky_posts')
						);
		
		$wp_query = new WP_Query($terms);
	
	} elseif ($loop_type == 'related') {
	
		$tags = wp_get_post_tags($previous_IDs[0]);
		
		if ($tags) {
			$first_tag = $tags[0]->term_id;
			
			$terms = array(	'tag__in' => $first_tag,
							'post__not_in' => $previous_IDs,
							'posts_per_page'=> $number_of_posts,
							'ignore_sticky_posts' => 1);
							
		}
		
		$wp_query = new WP_Query($terms);

	}
	
	if ($thumb_width == ''){
		$thumb_width = '200';
	}
	
	if ($thumb_height == ''){
		$thumb_height = '200';
	}
	
	if ($order != ''){
		$order = $order;
	} else {
		$order = array(
			'title' => 'Title',
			'social_share_top' => 'Social Share Top',
			'social_share' => 'Social Share',
			'text' => 'Text',
			'read_more' => 'Read More',
			'social_share_bottom' => 'Social Share Bottom',
			'meta' => 'Meta'
		);	
	}
			
	// start wordpress loop
	if ((($loop_type == 'custom' || $loop_type == 'related') && $wp_query->have_posts()) || ($loop_type == 'default' && have_posts())) {
		
	if (($social_position == 'top' || $social_position == 'both') && (is_search() || is_archive())) {
		if($social_show != '1' || $social_exlude == '1') ; else if ($social_show == '1') echo bones_social(social_size($social_size,$social_listing_size), $social_share['facebook'], $social_share['twitter'], $social_share['email'], $social_share['gplus'], $social_share['addthis'], $social_share['counter']);
	} 	
			
	echo $html_before;
	
		$count = 0;
	
		while ((($loop_type == 'custom' || $loop_type == 'related') && $wp_query && $wp_query->have_posts()) || ($loop_type == 'default' && have_posts())) {
		
			if ($loop_type == 'custom' || $loop_type == 'related') $wp_query->the_post(); else the_post();
			
			$previous_IDs[] = get_the_ID();
		
			switch ($post_type) {
				
				// standard loop type
				case 'standard': 
								
				$count++; ?>                
                
					<article id="post-<?php the_ID(); ?>" <?php post_class('list-item clearfix'); ?> role="article" itemscope itemtype="">
                    	
                        <?php
												
						foreach ($order as $key => $option){
							
							$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));
							
							if($option == 'title'){
								echo '
								<header class="article-header">
									<h3 class="entry-title list-title" itemprop="headline"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>
								</header> <!-- end article header -->			
								'; 
							}
							if($option == 'text'){
								echo '<section class="entry-content clearfix" itemprop="articleBody">';
									if($thumb == '' || $thumb == '1'){ 
									echo '<div class="thumb">';
									
										$img_id = get_post_meta( get_the_ID(), 'theme_metabox_thumbnail', true );
										$video_type = get_post_meta( get_the_ID(), 'theme_metabox_video_type', true );
										$clip_id = get_post_meta( get_the_ID(), 'theme_metabox_clip_id', true );
										if ( $img_id ) : 
											
											$src = wp_get_attachment_url( $img_id, 'full' );
											$img_src = aq_resize( $src, $thumb_height, $thumb_height, true );
										
										echo '<a href="'. get_permalink() .'" rel="bookmark" title="'. get_the_title() .'"> <img class="thumb" src="'. $img_src .'" alt="'. get_the_title() .'" /> </a>';
										
										elseif ( $clip_id ): 
												echo '<div class="post-video">';
												if ($video_type=='youtube') {
													echo '<iframe src="http://www.youtube.com/embed/'.$clip_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
												} elseif($video_type == 'vimeo') {
													echo ' <iframe src="http://player.vimeo.com/video/'.$clip_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
												} elseif($video_type == 'daily') {
													echo '<iframe frameborder="0" src="http://www.dailymotion.com/embed/video/'.$clip_id.'?logo=0"></iframe>';
												} 							
												echo'</div>';
										endif; 
									
									echo '</div>';
									}
									if ($excerpt != '1') ; else if ($excerpt == '1') echo '<p class="excerpt">' . bones_excerpt($excerpt_length, false) . '</p>';
									if ($read_more == '1') echo '<a class="action" href="' . get_permalink() . '" title="' . get_the_title() . '">' . $read_more_text . '</a>';
								echo '</section> <!-- end article section -->';
							}
							if($option == 'social_share'){
                            	if ($social_show != '1') ; else echo bones_social($social_size, $social_share['facebook'], $social_share['twitter'], $social_share['email'], $social_share['gplus'], $social_share['addthis'], $social_share['counter']);
							}				
							if($option == 'meta'){
								echo '<footer class="article-footer">';
								echo bones_meta($meta['date'], $meta['author'], $meta['category'], $meta['comments']); 
								echo '</footer> <!-- end article footer -->';
							}		
							
						}						
						?>
                        
                    </article> <!-- end article -->
				                   
				<?php break;
				
				// single post type
				case 'single': ?>
                
                	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix full-post'); ?> role="article" itemscope itemtype="">
				
					<?php foreach ($order as $key => $option){
							
							$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));
							
							if($option == 'title'){
								echo '
								<header class="article-header">
									<h1 class="entry-title single-title" itemprop="headline"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h1>
								</header> <!-- end article header -->			
								'; 
							}
							if($option == 'social_share_top' && ($social_position == 'top' || $social_position == 'both')){
                            	if ($social_show != '1') ; else echo bones_social($social_size, $social_share['facebook'], $social_share['twitter'], $social_share['email'], $social_share['gplus'], $social_share['addthis'], $social_share['counter']);
							}
							if($option == 'text'){
								echo '<section class="entry-content clearfix" itemprop="articleBody">';
								echo the_content('', FALSE, '');	
								echo '</section> <!-- end article section -->';
							}
							if($option == 'social_share_bottom' && ($social_position == 'bottom' || $social_position == 'both')){
                            	if ($social_show != '1') ; else echo bones_social($social_size, $social_share['facebook'], $social_share['twitter'], $social_share['email'], $social_share['gplus'], $social_share['addthis'], $social_share['counter']);
							}				
							if($option == 'meta'){
								echo '<footer class="article-footer">';
								echo bones_meta($meta['date'], $meta['author'], $meta['category'], $meta['comments']); 
								echo '</footer> <!-- end article footer -->';
							}		
							
						}
						
						echo '<div class="pagination clearfix">'; wp_link_pages(array('before' => '<p>', 'next_or_number' => 'next')); echo '</div>';
						                
                	?>
                        
                    </article> <!-- end article -->                    
				                
				<?php break;  
				
				case 'page': ?>
                				
					<?php foreach ($order as $key => $option){
							
							$option = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($key));
							
							if($option == 'title'){
								echo '
								<header class="page-header">
									<h1 class="entry-title page-title" itemprop="headline">'. get_the_title() .'</h1>
								</header> <!-- end article header -->			
								'; 
							}
							if($option == 'social_share_top' && ($social_position == 'top' || $social_position == 'both')){
                            	if ($social_show != '1' && $social_exlude == '1') ; else echo bones_social($social_size, $social_share['facebook'], $social_share['twitter'], $social_share['email'], $social_share['gplus'], $social_share['addthis'], $social_share['counter']);
							}
							if($option == 'text'){
								echo '<div class="entry-content clearfix" itemprop="pageBody">';
								echo the_content('', FALSE, '');	
								echo '</div> <!-- end article section -->';
							}
							if($option == 'social_share_bottom' && ($social_position == 'bottom' || $social_position == 'both')){
                            	if ($social_show != '1' && $social_exlude == '1') ; else echo bones_social($social_size, $social_share['facebook'], $social_share['twitter'], $social_share['email'], $social_share['gplus'], $social_share['addthis'], $social_share['counter']);
							}				
							if($option == 'meta'){
								echo '<footer class="article-footer">';
								echo bones_meta($meta['date'], $meta['author']); 
								echo '</footer> <!-- end article footer -->';
							}		
							
						}
						
						wp_link_pages();
						                
                	?>
                        				                
				<?php break;  
			}
		}
		
	
	} else { ?>
    
                <article id="post-not-found" class="hentry clearfix">
                    <header class="article-header">
                        <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
                    </header>
                    <section class="entry-content">
                        <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
                    </section>
                    <footer class="article-footer">
                        <p><?php _e("This is the error message .", "bonestheme"); ?></p>
                    </footer>
                </article>
    
    <?php } 
	
	echo $html_after; 
	
	if ($pagination == '1') {
		bones_page_navi($wp_query->max_num_pages, 5);
	}
	
	wp_reset_query(); 
	
	// end loops wraps
	
}

include dirname( __FILE__ ) . '/functions.php';

?>
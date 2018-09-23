<?php

add_action('widgets_init', 'posts_tabbed_widget');

function posts_tabbed_widget() {
	register_widget( 'posts_tabbed_Widget' );
}

class Posts_Tabbed_Widget extends WP_Widget {
	
	function Posts_Tabbed_Widget() {
		
		$widget_ops = array('classname' => 'widget_posts_tabbed', 'description' => 'Display a tabbed widget with lists of recent, popular posts, and comments');
		$control_ops = array('id_base' => 'posts-tabbed-widget' );
		$this->WP_Widget( 'posts-tabbed-widget', '9: Tabbed Content Overview', $widget_ops, $control_ops );
		
	}

	function widget($args, $instance) {
	
		global $wpdb;
		extract($args);

		echo $before_widget;

		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		} ?>
        
        <script type="text/javascript">
		
			jQuery(document).ready(function($) {
			
				$("#post_tabs").tabs({ fx: { opacity: 'toggle', duration: 'fast' } });
			  
			});
		
		</script>
	
		<div class="tabbed" id="post_tabs">
		
			<ul class="tab-items clearfix">
			
				<li class="ui-state-active"><a class="tab_recent" href="#recent">Recent</a></li>
				<li><a class="tab_popular" href="#popular">Popular</a></li>
				<li><a class="tab_comments"  href="#recent_comments">Comments</a></li>
			
			</ul>
			
			<div class="tabs-inner">
			
				<div id="recent" class="tab widget_recent_entries">
				
					<ul>
					
						<?php
					
						$args = array(	'orderby' => 'date',
										'posts_per_page' => $instance['num_posts'],
										'ignore_sticky_posts' => 1);
							
						$query = new WP_Query($args);
						
						if ($query->have_posts()) {
						
							while ($query->have_posts()) { 
							
								$query->the_post(); ?> 
								
								<li><i class="icon-file"></i><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
								
							<?php } ?>
							
						<?php wp_reset_postdata(); } ?>
					
					</ul>
				
				</div>
				
				<div id="popular" class="tab widget_popular_entries ui-tabs-hide">
				
					<ul>
					
						<?php
						
							$args = array(	'orderby' => 'comment_count',
											'posts_per_page' => $instance['num_posts'],
											'ignore_sticky_posts' => 1);
								
							$query = new WP_Query($args);
							
							if ($query->have_posts()) {
							
								while ($query->have_posts()) { 
								
									$query->the_post(); ?> 
									
									<li><i class="icon-star"></i><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
									
								<?php } ?>
								
							<?php wp_reset_postdata(); } ?>
					
					</ul>
				
				</div>
				
				<div id="recent_comments" class="tab widget_recent_comments ui-tabs-hide">
				
					<ul>
					
						<?php
						
						$comments = get_comments(array('number' => $instance['num_posts'], 'status' => 'approve', 'type' => 'comment'));
						
						foreach ($comments as $comment) { ?>
								
							<li class="recentcomments"><i class="icon-comment"></i><?php echo $comment->comment_author; ?> on <a href="<?php echo get_comment_link($comment->comment_ID); ?>" title="<?php echo get_the_title($comment->comment_post_ID); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a></li>
						
						<?php } ?>
					
					</ul>
				
				</div>
				
			</div>
		
		</div>
				
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['num_posts'] = strip_tags($new_instance['num_posts']);

		return $instance;
	}
	
	
	function form( $instance ) {

		$defaults = array( 	'title' => 'Content Overview',
							'num_posts' => '6');
							
		$instance = wp_parse_args((array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat"/>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'num_posts' ); ?>">Number of Posts:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'num_posts' ); ?>" name="<?php echo $this->get_field_name( 'num_posts' ); ?>" value="<?php echo $instance['num_posts']; ?>"  class="widefat"/>
		</p>
				
		<?php
	}
	
}

?>
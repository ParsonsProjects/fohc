<?php 

add_action('widgets_init','lateset_tweets');

function lateset_tweets() {
	register_widget('lateset_tweets');
	
	}

class lateset_tweets extends WP_Widget {
	function lateset_tweets() {
			
		$widget_ops = array('classname' => 'widget-twitter','description' => __('Widget display Latest Tweets','theme'));
		$control_ops = array('id_base' => 'latest-tweets' );
		$this->WP_Widget('latest-tweets',__('3: Twitter','theme'),$widget_ops, $control_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		}
			$username = $instance['username'];
			$limit = $instance['count'];	
			$stream = bones_get_tweets($username, $limit, $id);
						
			if ($stream) {
			
			$output = '<ul>';
			
				foreach ($stream as $item) {
				
					$output .= '<li class="clearfix"><span class="tweet-content">' . $item['tweet'] . '</span><span class="twit-date"><i class="icon-time"></i><a href="'. $item['link'] . '">' . $item['created_at']['human_diff'] . ' ago</a></li>';
			
				}
				
				$output .= '</ul>';
				
			} else { echo '<p>There are no tweets to be displayed at this time. Try again later.</p>'; }
			
			echo $output;
			
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = $new_instance['count'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Twitter','theme'), 
			'username' => 'G_forces', 
			'count' => 3
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter username:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of tweets:', 'theme') ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" class="widefat" />
		</p>
        
   <?php 
}
	} //end class
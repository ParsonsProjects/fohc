<?php

add_action('widgets_init', 'like_widget');

function like_widget() {
	register_widget( 'Like_Widget' );
}

class Like_Widget extends WP_Widget {
	
	function Like_Widget() {
		
		$widget_ops = array('classname' => 'widget_like', 'description' => 'Facebook Like Box');
		$control_ops = array('id_base' => 'like-widget' );
		$this->WP_Widget( 'like-widget', '6: Facebook Likebox', $widget_ops, $control_ops );
		
	}

	function widget($args, $instance) {
		global $wpdb;
		extract($args);
		
		$width = $instance['width'];
		$height = $instance['height'];
		$background = $instance['background'];
		$borderc = $instance['borderc'];
		$page = $instance['page'];
		
		echo $before_widget;

		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		} ?>
		
		<div class="like_box_footer" <?php
		if($background != '') {
			echo "style='background:#$background;'";
		}
		?>>
		<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $page ; ?>&amp;width=<?php echo $width ; ?>&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23<?php echo $borderc ; ?>&amp;stream=false&amp;header=false&amp;height=<?php echo $height ; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
        </div><!--like_box_footer-->
        
		<?php echo $after_widget;
	}

	
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['width'] = $new_instance['width'];
		$instance['background'] = $new_instance['background'];
		$instance['borderc'] = $new_instance['borderc'];
		$instance['page'] = $new_instance['page'];
		
		return $instance;
	}
	
	
	function form( $instance ) {

		$defaults = array( 
			'title' => __('Facebook','theme'),
			'page' => 'http://www.facebook.com/GForces',
			'width' => 283,
			'height' => 258,
			'borderc' => 'acb7d1',
			);
		$instance = wp_parse_args((array) $instance, $defaults ); ?>
				
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">Width:</label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>"  class="widefat" />
		</p>

    	<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">Height:</label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>"  class="widefat" />
		</p>

    	<p>
			<label for="<?php echo $this->get_field_id( 'background' ); ?>">Background Color: (color code without #)</label>
			<input id="<?php echo $this->get_field_id( 'background' ); ?>" name="<?php echo $this->get_field_name( 'background' ); ?>" value="<?php echo $instance['background']; ?>"  class="widefat" />
		</p>
    	<p>
			<label for="<?php echo $this->get_field_id( 'borderc' ); ?>">Box border Color: (color code without #)</label>
			<input id="<?php echo $this->get_field_id( 'borderc' ); ?>" name="<?php echo $this->get_field_name( 'borderc' ); ?>" value="<?php echo $instance['borderc']; ?>"  class="widefat" />
		</p>

    	<p>
			<label for="<?php echo $this->get_field_id( 'page' ); ?>">Facebook Page URL:</label>
			<input id="<?php echo $this->get_field_id( 'page' ); ?>" name="<?php echo $this->get_field_name( 'page' ); ?>" value="<?php echo $instance['page']; ?>"  class="widefat" />
		</p>
		
		<?php
	}
	
}

?>
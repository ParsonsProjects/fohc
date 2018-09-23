<?php

add_action('widgets_init', 'video_widget');

function video_widget() {
	register_widget( 'Video_Widget' );
}

class Video_Widget extends WP_Widget {
	
	function Video_Widget() {
		
		$widget_ops = array('classname' => 'widget_video', 'description' => 'Display a video from any source using an embed code');
		$control_ops = array('id_base' => 'video-widget' );
		$this->WP_Widget( 'video-widget', '8: Embedded Video', $widget_ops, $control_ops );
		
	}

	function widget($args, $instance) {
		global $wpdb;
		extract($args);
		
		$type = $instance['type'];
		$id = $instance['video'];
		
		echo $before_widget;

		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		}?>
		
        <div class="post-video">
		<?php if($type == 'Youtube') { ?>
			<iframe width="100%" height="235" src="http://www.youtube.com/embed/<?php echo $id; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
		<?php } elseif($type == 'Vimeo') { ?>
            <iframe src="http://player.vimeo.com/video/<?php echo $id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" width="100%" height="235" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        <?php } elseif($type == 'Dialymotion') { ?>
            <iframe frameborder="0" width="100%" height="235" src="http://www.dailymotion.com/embed/video/<?php echo $id ?>?logo=0"></iframe>
        <?php } ?>
		</div>
        
		<?php echo $after_widget;
	}

	
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['video'] = $new_instance['video'];
		$instance['type'] = $new_instance['type'];

		return $instance;
	}
	
	
	function form( $instance ) {

		$defaults = array( 'title' => '', 'video' => '');
		$instance = wp_parse_args((array) $instance, $defaults ); ?>
		
		<p>Please change the embedded video's width to 200px maximum for any sidebar or footer widgetized area as this is the max width the areas can support.</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat"/>
		</p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'type' ); ?>">Type</label>
            <select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
            <option <?php if ( 'Youtube' == $instance['type'] ) echo 'selected="selected"'; ?>>Youtube</option>
            <option <?php if ( 'Vimeo' == $instance['type'] ) echo 'selected="selected"'; ?>>Vimeo</option>
            <option <?php if ( 'Dialymotion' == $instance['type'] ) echo 'selected="selected"'; ?>>Dialymotion</option>
            </select>
        </p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'video' ); ?>">Video Embed Code:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'video' ); ?>" name="<?php echo $this->get_field_name( 'video' ); ?>" value="<?php echo $instance['video']; ?>"  class="widefat"/>
		</p>
		
		<?php
	}
	
}

?>
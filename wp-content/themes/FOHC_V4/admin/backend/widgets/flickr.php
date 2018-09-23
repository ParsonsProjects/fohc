<?php 

add_action('widgets_init','flickr');

function flickr() {
	register_widget('flickr');
	
	}

class flickr extends WP_Widget {
	function flickr() {
			
		$widget_ops = array('classname' => 'widget-flickr','description' => __('Widget display Flickr Photo','theme'));
		$control_ops = array('id_base' => 'flickr-photo' );
		$this->WP_Widget('flickr-photo',__('2: Flickr','theme'),$widget_ops, $control_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$flickrID = $instance['flickrID'];
		$count = $instance['count'];
		$type = $instance['type'];
		$display = $instance['display'];


		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		} ?>
            <div class="flickr_badge_wrapper clearfix">
            
                <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $count ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
                
            </div>
            
            <script>
				jQuery(document).ready(function($){
				 $(".flickr_badge_wrapper a").attr('target','_blank');
				}); 
			</script>
			
	<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['count'] = $new_instance['count'];
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];

		return $instance;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Flickr','theme'), 
		'flickrID' => '41132307@N07',
		'count' => '9',
		'type' => 'user',
		'display' => 'latest'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'theme') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of Photos:', 'theme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
			<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
			<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
		</select>
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'theme') ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
			<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
			<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
		</select>
	</p>
        
   <?php 
}
	} //end class
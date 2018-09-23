<?php

add_action('widgets_init', 'divider_widget');

function divider_widget() {
	register_widget( 'Divider_Widget' );
}

class Divider_Widget extends WP_Widget {
	
	function Divider_Widget() {
		
		$widget_ops = array('classname' => 'widget_divider', 'description' => 'Content separator on the home-page wigetized area only.');
		$control_ops = array('id_base' => 'divider-widget' );
		$this->WP_Widget( 'divider-widget', '10: Content Divider', $widget_ops, $control_ops );
		
	}

	function widget($args, $instance) {
	
		global $wpdb;
		extract($args);

		echo $before_widget;
		
		echo '&nbsp;';
		
		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
	
		$instance = $old_instance;	

		return $instance;
		
	}
	
	
	function form( $instance ) { ?>
		
		<p>This is a simple solid line divider to help divide sections on the homepage if extra readability is desired.</p>
		
		<?php
	}
	
}

?>
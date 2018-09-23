<?php

add_action('widgets_init', 'nav_tabbed_widget');

function nav_tabbed_widget() {
	register_widget( 'nav_tabbed_Widget' );
}

class Nav_Tabbed_Widget extends WP_Widget {
	
	function Nav_Tabbed_Widget() {
		
		$widget_ops = array('classname' => 'widget_nav_tabbed', 'description' => 'Display a tabbed widget with lists of categories, archives, and pages');
		$control_ops = array('id_base' => 'nav-tabbed-widget' );
		$this->WP_Widget( 'nav-tabbed-widget', '5: Tabbed Navigation', $widget_ops, $control_ops );
		
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

				$("#nav_tabs").tabs({ fx: { opacity: 'toggle', duration: 'fast' } });
			  
			});
		
		</script>
		
		<div class="tabbed" id="nav_tabs">
		
			<ul class="tab-items clearfix">
			
				<li class="ui-state-active"><a class="tab_categories" href="#categories">Categories</a></li>
				<li><a class="tab_archives" href="#archives">Archives</a></li>
				<li><a class="tab_pages" href="#pages">Pages</a></li>
			
			</ul>
			
			<div class="tabs-inner">
			
				<div id="categories" class="tab widget_categories">
				
					<ul>
				
						<?php if ($instance['count'] == 'on') $count = 1; else $count = 0; ?>
					
						<?php wp_list_categories(array('show_count' => $count, 'title_li' => '', 'show_option_none' => 'No categories')); ?>
					
					</ul>
				
				</div>
				
				<div id="archives" class="tab widget_archive ui-tabs-hide">
				
					<ul>
				
						<?php if ($instance['count'] == 'on') $count = true; else $count = false; ?>
					
						<?php wp_get_archives(array('show_post_count' => $count)); ?>
					
					</ul>
				
				</div>
				
				<div id="pages" class="tab widget_pages ui-tabs-hide">
				
					<ul>
					
						<?php wp_list_pages(array('title_li' => '')); ?>
					
					</ul>
				
				</div>
				
			</div>
		
		</div>
				
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);

		return $instance;
	}
	
	
	function form( $instance ) {

		$defaults = array( 	'title' => 'Navigation',
							'count' => 'on');
							
		$instance = wp_parse_args((array) $instance, $defaults ); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat"/>
		</p>
		
		<p>
			<input <?php if ($instance['count'] == 'on') echo 'checked="checked"'; ?> type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'count' ); ?>">Show post count</label>
		</p>
				
		<?php
	}
	
}

?>
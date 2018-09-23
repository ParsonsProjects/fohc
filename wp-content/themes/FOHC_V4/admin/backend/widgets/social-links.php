<?php

add_action('widgets_init', 'social_links');

function social_links() {
	register_widget( 'Social_links' );
}

class Social_links extends WP_Widget {
	
	function Social_links() {
		
		$widget_ops = array('classname' => 'widget_social_links', 'description' => 'Social Links');
		$control_ops = array('id_base' => 'social-links-widget' );
		$this->WP_Widget( 'social-links-widget', '4: Social Links', $widget_ops, $control_ops );
		
	}

	function widget($args, $instance) {
	
		global $wpdb;
		extract($args);

		echo $before_widget;
				
		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		}?>
	        
        
        <?php if ($instance['facebook']) {?>
			<a href="<?php echo $instance['facebook']; ?>" class="facebook" title="Facebook"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/facebook_16.png" alt="Facebook" /></a>
		<?php }?>
        <?php if ($instance['twitter']) {?>
			<a href="<?php echo $instance['twitter']; ?>" class="twitter" title="Twitter"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/twitter_16.png" alt="Twitter" /></a>
		<?php }?>
        <?php if ($instance['youtube']) {?>
			<a href="<?php echo $instance['youtube']; ?>" class="youtube" title="Youtube"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/youtube_16.png" alt="Youtube" /></a>
		<?php }?>
        <?php if ($instance['linkedin']) {?>
			<a href="<?php echo $instance['linkedin']; ?>" class="linkedin" title="Linkedin"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/linkedin_16.png" alt="Linkedin" /></a>
		<?php }?>
        <?php if ($instance['gplus']) {?>
			<a href="<?php echo $instance['gplus']; ?>" class="gplus" title="Google Plus"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/google_plus_16.png" alt="Google Plus" /></a>
		<?php }?>
        <?php if ($instance['pintrest']) {?>
			<a href="<?php echo $instance['pintrest']; ?>" class="pintrest" title="Pintrest"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/pinterest_16.png" alt="Pintrest" /></a>
		<?php }?>
                
		<?php echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['content'] = strip_tags($new_instance['content']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['youtube'] = strip_tags($new_instance['youtube']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);
		$instance['gplus'] = strip_tags($new_instance['gplus']);
		$instance['pintrest'] = strip_tags($new_instance['pintrest']);
		return $instance;
	}
	
	function form( $instance ) {

		$defaults = array( 	'title' => '',
							'content' => '');
							
		$instance = wp_parse_args((array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook page url:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter page url:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>">Youtube page url:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">Linkedin page url:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo $instance['linkedin']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">Google Plus page url:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php echo $instance['gplus']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'pintrest' ); ?>">Pintrest page url:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'pintrest' ); ?>" name="<?php echo $this->get_field_name( 'pintrest' ); ?>" value="<?php echo $instance['pintrest']; ?>"  class="widefat"/>
		</p>

		
		<?php
	}
	
}

?>
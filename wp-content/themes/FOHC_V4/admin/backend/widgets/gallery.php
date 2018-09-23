<?php

add_action('widgets_init', 'gallery_widget');

function gallery_widget() {
	register_widget( 'Gallery_Widget' );
}

class Gallery_Widget extends WP_Widget {
	
	function Gallery_Widget() {
		
		$widget_ops = array('classname' => 'widget-gallery', 'description' => 'Display the latest images uploaded.');
		$control_ops = array('id_base' => 'gallery' );
		$this->WP_Widget( 'gallery', '1: Image Gallery', $widget_ops, $control_ops );
		
	}

	function widget($args, $instance) {
		global $wpdb;
		extract($args);
		$letter = '';

		echo $before_widget;

		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		} ?>
        
		<div class="gallery-wrapper">
		
			<div class="image-wrapper">
				        
                    <?php 
                    $args = array(
                        'order'          => 'ASC',
                        'post_type'      => 'attachment',
                        'post_parent'    => $post->ID,
                        'post_mime_type' => 'image',
                        'post_status'    => null,
                        'numberposts'    => $instance['thumb_num']
                    );
                    $attachments = get_posts($args);
					$count = 0;
					echo '<ul class="clearfix">';
                    if ($attachments) {
                        foreach ($attachments as $attachment) {
							$count ++;
							if ($count % 2 == 0) {
							    echo '<li>';
							} else {
								echo '<li>';	
							}
							
							$width = $instance['width'];
							$height = $instance['height'];
							$src = wp_get_attachment_url( $attachment->ID, 'full' );
							$image_src = aq_resize( $src, $width, $height, true );
							$image_full = aq_resize( $src, 700, 500, false );
							
                            echo '<a rel="lightbox[gallery]" href='. $image_full .' title=""><img src="'. $image_src .'" alt="" /></a>';
							echo '</li>';
                        }
                    }
					echo '</ul>';
                    ?>
                    
                    <div class="clear"></div>     
                                  			
			</div>
			
		</div>
					
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['thumb_num'] = strip_tags($new_instance['thumb_num']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['height'] = strip_tags($new_instance['height']);
		return $instance;
	}
	
	function form( $instance ) {

		$defaults = array( 	'title' => '',
							'width' => '56',
							'height' => '56',
							'thumb_num' => '6');
							
		$instance = wp_parse_args((array) $instance, $defaults ); ?>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">Width</label>
			<input type="text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo $instance['width']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">Height</label>
			<input type="text" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'thumb_num' ); ?>">Limit Number of Images -1 for all images:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumb_num' ); ?>" name="<?php echo $this->get_field_name( 'thumb_num' ); ?>" value="<?php echo $instance['thumb_num']; ?>"  class="widefat"/>
		</p>
		
		<?php
	}
	
}

?>
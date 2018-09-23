<?php

add_action('widgets_init', 'list_post_widget');

function list_post_widget() {
	register_widget( 'list_Post_Widget' );
}

class List_Post_Widget extends WP_Widget {
	
	function List_Post_Widget() {
		
		$widget_ops = array('classname' => 'list-post widget-wide loop-section', 'description' => 'Display a custom list of posts with from specific categories and tags');
		$control_ops = array('id_base' => 'list-posts' );
		$this->WP_Widget( 'list-posts', '14: List Post Loop', $widget_ops, $control_ops );
		
	}

	function widget($args, $instance) {
		global $wpdb;
		extract($args);
		$letter = '';

		echo $before_widget;

		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		} elseif ($instance['title_gen'] == 'on') {
			echo $before_title;
			if ($instance['limit_number'] > 1) $letter = 's';
			if ($instance['popular'] == 'on') echo 'Popular Post' . $letter; else echo 'Recent Post' . $letter;
			if ($instance['limit_category'] != 'Any category') echo ' from <a href="' . get_category_link(get_cat_id($instance['limit_category'])) . '" title="' . $instance['limit_category'] . ' Post Category">' . $instance['limit_category'] . '</a>';
			if ($instance['limit_tag'] != '') { 
			
				$tags = explode(',', $instance['limit_tag']);
				
				foreach ($tags as $tag) {
					$link = get_tag_link(get_tag_id($tag));
					$new_tags[] = '<a href="' . $link . '" title="Archive of ' . $tag . '">' . $tag . '</a>';
				}
				
				$tags = implode(', ', $new_tags);
				
				echo ' tagged ' . $tags;
				
			}
				
			echo $after_title;
		}
	
		if ($instance['thumb_float'] == 'Left') $float = 'left'; else $float = 'right';
		if ($instance['popular'] == 'on') $instance['popular'] = 'comment_count'; else $instance['popular'] = 'date';
		
		if ($instance['btn_more'] == 'on') $readmore = 1;
		if ($instance['date'] == 'on') $date = 1;
		if ($instance['author'] == 'on') $author = 1;
		if ($instance['category'] == 'on') $category = 1;
		if ($instance['comments'] == 'on') $comments = 1;
		if ($instance['post_type'] == 'Excerpt') $excerpt = 1; else $excerpt = 0;
		if ($instance['thumb'] == 'on') $thumb = '1'; else $thumb = '';

		
		$loop = array(		'html_before' 			=> '<div id="standard-list" class="list">',							// custom html before loop
							'html_after' 			=> '</div>',														// custom html after loop
							'social_show' 			=> '0',																// show social share icons
							'meta_position'			=> 'top',															// meta data position (bottom,top)
							'thumb'					=> $thumb,
							'thumb_width'			=> $instance['thumb_width'],	
							'thumb_height'			=> $instance['thumb_height'],
							'meta' => array('date' => $date, 
											'author' => $author, 
											'category' => $category, 
											'comments' => $comments),
							'post_type' 			=> 'standard',														// post type (page,standard,box,single)
							'read_more' 			=> $readmore,														// read more
							'read_more_text'		=> 'Read More',														// read more text
							'number_of_posts' 		=> $instance['limit_number'],
							'sort' 					=> $instance['popular'],
							'category' 				=> $instance['limit_category'],
							'tag' 					=> $instance['limit_tag'],
							'loop_type' 			=> 'custom');														// loop type (default,related,custom,widgets)
			
		bones_global_loop($loop);
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['title_gen'] = strip_tags($new_instance['title_gen']);
		$instance['thumb'] = strip_tags($new_instance['thumb']);
		$instance['popular'] = strip_tags($new_instance['popular']);
		$instance['date'] = strip_tags($new_instance['date']);
		$instance['author'] = strip_tags($new_instance['author']);
		$instance['category'] = strip_tags($new_instance['category']);
		$instance['comments'] = strip_tags($new_instance['comments']);
		$instance['limit_category'] = strip_tags($new_instance['limit_category']);
		$instance['limit_number'] = strip_tags($new_instance['limit_number']);
		$instance['limit_tag'] = strip_tags($new_instance['limit_tag']);
		$instance['thumb_width'] = strip_tags($new_instance['thumb_width']);
		$instance['thumb_height'] = strip_tags($new_instance['thumb_height']);


		return $instance;
	}
	
	
	function form( $instance ) {

		$defaults = array( 	'title' => '', 
							'title_gen' => '',
							'thumb' => 'off', 
							'popular' => '',
							'excerpt_length' => '20',
							'date' => 'on', 
							'author' => '', 
							'category' => 'on', 
							'comments' => '',
							'limit_category' => 'Any category',
							'limit_tag' => '', 
							'thumb_width' => '200', 
							'thumb_height' => '200', 
							'limit_number' => '1');
							
		$instance = wp_parse_args((array) $instance, $defaults ); ?>
		
		<p>
			<input <?php if ($instance['title_gen'] == 'on') echo 'checked="checked"'; ?> type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'title_gen' ); ?>" name="<?php echo $this->get_field_name( 'title_gen' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'title_gen' ); ?>">Generate title by criteria</label>
		</p>
		
		<p>
			<input <?php if ($instance['thumb'] == 'on') echo 'checked="checked"'; ?> type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>">Display a post thumbnail (if available)</label>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'thumb_width' ); ?>">Width:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumb_width' ); ?>" name="<?php echo $this->get_field_name( 'thumb_width' ); ?>" value="<?php echo $instance['thumb_width']; ?>"  class="widefat"/>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'thumb_height' ); ?>">Height:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumb_height' ); ?>" name="<?php echo $this->get_field_name( 'thumb_height' ); ?>" value="<?php echo $instance['thumb_height']; ?>"  class="widefat"/>
		</p>
		
		<p>
			<input <?php if ($instance['popular'] == 'on') echo 'checked="checked"'; ?> type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'popular' ); ?>" name="<?php echo $this->get_field_name( 'popular' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'popular' ); ?>">Sort posts by popularity (comments)</label>
		</p>
		
		<p style="display:block; float:left; width: 45%; margin-right: 5%;">
			<input <?php if ($instance['date'] == 'on') echo 'checked="checked"'; ?> type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'date' ); ?>">Date</label>
		</p>
			
		<p style="display:block; float:left; width: 45%; margin-right: 5%;">
			<input <?php if ($instance['author'] == 'on') echo 'checked="checked"'; ?> type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'author' ); ?>">Author</label>
		</p>
			
		<p style="display:block; float:left; width: 45%; margin-right: 5%;">
			<input <?php if ($instance['category'] == 'on') echo 'checked="checked"'; ?> type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Categories</label>
		</p>
			
		<p style="display:block; float:left; width: 45%; margin-right: 5%;">
			<input <?php if ($instance['comments'] == 'on') echo 'checked="checked"'; ?> type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'comments' ); ?>" name="<?php echo $this->get_field_name( 'comments' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'comments' ); ?>">Comments</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat"/>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'limit_number' ); ?>">Number of posts to display:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'limit_number' ); ?>" name="<?php echo $this->get_field_name( 'limit_number' ); ?>" value="<?php echo $instance['limit_number']; ?>"  class="widefat"/>
		</p>
		
		<p>
			<label style="display: block; padding-bottom: 5px;" ;for="<?php echo $this->get_field_id( 'limit_category' ); ?>">Get posts from this category:</label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'limit_category' ); ?>" name="<?php echo $this->get_field_name( 'limit_category' ); ?>">
				<option <?php if ( 'Any category' == $instance['limit_category'] ) echo 'selected="selected"'; ?>>Any category</option>
				<?php
				$categories = get_categories();
				foreach ($categories as $category) {
				
					$selected = '';
					
					if ($instance['limit_category'] == $category->cat_name) $selected = 'selected="selected"';
				
					echo '<option '. $selected . '>' . $category->cat_name . '</option>';
					
				} ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'limit_tag' ); ?>">Limit by tags (e.g. apple,intel,google):</label>
			<input type="text" id="<?php echo $this->get_field_id( 'limit_tag' ); ?>" name="<?php echo $this->get_field_name( 'limit_tag' ); ?>" value="<?php echo $instance['limit_tag']; ?>"  class="widefat"/>
		</p>
		
		<?php
	}
	
}

?>
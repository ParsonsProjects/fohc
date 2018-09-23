<?php

function bones_social($size = 'small', $facebook = false, $twitter = false, $email = false, $gplus = false, $addthis = false, $counter = false) {
	
	$output = '<div class="social-share">';
	
	switch ($size) {
		
		case 'small':
		$output .= '<div class="addthis_toolbox addthis_default_style">';
			if($facebook == '1'):
				$output .= '<a class="addthis_button_facebook facebook" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($twitter == '1'):
				$output .= '<a class="addthis_button_twitter twitter" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($email == '1'):
				$output .= '<a class="addthis_button_email email" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($gplus == '1'):
				$output .= '<a class="addthis_button_google_plusone_share gplus" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($addthis == '1'):
				$output .= '<a class="addthis_button_compact addthis" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($counter == '1'):
				$output .= '<a class="addthis_counter addthis_bubble_style" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
		$output .= '</div>';
		break;
		
		case 'large':
		$output .= '<div class="addthis_toolbox addthis_default_style addthis_32x32_style">';
			if($facebook == '1'):
				$output .= '<a class="addthis_button_facebook facebook" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($twitter == '1'):
				$output .= '<a class="addthis_button_twitter twitter" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($email == '1'):
				$output .= '<a class="addthis_button_email email" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($gplus == '1'):
				$output .= '<a class="addthis_button_google_plusone_share gplus" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($addthis == '1'):
				$output .= '<a class="addthis_button_compact addthis" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($counter == '1'):
				$output .= '<a class="addthis_counter addthis_bubble_style" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
		$output .= '</div>';
		break;
		
		case 'h_count':
		$output .= '<div class="addthis_toolbox addthis_default_style">';
			if($facebook == '1'):
				$output .= '<a class="addthis_button_facebook_like facebook" fb:like:layout="button_count" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($twitter == '1'):
				$output .= '<a class="addthis_button_tweet twitter" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($gplus == '1'):
				$output .= '<a class="addthis_button_google_plusone email" g:plusone:size="medium" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($addthis == '1'):
				$output .= '<a class="addthis_counter addthis_pill_style addthis" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
		$output .= '</div>';
		break;
		
		case 'v_count':
		$output .= '<div class="addthis_toolbox addthis_counter_style">';
			if($facebook == '1'):
				$output .= '<a class="addthis_button_facebook_like facebook" fb:like:layout="box_count" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($twitter == '1'):
				$output .= '<a class="addthis_button_tweet twitter" tw:count="vertical" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($gplus == '1'):
				$output .= '<a class="addthis_button_google_plusone email" g:plusone:size="tall" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($addthis == '1'):
				$output .= '<a class="addthis_counter addthis" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
		$output .= '</div>';
		break;
		
		case 'h_count_small':
		$output .= '<div class="addthis_toolbox addthis_default_style">';
			if($facebook == '1'):
				$output .= '<a class="addthis_button_facebook facebook" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($twitter == '1'):
				$output .= '<a class="addthis_button_twitter twitter" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($email == '1'):
				$output .= '<a class="addthis_button_email email" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($gplus == '1'):
				$output .= '<a class="addthis_button_google_plusone_share gplus" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($addthis == '1'):
				$output .= '<a class="addthis_button_compact addthis" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($counter == '1'):
				$output .= '<a class="addthis_counter addthis_bubble_style" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
		$output .= '</div>';		
		$output .= '<div class="addthis_toolbox addthis_default_style">';
			if($facebook == '1'):
				$output .= '<a class="addthis_button_facebook_like facebook" fb:like:layout="button_count" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($twitter == '1'):
				$output .= '<a class="addthis_button_tweet twitter" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($gplus == '1'):
				$output .= '<a class="addthis_button_google_plusone email" g:plusone:size="medium" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
			if($addthis == '1'):
				$output .= '<a class="addthis_counter addthis_pill_style addthis" addthis:url="'. get_permalink() .'" addthis:title="'. get_the_title() .'"></a>';
			endif;
		$output .= '</div>';
		break;
			
	}
	
	$output .= '<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-505824f0713db54c"></script>';
	$output .= '</div>';
	
	return $output;
	
}

function bones_excerpt($length = false, $preserve = true) {

	global $post;
	
	if ($post->post_excerpt) {
	
		$text = get_the_excerpt();
		
	} elseif ($length !== false) {
		
		$text = get_the_content();	
		$text = apply_filters('the_content', $text);
		$text = str_replace('\]\]\>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = preg_replace('/\[.*\]/', '', strip_tags($post->post_content, '<a>,<strong>,<em>,<i>,<b>,<span>'));
		$text = strip_shortcodes($text);
		$text = explode(' ', $text, $length + 1);
		if (count($text) > $length) {
	        array_pop($text);
	        $text = implode(' ', $text);
	        $text = trim($text);
	        $text = preg_replace('/[\.]$/', '', $text);
	        $text .= '...';
		} else {
			$text = implode(' ', $text);
			$text = trim($text);
		}
	}
	
	return $text;
}

function bones_meta($date = false, $author = false, $category = false, $comments = false) {
	
	if (($date || $author || $category || $comments) == '1') {
		
		echo '<div class="meta">';
		
		if ($date == '1') { 
		$date = of_get_option('date_format', 'd/m/Y'); ?>
        	<time class="updated" datetime="<?php echo get_the_time('Y-m-j'); ?>" pubdate>
            	<span><?php _e("Posted on ", "bonestheme"); ?></span><?php echo get_the_time($date); ?>
            </time> 
		<?php }
		if ($author == '1') { ?><span class="author"><span><?php _e("by ", "bonestheme"); ?></span><?php echo the_author_link(); ?></span> <?php }
		if ($category == '1') { ?><span class="category"><span><?php _e("in ", "bonestheme"); ?></span><?php echo the_category(', '); ?></span> <?php }
		if ($comments == '1') { 
			echo '<span class="comment-count"><span>with</span> <a href="'.get_comments_link().'" title="Leave a comment" class="comments">'; 
			comments_number('no comments', '1 comment', '% comments'); 
			echo '</a></span>'; 
		}
		
		echo '</div>';
		
	}
		
}

function social_listing_size() {
	
	$social_listing_size  = of_get_option('listing_social_size', 'default' );
	
	if ($social_listing_size == 'default'){
		$social_size = of_get_option('social_size', 'small' );
	} else { 
		$social_size = $social_listing_size;
	}	
	
	return $social_size;
	
}

function site_layout() {
	if (of_get_option('custom_home_layout', '0' ) == '1' && is_front_page()){
		$site_layout = of_get_option('home_layout', 'right-col' );
	} elseif (of_get_option('custom_post_layout', '0' ) == '1' && is_single()){
		$site_layout = of_get_option('post_layout', 'right-col' );
	} elseif (of_get_option('custom_page_layout', '0' ) == '1' && is_page()){
		$site_layout = of_get_option('page_layout', 'right-col' );
	} else {
		$site_layout = of_get_option('site_layout', 'right-col' );	
	}
	
	return $site_layout;
	
}

function related_meta_data() {
	
	$related_meta_data 	= of_get_option('related_options', '0' );
		
	$meta_data = array(															
		'date' 			=> of_get_option('related_date', '' ),
		'author' 		=> $related_meta_data['author'], 
		'category' 		=> $related_meta_data['category'], 
		'comments'		=> $related_meta_data['comments_link']
	);
	
	return $meta_data;
	
}

function meta_data() {
	
	$listing_options 	= of_get_option('listing_options', '0' );
	$detail_options 	= of_get_option('detail_options', '0' ); 
	
	if (is_single()){
		$meta_data = array(															
			'date' 				=> $detail_options['date'], 
			'author' 			=> $detail_options['author'], 
			'category' 			=> $detail_options['category'], 
			'comments'			=> $listing_options['comments'],
			'comments_template'	=> $detail_options['comments_form']
		);
	} elseif (is_page()){
		$meta_data = array(															
			'date' 			=> $listing_options['date'],
			'author' 		=> $listing_options['author'], 
			'category' 		=> $listing_options['category'], 
			'comments'		=> $listing_options['comments']
		);
	} else { 
		$meta_data = array(															
			'date' 			=> $listing_options['date'],
			'author' 		=> $listing_options['author'], 
			'category' 		=> $listing_options['category'], 
			'date'			=> $listing_options['date'],
			'comments'		=> $listing_options['comments']
		);
	}
	
	return $meta_data;
	
}

function social_share() {
	$social_share 		= of_get_option('social_share', '0' );
			
	$social_share_icons = array(															
		'facebook' 		=> $social_share['facebook'], 
		'twitter' 		=> $social_share['twitter'], 
		'email' 		=> $social_share['email'], 
		'gplus'			=> $social_share['gplus'],
		'addthis'		=> $social_share['addthis'],
		'counter'		=> $social_share['counter']
	);

	return $social_share_icons;
	
}

function social_show() {
	$social_show = of_get_option('social_show', '0' );
			
	if (is_single()){
		$social_show_icons = $social_show['posts'];
	} elseif (is_page()){
		$social_show_icons = $social_show['pages'];
	} elseif (is_search()){
		$social_show_icons = $social_show['search_page'];
	} elseif (is_archive()){
		$social_show_icons = $social_show['archive_page'];
	}
		
	return $social_show_icons;
	
}

function social_exlude() {
	$exlude_pages_list	= of_get_option('exlude_pages_list', '' );	
			
	$social_exlude = '0';	
	
	if ( is_array($exlude_pages_list) ) {
		foreach ($exlude_pages_list as $key => $value) {
			// If you need the option's name rather than the key you can get that
			if($value == '1') {
			// Prints out each of the values
				$exlude[] = $key;
			} else {
			// Prints out each of the values
				$exlude[] = '';
			}		
		}
		if (is_page( $exlude )){
			$social_exlude = '1';	
		} else {
			$social_exlude = '0';
		}
	}
	
	return $social_exlude;
	
}

function get_tag_id($tag_name) {

	global $wpdb;
	$tag_ID = $wpdb->get_var("SELECT * FROM ".$wpdb->terms." WHERE  `name` =  '".$tag_name."'");
	return $tag_ID;
	
}

?>
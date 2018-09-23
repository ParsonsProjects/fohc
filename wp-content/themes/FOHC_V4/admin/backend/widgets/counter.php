<?php 

add_action('widgets_init','social_counter');

function social_counter() {
	register_widget('social_counter');
	}

class social_counter extends WP_Widget {
	function social_counter() {
			
		$widget_ops = array('classname' => 'social-counter','description' => __('Widget display a count of your rss subscribers, Twitter followers, facebook fans','theme'));
		$control_ops = array('id_base' => 'social_counter' );
		$this->WP_Widget('social_counter',__('7: Social Counter','theme'),$widget_ops, $control_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
	$title = apply_filters('widget_title', $instance['title'] );
	$twitter = $instance['twitter'];
	$facebook = $instance['facebook'];
	$rss = $instance['rss'];
	$rss_text = $instance['rss_text'];
	$rss_link = $instance['rss_link'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ($instance['title']) { 
			echo $before_title . $instance['title'] . $after_title; 
		} ?>

<?php
	//facebook
	$interval = 3600;
	if($_SERVER['REQUEST_TIME'] > 1) {
		@$api = wp_remote_get('http://graph.facebook.com/' . $facebook);
		@$json = json_decode($api['body']);
		
		if($json->likes >= 1) {
			update_option('mom_facebook_cache_time', $_SERVER['REQUEST_TIME'] + $interval);
			update_option('mom_facebook_followers', $json->likes);
			update_option('mom_facebook_link', $json->link);
		}
	}

	//twitter
	$interval = 3600;
	
	if($_SERVER['REQUEST_TIME'] > 1) {
		@$api = wp_remote_get('http://api.twitter.com/1/statuses/user_timeline/' . $twitter . '.json');
		@$json = json_decode($api['body']);
		
		if(@$api['headers']['x-ratelimit-remaining'] >= 1) {
			update_option('mom_twitter_cache_time', $_SERVER['REQUEST_TIME'] + $interval);
			update_option('mom_twitter_followers', $json[0]->user->followers_count);
		}
	}
	
	  $url = "http://twitter.com/users/show/" . $twitter . "";
	  $response = file_get_contents ( $url );
	  $t_profile = new SimpleXMLElement ( $response );
	  $t_count = $t_profile->followers_count;



// feedburner
	
	if ($rss != '') {
		//get cool feedburner count
		$whaturl="http://api.feedburner.com/awareness/1.0/GetFeedData?uri=" . $rss;
	
		//Initialize the Curl session
		$ch = curl_init();
	
		//Set curl to return the data instead of printing it to the browser.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
		//Set the URL
		curl_setopt($ch, CURLOPT_URL, $whaturl);
	
		//Execute the fetch
		$data = curl_exec($ch);
	
		//Close the connection
		curl_close($ch);
		$xml = new SimpleXMLElement($data);
		$fb = $xml->feed->entry['circulation'];
		echo $fb;
	}
	

?>

<div class="social_counter">
  <div class="sc_rss sc_item">
    <div class="social_box">
      <?php if($rss_link != '') {
						$rssurl = $rss_link;
					} else {
						$rssurl = get_bloginfo('rss2_url');
					} ?>
      <a href="<?php echo $rssurl; ?>"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/rss_32.png" alt=""> </a> <span>
      <?php _e('Subscribers', 'theme'); ?>
      </span>
      <?php if ($rss != '') { ?>
      <span class="social-box-count"><?php echo $fb; ?></span>
      <?php } else { ?>
      <span class="social-box-count"><?php echo $rss_text; ?></span>
      <?php } ?>
    </div>
  </div>
  <!--SC Item-->
  
  <div class="sc_twitter sc_item">
    <div class="social_box"> <a target="_blank" href="http://twitter.com/<?php echo $twitter ?>"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/twitter_32.png" alt=""> </a> <span>
      <?php _e('Followers', 'theme'); ?>
      </span> <span class="social-box-count"><?php echo get_option('mom_twitter_followers'); ?></span> </div>
  </div>
  <!--SC Item-->
  
  <div class="sc_facebook sc_item">
    <div class="social_box"> <a target="_blank" href="<?php echo get_option('mom_facebook_link'); ?>"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/facebook_32.png" alt=""> </a> <span>
      <?php _e('Fans', 'theme'); ?>
      </span> <span class="social-box-count"><?php echo get_option('mom_facebook_followers'); ?></span> </div>
  </div>
  <!--SC Item--> 
  
</div>
<!--mom_social_counter-->
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['twitter'] = $new_instance['twitter'];
			$instance['facebook'] = $new_instance['facebook'];
			$instance['rss'] = $new_instance['rss'];
			$instance['rss_text'] = $new_instance['rss_text'];
			$instance['rss_link'] = $new_instance['rss_link'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 
			'twitter' => 'G_forces',
			'facebook' => 'GForces',
			'rss_text' => '1000+'
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e('title:', 'theme'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'rss_text' ); ?>">
    <?php _e('rss number (if not use feedburner, or want static number)', 'theme'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'rss_text' ); ?>" name="<?php echo $this->get_field_name( 'rss_text' ); ?>" value="<?php echo $instance['rss_text']; ?>" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'rss' ); ?>">
    <?php _e('feedburner name', 'theme'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'rss_link' ); ?>">
    <?php _e('RSS Link (leave empty to use default rss link)', 'theme'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'rss_link' ); ?>" name="<?php echo $this->get_field_name( 'rss_link' ); ?>" value="<?php echo $instance['rss_link']; ?>" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'twitter' ); ?>">
    <?php _e('Twitter Name', 'theme'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'facebook' ); ?>">
    <?php _e('facebook page ID (<a target="_blank" href="http://hellboundbloggers.com/2010/07/10/find-facebook-profile-and-page-id/">more Info</a>)', 'theme'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" />
</p>
<?php 
}
	} //end class

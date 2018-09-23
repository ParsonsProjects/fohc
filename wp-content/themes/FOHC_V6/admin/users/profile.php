<?php 
// http://kempwire.com/wordpress-users-plugin

// add_filter('the_content', 'wpu_get_users', 1);

function wpu_get_users() {  
			
	if(isset($_GET['uid'])) {
		display_user();	
	} else {
		echo $content;
		display_user_list();
	}

}

function wpu_get_roles()
{
	global $wpdb;

	$searches = array();
	
	// Find all users
	$roles = array('administrator', 'editor', 'member', 'captain');

	foreach ( $roles as $role )
		$searches[] = "$wpdb->usermeta.meta_key = '{$wpdb->prefix}capabilities' AND $wpdb->usermeta.meta_value LIKE '%$role%'";
		
	//create a string for use in a MySQL statement
	$meta_values = implode(' OR ', $searches);
	
	return $meta_values;

}

function display_user_list() {

	$path = explode("/", $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);

	// if $_GET['page'] defined, use it as page number
	if(isset($_GET['page']) || $path['2'] != '') {
	    $page = ($_GET['page'] != '') ? $_GET['page'] : $path['2'];
	} else {
		// by default we show first page
		$page = 1;
	}
	$limit = '30';
	
	// counting the offset
	$offset = ($page - 1) * $limit;
	
	// Get the authors from the database ordered by user nicename
	global $wpdb;
	$meta_values = wpu_get_roles();
	
	
	$query = "SELECT $wpdb->users.ID, $wpdb->users.user_nicename FROM $wpdb->users INNER JOIN $wpdb->usermeta ON $wpdb->users.ID = $wpdb->usermeta.user_id WHERE $meta_values ORDER BY $wpdb->users.user_nicename LIMIT $offset, $limit";
	
	$author_ids = $wpdb->get_results($query);
    $output = '';

	// Loop through each author
	foreach($author_ids as $author) {

		// Get user data
		$curauth = get_userdata($author->ID);
		$output .= get_user_listing($curauth);
	}
         
	echo $output;

	// how many rows we have in database
	$totalitems = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users WHERE ID = ANY (SELECT user_id FROM $wpdb->usermeta WHERE $meta_values)");

	$adjacents = 3;

	$concat = wpu_concat_index();

	echo getPaginationString($page, $totalitems, $limit, $adjacents, $concat);
}

function getPaginationString($page = 1, $totalitems, $limit = 15, $adjacents = 1, $concat)
{		
	//defaults
	if(!$adjacents) $adjacents = 1;
	if(!$limit) $limit = 15;
	if(!$page) $page = 1;
	
	//other vars
	$prev = $page - 1;									//previous page is page - 1
	$next = $page + 1;									//next page is page + 1
	$lastpage = ceil($totalitems / $limit);				//lastpage is = total items / items per page, rounded up.
	$lpm1 = $lastpage - 1;								//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"wpu-pagination\"";
		$pagination .= ">";

		//previous button
		if ($page > 1) 
			$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$prev\">« prev</a>";
		else
			$pagination .= "<span class=\"wpu-disabled\">« prev</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination .= "<span class=\"wpu-current\">$counter</span>";
				else
					$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage >= 7 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 3))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"wpu-current\">$counter</span>";
					else
						$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$counter\">$counter</a>";					
				}
				$pagination .= "<span class=\"wpu-elipses\">...</span>";
				$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$lpm1\">$lpm1</a>";
				$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination .= "<a href=\"" . get_permalink() . $concat . "page=1\">1</a>";
				$pagination .= "<a href=\"" . get_permalink() . $concat . "page=2\">2</a>";
				$pagination .= "<span class=\"wpu-elipses\">...</span>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"wpu-current\">$counter</span>";
					else
						$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$counter\">$counter</a>";					
				}
				$pagination .= "...";
				$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$lpm1\">$lpm1</a>";
				$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination .= "<a href=\"" . get_permalink() . $concat . "page=1\">1</a>";
				$pagination .= "<a href=\"" . get_permalink() . $concat . "page=2\">2</a>";
				$pagination .= "<span class=\"wpu-elipses\">...</span>";
				for ($counter = $lastpage - (1 + ($adjacents * 3)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination .= "<span class=\"wpu-current\">$counter</span>";
					else
						$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination .= "<a href=\"" . get_permalink() . $concat . "page=$next\">next »</a>";
		else
			$pagination .= "<span class=\"wpu-disabled\">next »</span>";
		$pagination .= "</div>\n";
	}
	
	return $pagination;

}

function wpu_concat_index()
{
	$url = $_SERVER['REQUEST_URI'];
	$permalink = get_permalink(get_the_id());
	
	if(strpos($permalink, '?'))
		return '&';
	else
		return '?';
}

function wpu_concat_single()
{
	$url = $_SERVER['REQUEST_URI'];
	$permalink = get_permalink(get_the_id());
	
	if(strpos($permalink, '?'))
		return '&';
	else
		return '?';
}

function get_user_listing($curauth) {  
	global $post;
	$concat = wpu_concat_single();
	
	$html = "<div id=\"wpu-users\">\n";
		$html .= "<div class=\"wpu-user clearfix\">\n";
		$html .= "<a href=\"" . get_permalink($post->ID) . $concat . "uid=$curauth->ID\" title=\"$curauth->display_name\">" . get_avatar( $curauth->ID, 62 ) . "</a>";
		$html .= "<div class=\"wpu-name\"><a href=\"" . get_permalink($post->ID) . $concat . "uid=$curauth->ID\" title=\"$curauth->display_name\">$curauth->display_name</a></div>\n";
		$html .= "<div class=\"wpu-action\"><a class='btn' href=\"" . get_permalink($post->ID) . $concat . "uid=$curauth->ID\" title=\"$curauth->display_name\">View</a></div>\n";
		$html .= "</div>";
	$html .= "</div>";
	return $html;
}

function display_user() {  
	global $post;
	
	if (isset($_GET['uid'])) {
		$uid = $_GET['uid'];
		$curauth = get_userdata($uid);
	}

	$concat = wpu_concat_single();
	$current_user = wp_get_current_user();

	if ( $curauth ) {
		$recent_posts = get_posts( array( 'numberposts' => 10, 'author' => $curauth->ID ) );
		$recent_comments = wpu_recent_comments($uid);
		$created = date("F jS, Y", strtotime($curauth->user_registered));

		$html = "<div class='clearfix column grid_7'><a class='pull-left btn btn-danger' href=" . get_permalink($post->ID) . ">&laquo; Back to all users</a>\n";
		
			if($curauth->ID == $current_user->ID){
				$html .= '<a class="btn pull-right" href="' . get_edit_user_link( $curauth->ID ) . '">Edit Profile</a>';
			}

		$html .= "</div>";

		$html .= "<div class='column grid_2'>";

			$html .= "<div class='user-avatar'>" . get_avatar( $curauth->ID, 177 ) . "</div>";

			$html .= "<div class='user-events'>\n";

				$html .= "<h3>Events</h3>\n";

				$html .= "<ul>";
				$myposts = get_posts('post_type=events');
				foreach ( $myposts as $post ) : setup_postdata( $post ); 


					$post_meta 				= get_post_meta($post_id, '_event_users', true);
					$event_time 			= get_post_meta($post_id, '_event_start_time', true);

					// Times
                    $past_date              = strtotime($event_time);
                    $datdiff                = _date_diff($past_date, time());
                    $date_passed            = $datdiff['invert'];      

                    if($date_passed == '1') {
						if(in_array($curauth->ID, $post_meta)) {
							$html .= "<li><a href=\"" . get_permalink() . "\">" . get_the_title($post->ID) . "</a></li>\n";
						}
					}

				endforeach; 
				wp_reset_postdata();
				$html .= "</ul>";

			$html .= "</div>";

		$html .= "</div>";

		$html .= "<div class='column grid_5'>";
		
			$html .= "<h1>$curauth->display_name</h1>\n";
			
			$html .= "<div class='user-joined'><strong>Joined on:</strong>  " . $created . "</div>";

			$user_position = get_the_author_meta( '_user_position', $curauth->ID );
			$html .= "<div class='user-position'><strong>Position:</strong>  " . $user_position . "</p>";
			
			if ($curauth->description) {
				$html .= "<div class='user-profile'><p><strong>Profile:</strong></p>\n";
				$html .= "<p>$curauth->description</div>\n";
			}

			$html .= "<div class='user-teams'>\n";

				$teams = get_the_author_meta( '_user_teams', $curauth->ID );
				if(!empty($teams)) {
					$html .= "<h3>Teams</h3>\n";

					$html .= "<ul>";
					foreach ( $teams as $team ) {

						$tag_name = get_term_by( 'id', $team, 'event_categories' );
						$html .= "<li><a href=\"" . get_permalink($post->ID) . $concat . "team=$team\" title=\"$curauth->display_name\">" . $tag_name->name. "</a></li>\n";

					}
					$html .= "</ul>";
				}

			$html .= "</div>";

			/*	
			$html .= "<div class='user-comments'>\n";

				$html .= "<h3>Recent Comments by $curauth->display_name</h3>\n";
				$html .= "<ul>\n";
				foreach($recent_comments as $key=>$comment)
				{
					$html .= "<li>\"" . $comment->comment_content . "\" on <a href=" . get_permalink($comment->comment_post_ID) . "#comment-" . $comment->comment_ID . ">" . get_the_title($comment->comment_post_ID) . "</a></li>";
				}
				$html .= "</ul>\n";

			$html .= "</div>";
			*/

		$html .= "</div>";
		
		echo "<div class=\"row\" id=\"wpu-profile\">";
		echo $html;
		echo "</div>";
	}

}

function wpu_recent_comments($uid)
{
	global $wpdb;
	
	$comments = $wpdb->get_results( $wpdb->prepare("SELECT comment_ID, comment_post_ID, SUBSTRING(comment_content, 1, 150) AS comment_content
	FROM $wpdb->comments
	WHERE user_id = %s
	ORDER BY comment_ID DESC
	LIMIT 10
	", $uid ) );

	return $comments;
}

function noindex_users() {
	if(is_page(get_option('wpu_page_id')) && get_option('wpu_noindex_users') == 'yes') {
		if($_GET['uid'] == "")
			echo '	<meta name="robots" content="noindex, follow"/>
			';
	}
}
?>
<?php

// Generates the title of the page depending on what page it is
function bones_title() {
	
	if (is_single()) { wp_title(''); echo (' | '); bloginfo('name');
	} else if (is_page() || (is_page() && is_paged())) { if (is_front_page()) { bloginfo('name'); } else { bloginfo('name'); echo (' | '); wp_title(''); if(is_paged()) echo ' |  page '.get_query_var('paged'); }
	} else if (is_author()) { bloginfo('name'); wp_title(' | '. 'Author');		  
	} else if (is_category()) { bloginfo('name'); wp_title(' | '.'Browsing the category '.' ');	
	} else if (is_tag()) { bloginfo('name'); echo (' | '.'Browsing the tag archive for'.' '); wp_title('');	
	} else if (is_archive()) { bloginfo('name'); echo (' | '.'Browsing the archive for'.' '); wp_title('');	
	} else if (is_search()) { bloginfo('name'); echo (' | '.'Search Results');	 
	} else if (is_404()) { bloginfo('name'); echo (' | '.'404 Error - Page Not Found');		  
	} else if (is_home()) { bloginfo('name'); echo (' | '); bloginfo('description'); if (is_paged()) echo ' |  page '.get_query_var('paged');		
	} else { bloginfo('name');		  
	}
}

// Generates head meta information to improve search engine optimization
function bones_header_meta() { 

	global $post;
	
	if(is_home()) { echo '<meta name="description" content="'.get_bloginfo('description').'" />'; } 
	if(is_single()) { 
		echo '<meta name="keywords" content="';
		$metatags = get_the_tags($post->ID);
		if ($metatags) { 
			$i = 0;
			foreach ($metatags as $tagpost) {
				$mymetatag = apply_filters('the_tags',$tagpost->name);
				$keyword = ($mymetatag);
				if ($i > 0) echo ", "; $i++;
				echo $keyword;
		}
		} else {
			$i = 0;
			foreach((get_the_category()) as $category) { 
				if ($i > 0) echo ", "; $i++;
				echo $category->cat_name;			
			}		
		} 	
		echo '" />';
	}
	if(is_search()) { echo '<meta name="robots" content="noindex, nofollow" />'; }
		
}

// Adds a favicon to the theme to be displayed in the browser's address bar/tabs/etc.
function bones_favicons() {
?>
<!-- icons & favicons -->
<!-- For iPhone 4 -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/images/ico/apple-touch-icon-114x114-precomposed.png">
<!-- For iPad 1-->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/images/ico/apple-touch-icon-72x72-precomposed.png">
<!-- For iPhone 3G, iPod Touch and Android -->
<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/images/ico/apple-touch-icon-precomposed.png">
<!-- For Nokia -->
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/ico/apple-touch-icon.png">
<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">
<?php
}
add_action('wp_head', 'bones_favicons');
?>
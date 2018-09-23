<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

/*********************
LAUNCH BONES
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************/

// we're firing all out initial functions at the start
add_action('after_setup_theme','bones_ahoy', 15);

function bones_ahoy() {

    // launching operation cleanup
    add_action('init', 'bones_head_cleanup');
    // remove WP version from RSS
    add_filter('the_generator', 'bones_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action('wp_head', 'bones_remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'bones_gallery_style');

    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'bones_scripts_and_styles', 999);
    // ie conditional wrapper
    add_filter( 'style_loader_tag', 'bones_ie_conditional', 10, 2 );

    // launching this stuff after theme setup
    add_action('after_setup_theme','bones_theme_support');
    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'bones_register_sidebars' );
    // adding the bones search form (created in functions.php)
    add_filter( 'get_search_form', 'bones_wpsearch' );

    // cleaning up random code around images
    add_filter('the_content', 'bones_filter_ptags_on_images');
    // cleaning up excerpt
    add_filter('excerpt_more', 'bones_excerpt_more');
	
	add_filter('wp_list_categories', 'bones_cat_filter');
	add_filter('get_archives_link', 'bones_archive_filter');

} /* end bones ahoy */

if ( ! isset( $content_width ) ) $content_width = 900;

// Wraps the post count in <span> tags in WordPress stock widgets for styling
function bones_cat_filter($variable) {
	$variable = str_replace('(', '<span class="post-count"> ', $variable);
	$variable = str_replace(')', ' </span>', $variable);
   	return $variable;
}

// Wraps the post count in <span> tags in WordPress stock widgets for styling
function bones_archive_filter($links) {
	$links = str_replace('(', '<span class="post-count"> ', $links);
	$links = str_replace(')', ' </span>', $links);
	return $links;
}

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {
  if (!is_admin()) {
	
	// register jquery
	wp_deregister_script('jquery');
	wp_register_script( 'jquery', get_template_directory_uri() . '/library/js/assets/jquery-1.8.3.min.js', array(), '1.8.3', false );
	wp_register_script( 'jquery-ui', get_template_directory_uri() . '/library/js/assets/jquery-ui-1.10.0.custom.min.js', array( 'jquery' ), '1.10.0', true );
	
    // modernizr (without media query polyfill)
    wp_register_script( 'bones-modernizr', get_template_directory_uri() . '/library/js/assets/modernizr-2.6.1-respond-1.1.0.min.js', array(), '2.6.1', false );

    // register main stylesheets
	wp_register_style( 'mormalize', get_template_directory_uri() . '/library/css/normalize.css', array(), '', 'all' );
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/library/css/bootstrap.css', array(), '', 'all' );
	wp_register_style( 'responsive', get_template_directory_uri() . '/library/css/responsive.css', array(), '', 'all' );
    wp_register_style( 'default', get_template_directory_uri() . '/library/css/default.css', array(), '', 'all' );
	wp_register_style( 'bones-ie-only', get_template_directory_uri() . '/library/css/ie/ie7.css', array(), 'all' );
	wp_register_style( 'reveal', get_template_directory_uri() . '/library/css/assets/reveal.css', array(), 'all' );
	wp_register_style( 'lightbox2-css', get_template_directory_uri() . '/admin/assets/css/lightbox.css', array(), 'all' );
	
	// register home page stylesheets
	wp_register_style( 'bones-flexslider.min', get_template_directory_uri() . '/library/css/assets/flexslider.css', array(), '', 'all' );
	
    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

    // adding scripts file in the footer
	wp_register_script( 'bones-plugins', get_template_directory_uri() . '/library/js/plugins.js', array( 'jquery' ), '', true );
	wp_register_script( 'bones-main', get_template_directory_uri() . '/library/js/main.js', array( 'jquery', 'bones-plugins' ), '', true );
	wp_register_script( 'mobile-menu', get_template_directory_uri() . '/library/js/assets/jquery.touchdown.js', array( 'jquery' ), '', true );
	wp_register_script( 'jquery-reveal', get_template_directory_uri() . '/library/js/assets/jquery.reveal.js', array( 'jquery' ), '1.0', true );
	wp_register_script( 'lightbox2-js', get_template_directory_uri() . '/admin/assets/js/lightbox.js', array( 'jquery' ), '', true );
	// home page
	wp_register_script( 'js-flexslider', get_template_directory_uri() . '/library/js/assets/jquery.flexslider-min.js', array( 'jquery' ), '', false );
	wp_register_script( 'js-easing', get_template_directory_uri() . '/library/js/assets/jquery.easing.js', array( 'jquery' ), '', true );
	wp_register_script( 'js-mousewheel', get_template_directory_uri() . '/library/js/assets/jquery.mousewheel.js', array( 'jquery' ), '', true );
	wp_register_script( 'js-tweet', get_template_directory_uri() . '/library/js/assets/jquery.tweet.js', array( 'jquery' ), '', true );

    // enqueue styles and scripts
    wp_enqueue_script( 'bones-modernizr' );
    wp_enqueue_style( 'normalize' );
	wp_enqueue_style( 'bootstrap' );
	wp_enqueue_style( 'default' );
	wp_enqueue_style( 'responsive' );
	wp_enqueue_style( 'reveal' );
	wp_enqueue_style( 'bones-ie-only' );
	
    /*
    I recommend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
    wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui' );
	wp_enqueue_script( 'mobile-menu' );
	wp_enqueue_script( 'jquery-reveal' );
    wp_enqueue_script( 'bones-plugins' );
	wp_enqueue_script( 'bones-main' );
	
	if ( is_front_page() ){
		wp_enqueue_script( 'js-flexslider' );
		wp_enqueue_style( 'bones-flexslider.min' );
		wp_enqueue_script( 'js-easing' );
		wp_enqueue_script( 'js-mousewheel' );
		wp_enqueue_script( 'js-tweet' );
	}
	
	if ( is_active_widget(false, false, 'gallery', true) ) {
		wp_enqueue_script( 'lightbox2-js' );
		wp_enqueue_style( 'lightbox2-css' );
	}
	
  }
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function bones_ie_conditional( $tag, $handle ) {
	if ( 'bones-ie-only' == $handle )
		$tag = '<!--[if lt IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
	return $tag;
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	// add_theme_support('post-thumbnails');

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	/*add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',  // background image default
	    'default-color' => '', // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);*/

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	/* add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	); */

	// wp menus
	add_theme_support( 'menus' );

} /* end bones theme support */

function register_my_menus() {
  register_nav_menus(
    array(
      	'main-nav' => __( 'The Main Menu', 'bonestheme' ),   // main nav in header
		'members-nav' => __( 'Members Links', 'bonestheme' ), 
		'guest-nav' => __( 'Guest Links', 'bonestheme' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

/*********************
MENUS & NAVIGATION
*********************/

// the main menu
function bones_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => 'nav',                           // nav container
    	'container_class' => 'nav',           // class of container (should you choose to use it)
    	'menu' => 'The Main Menu',                      // nav name
    	'menu_class' => 'main-nav web-only clearfix',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'bones_main_nav_fallback'      // fallback function
	));
} /* end bones main nav */

function members_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => 'nav',                           // nav container
    	'container_class' => 'links',           // class of container (should you choose to use it)
    	'menu' => 'Members Links',                      // nav name
    	'menu_class' => 'members-nav web-only clearfix',         // adding custom nav class
    	'theme_location' => 'members-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'bones_main_nav_fallback'      // fallback function
	));
} 

function guest_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => 'nav',                           // nav container
    	'container_class' => 'links',           // class of container (should you choose to use it)
    	'menu' => 'Guest Links',                      // nav name
    	'menu_class' => 'guest-nav web-only clearfix',         // adding custom nav class
    	'theme_location' => 'guest-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'bones_main_nav_fallback'      // fallback function
	));
} 

// this is the fallback for header menu
function bones_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => 'nav',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             // after each link
	) );
}

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi($pages = '', $range = 2) {  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'><ol>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a title='First' href='".get_pagenum_link(1)."'>&laquo;</a></li>";
         if($paged > 1 && $showitems < $pages) echo "<li><a title='Prev' href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<li><span class='current'>".$i."</span></li>":"<li><a title='Page ".$i."' href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<li><a title='Next' href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a title='Last' href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
         echo "</ol></div>\n";
     }
}

 
/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function bones_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function bones_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

?>

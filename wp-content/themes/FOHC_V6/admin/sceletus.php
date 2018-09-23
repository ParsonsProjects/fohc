<?php 
add_action('after_setup_theme','setup_sceletus', 15);

function setup_sceletus() {

    // launching operation cleanup
    add_action('init', 'sceletus_head_cleanup');
    // remove WP version from RSS
    add_filter('the_generator', 'sceletus_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'sceletus_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action('wp_head', 'sceletus_remove_recent_comments_style', 1);

    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'sceletus_scripts_and_styles', 999);
    // launching this stuff after theme setup
    add_action('after_setup_theme','sceletus_theme_support');
    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'sceletus_register_sidebars' );
    // adding the bones search form (created in functions.php)
    add_filter( 'get_search_form', 'sceletus_wpsearch' );

    // cleaning up random code around images
    add_filter('the_content', 'sceletus_filter_ptags_on_images');

}


/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function sceletus_head_cleanup() {
    // category feeds
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    // post and comment feeds
    remove_action( 'wp_head', 'feed_links', 2 );
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
    add_filter( 'style_loader_src', 'sceletus_remove_wp_ver_css_js', 9999 );
    // remove Wp version from scripts
    add_filter( 'script_loader_src', 'sceletus_remove_wp_ver_css_js', 9999 );

} /* end head cleanup */

// remove WP version from RSS
function sceletus_rss_version() { return ''; }

// remove WP version from scripts
function sceletus_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function sceletus_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function sceletus_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function sceletus_scripts_and_styles() {
    if (!is_admin()) {

        // register scripts
        wp_deregister_script('jquery');
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/vendor/jquery-1.8.3.min.js', array(), '1.8.3', false );
        wp_register_script( 'html5shiv', get_template_directory_uri() . '/js/vendor/html5shiv.js', array(), '', false );
        wp_register_script( 'cookie-js', get_template_directory_uri() . '/js/vendor/jquery.cookie.js', array( 'jquery' ), '', true );
        wp_register_script( 'owl-js', get_template_directory_uri() . '/js/vendor/owl.carousel.min.js', array( 'jquery' ), '', true );
        wp_register_script( 'mains-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '', true );

        wp_register_script( 'jquery-ui', get_template_directory_uri() . '/js/vendor/jquery-ui.custom.min.js', array(), '', false );
        wp_register_script( 'fullcalendar', get_template_directory_uri() . '/js/vendor/fullcalendar.min.js', array(), '', false );

        wp_register_script( 'ajax-js', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ), '', true );
        wp_localize_script( 'ajax-js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
        
        // enqueue scripts
        wp_enqueue_script( 'html5shiv' );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'cookie-js' );
        wp_enqueue_script( 'owl-js' );
        wp_enqueue_script( 'mains-js' );
        wp_enqueue_script( 'ajax-js' );

        wp_enqueue_script( 'jquery-ui' );
        wp_enqueue_script( 'fullcalendar' );

        // register styles
        wp_register_style( 'theme', get_template_directory_uri() . '/css/theme.css', array(), '1.1', 'screen' );

        wp_register_style( 'fullcalendar', get_template_directory_uri() . '/css/vendor/fullcalendar.css', array(), '1.6.4', 'screen' );
        wp_register_style( 'fullcalendar-print', get_template_directory_uri() . '/css/vendor/fullcalendar.print.css', array(), '1.6.4', 'print' );

        // enqueue styles
        wp_enqueue_style( 'theme' );

        wp_enqueue_style( 'fullcalendar' );
        wp_enqueue_style( 'fullcalendar-print' );

    }
}


/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function sceletus_theme_support() {

    // rss thingy
    add_theme_support('automatic-feed-links');

    // wp menus
    add_theme_support( 'menus' );

    // registering wp3+ menus
    register_nav_menus(
        array(
            'primary-nav' => __( 'Primary Navigation', 'sceletustheme' ),   // main nav in header
            'downloads' => __( 'Downloads', 'sceletustheme' ), // secondary nav in footer
            'members-links' => __( 'Members Links', 'sceletustheme' ), // secondary nav in footer
            'guest-links' => __( 'Guest Links', 'sceletustheme' ) // secondary nav in footer
        )
    );

}

add_action( 'init', 'sceletus_theme_support' );

/*********************
MENUS & NAVIGATION
*********************/

// the main menu
function sceletus_primary_nav() {
    // display the wp3 menu if available
    wp_nav_menu(array(
        'container'         => 'nav',                               // nav container
        'container_class'   => 'nav-collapse-scrollable navbar',    // class of container (should you choose to use it)
        'menu'              => 'Primary Navigation',                // nav name
        'menu_class'        => 'clearfix',                          // adding custom nav class
        'theme_location'    => 'primary-nav',                       // where it's located in the theme
        'before'            => '',                                  // before the menu
        'after'             => '',                                  // after the menu
        'link_before'       => '<span>',                            // before each link
        'link_after'        => '</span>',                           // after each link
        'depth'             => 0,                                   // limit the depth of the nav
        'fallback_cb'       => 'sceletus_nav_fallback'              // fallback function
    ));
} /* end nav */

function sceletus_downloads() {
    // display the wp3 menu if available
    wp_nav_menu(array(
        'container' => 'nav',                                       // nav container
        'container_class' => 'nav',                                 // class of container (should you choose to use it)
        'menu' => 'Downloads',                                      // nav name
        'menu_class' => 'clearfix',                                 // adding custom nav class
        'theme_location' => 'downloads',                            // where it's located in the theme
        'before' => '',                                             // before the menu
        'after' => '',                                              // after the menu
        'link_before' => '<span>',                                  // before each link
        'link_after' => '</span>',                                  // after each link
        'depth' => 0,                                               // limit the depth of the nav
        'fallback_cb' => 'sceletus_nav_fallback'                    // fallback function
    ));
} /* end nav */

function sceletus_members_links() {
    // display the wp3 menu if available
    wp_nav_menu(array(
        'container' => 'nav',                                       // nav container
        'container_class' => 'links',                               // class of container (should you choose to use it)
        'menu' => 'Members Links',                                  // nav name
        'menu_class' => 'clearfix',                                 // adding custom nav class
        'theme_location' => 'members-links',                        // where it's located in the theme
        'before' => '',                                             // before the menu
        'after' => '',                                              // after the menu
        'link_before' => '<span>',                                  // before each link
        'link_after' => '</span>',                                  // after each link
        'depth' => 0,                                               // limit the depth of the nav
        'fallback_cb' => 'sceletus_nav_fallback'                    // fallback function
    ));
} /* end nav */

function sceletus_guest_links() {
    // display the wp3 menu if available
    wp_nav_menu(array(
        'container' => 'nav',                                       // nav container
        'container_class' => 'links',                               // class of container (should you choose to use it)
        'menu' => 'Guest Links',                                    // nav name
        'menu_class' => 'clearfix',                                 // adding custom nav class
        'theme_location' => 'guest-links',                          // where it's located in the theme
        'before' => '',                                             // before the menu
        'after' => '',                                              // after the menu
        'link_before' => '<span>',                                  // before each link
        'link_after' => '</span>',                                  // after each link
        'depth' => 0,                                               // limit the depth of the nav
        'fallback_cb' => 'sceletus_nav_fallback'                    // fallback function
    ));
} /* end nav */


// this is the fallback for header menu
function sceletus_nav_fallback() {
    wp_page_menu( array(
        'show_home' => true,
        'menu_class' => 'nav-collapse-scrollable navbar clearfix',     // adding custom nav class
        'include'     => '',
        'exclude'     => '',
        'echo'        => true,
        'link_before' => '<span>',                                   // before each link
        'link_after' => '</span>'                             // after each link
    ) );
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function sceletus_register_sidebars() {
    
    // Left Sidebar
    register_sidebar(array(
        'id' => 'sidebar-left',
        'name' => 'Sidebar Left',
        'description' => 'This is the theme default left sidebar that appears on the homepage, archives, search, 404 and any page whose specific sidebars are empty.',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    // Right Sidebar
    register_sidebar(array(
        'id' => 'sidebar-right',
        'name' => 'Sidebar Right',
        'description' => 'This is the theme default right sidebar that appears on the homepage, archives, search, 404 and any page whose specific sidebars are empty.',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Single Left Sidebar
    register_sidebar(array(
        'name' => 'Single Post Left Sidebar',
        'id' => 'single-sidebar-left',
        'description' => 'This is left sidebar that appears on the single post page.',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Single Right Sidebar
    register_sidebar(array(
        'name' => 'Single Post Right Sidebar',
        'id' => 'single-sidebar-right',
        'description' => 'This is right sidebar that appears on the single post page.',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Page Left Sidebar
    register_sidebar(array(
        'name' => 'Page Left Sidebar',
        'id' => 'page-sidebar-left',
        'description' => 'This is left sidebar that appears on all pages including the "regular" width page and extra-width page.',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    
    // Page Right Sidebar
    register_sidebar(array(
        'name' => 'Page Right Sidebar',
        'id' => 'page-sidebar-right',
        'description' => 'This is right sidebar that appears on all pages including the "regular" width page.',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '<div class="clear"></div></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

}

/************* COMMENT LAYOUT *********************/
        
// Comment Layout
function sceletus_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?>>
        <article id="comment-<?php comment_ID(); ?>" class="clearfix">
            <header class="comment-author vcard">
                <?php 
                /*
                    this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
                    echo get_avatar($comment,$size='32',$default='<path_to_url>' );
                */ 
                ?>
                <!-- custom gravatar call -->
                <?php
                    // create variable
                    $bgauthemail = get_comment_author_email();
                ?>
                <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/inc/lib/images/nothing.gif" />
                <!-- end custom gravatar call -->
                <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                <?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
            </header>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="alert info">
                    <p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
                </div>
            <?php endif; ?>
            <section class="comment_content clearfix">
                <?php comment_text() ?>
            </section>
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function sceletus_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function sceletus_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
?>
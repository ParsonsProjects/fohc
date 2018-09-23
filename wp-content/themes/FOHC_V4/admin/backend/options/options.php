<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	// General Array
	$general_options = array(
		'breadcrumbs' => __('Breadcrumbs', 'options_framework_theme'),
		'top_nav' => __('Top Nav', 'options_framework_theme'),
		'menu_search' => __('Menu Search', 'options_framework_theme'),
		'pagination' => __('Pagination', 'options_framework_theme')
	);

	// General Defaults
	$general_defaults = array(
		'breadcrumbs' => '1',
		'top_nav' => '1',
		'menu_search' => '1',
		'pagination' => '1'
	);
	
	// Banner Options
	$banner_fx = array(
		'slide' => __('Slide', 'options_framework_theme'),
		'fade' => __('Fade', 'options_framework_theme')
	);
	
	$banner_directions = array(
		'horizontal' => __('Horizontal', 'options_framework_theme'),
		'vertical' => __('Vertical', 'options_framework_theme')
	);
	
	$banner_easing = array(
		'jswing' => __('jswing', 'options_framework_theme'),
		'def' => __('def', 'options_framework_theme'),
		'easeInQuad' => __('easeInQuad', 'options_framework_theme'),
		'easeOutQuad' => __('easeOutQuad', 'options_framework_theme'),
		'easeInOutCubic' => __('easeInOutCubic', 'options_framework_theme'),
		'easeInOutQuad' => __('easeInOutQuad', 'options_framework_theme'),
		'easeInCubic' => __('easeInCubic', 'options_framework_theme'),
		'easeOutCubic' => __('easeOutCubic', 'options_framework_theme'),
		'easeOutQuart' => __('easeOutQuart', 'options_framework_theme'),
		'easeInOutQuart' => __('easeInOutQuart', 'options_framework_theme')
	);
	
	$banner_options = array(
		'banner_nav' => __('Banner Nav', 'options_framework_theme'),
		'direction_nav' => __('Direction Nav', 'options_framework_theme'),
		'pause_on_hover' => __('Pause On Hover', 'options_framework_theme')
	);
	
	$banner_defaults = array(
		'direction_nav' => '1'
	);
		
	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	$options_pages_multicheck = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	foreach ($options_pages_obj as $page) {
		$options_pages_multicheck[$page->ID] = $page->post_title;
	}
	
	/* Get Stylesheets into a drop-down list */
	$styles = array();
	if(is_dir(TEMPLATEPATH . "/library/css/themes/")) {
		if($open_dirs = opendir(TEMPLATEPATH . "/library/css/themes/")) {
			while(($style = readdir($open_dirs)) !== false) {
				if(stristr($style, ".css") !== false) { 
					$style = preg_replace("/\\.[^.\\s]{3,4}$/", "", ucfirst($style));
					$style_value = strtolower($style);
					$styles[$style_value] = $style;
				}
			}
		}
	}
	$style_dropdown = array_unshift($styles, "Choose a colour scheme:");

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/backend/options/assets/images/';

	$options = array();
	
	
	// General Options
	
	$options[] = array(
		'name' => __('Options', 'options_framework_theme'),
		'icon' => 'icon-cog',
		'type' => 'tab');
		
		$options[] = array(
			'name' => __('Scrolling News', 'options_framework_theme'),
			'desc' => __('Type the latest news here to appear on the homepage', 'options_framework_theme'),
			'id' => 'scolling_news',
			'std' => '',
			'type' => 'textarea');	
			
	$options[] = array(
		'name' => __('Results', 'options_framework_theme'),
		'icon' => 'icon-signal',
		'type' => 'tab');
		
		include  dirname( __FILE__ ) . '/theme_options/options-results.php';	
		
	$options[] = array(
		'name' => __('Games', 'options_framework_theme'),
		'icon' => 'icon-time',
		'type' => 'tab');
		
		include  dirname( __FILE__ ) . '/theme_options/options-games.php';	
				
	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}
	
	$( ".sortable" ).sortable({
		placeholder: "ui-state-highlight",
		axis: "y"
	});
	$( ".sortable" ).sortable({
		cancel: ".ui-state-disabled"
	});
	$( ".sortable li" ).disableSelection(); 

});
</script>

<?php
}
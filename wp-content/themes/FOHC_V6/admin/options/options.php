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
	

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/backend/options/assets/images/';

	$options = array();
	
	
	// General Options
	
	$options[] = array(
		'name' => __('Options', 'options_framework_theme'),
		'icon' => 'icon-cog',
		'type' => 'tab');
		
		$options[] = array(
			'name' => __('Flash News', 'options_framework_theme'),
			'desc' => __('Type the latest news here to appear on the homepage', 'options_framework_theme'),
			'id' => 'scolling_news',
			'std' => '',
			'type' => 'textarea');	

		$options[] = array(
			'name' => __('Twitter URL', 'options_framework_theme'),
			'desc' => __('', 'options_framework_theme'),
			'id' => 'twitter_url',
			'std' => '',
			'type' => 'text');

		$options[] = array(
			'name' => __('Facebook URL', 'options_framework_theme'),
			'desc' => __('', 'options_framework_theme'),
			'id' => 'facebook_url',
			'std' => '',
			'type' => 'text');
			
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

	$options[] = array(
		'name' => __('Training Times', 'options_framework_theme'),
		'icon' => 'icon-time',
		'type' => 'tab');
		
		include  dirname( __FILE__ ) . '/theme_options/options-training.php';	
				
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
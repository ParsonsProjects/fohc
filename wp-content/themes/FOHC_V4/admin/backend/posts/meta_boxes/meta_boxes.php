<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'theme_metabox_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'post-thumbnails',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Post Thumbnails',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'low',

	// List of meta fields
	'fields' => array(
		// IMAGE UPLOAD
		array(
			'name'	=> 'Post Thumbnail',
			'desc'	=> 'Upload a listing thumbnail',
			'id'	=> "{$prefix}thumbnail",
			'type'	=> 'thickbox_image',
		),
		
		// SELECT BOX
		array(
			'name'		=> 'Video embed Type',
			'id'		=> "{$prefix}video_type",
			'type'		=> 'select',
			// Array of 'key' => 'value' pairs for select box
			'options'	=> array(
				'youtube'		=> 'Youtube',
				'vimeo'			=> 'Vimeo',
				'dailymotion'	=> 'Daily Motion'
			),
			// Select multiple values, optional. Default is false.
			'multiple'	=> false,
			// Default value, can be string (single value) or array (for both single and multiple values)
			'std'		=> array( 'youtube' ),
			'desc'		=> 'Select the type of video you want to embed as a thumbnail'
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'		=> 'Clip ID',
			// Field ID, i.e. the meta key
			'id'		=> $prefix . 'clip_id',
			// Field description (optional)
			'desc'		=> 'ex: http://www.youtube.com/watch?v=sdUUx5FdySs the id is "sdUUx5FdySs".',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone'		=> false,
			'type'		=> 'text',
			// Default value (optional)
			'std'		=> ''
		)
	)
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function theme_metabox_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'theme_metabox_register_meta_boxes' );

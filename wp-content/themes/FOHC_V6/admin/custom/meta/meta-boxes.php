<?php

add_filter( 'cmb_meta_boxes', 'cmb_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_event_';

	$meta_boxes[] = array(
		'id'         => 'event_details',
		'title'      => 'Event Details',
		'pages'      => array( 'events' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Event Date and Time',
				'desc' => '',
				'id'   => $prefix . 'match_title',
				'type' => 'title',
			),
			array(
				'name' => 'Hide on Calendar',
				'desc' => 'Hide this event from the calendar (optional)',
				'id'   => $prefix . 'hide_calendar',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Event Colour',
				'desc' => '(optional)',
				'id'   => $prefix . 'colour',
				'type' => 'colorpicker',
			),
			array(
				'name' => 'All Day Event',
				'desc' => 'All day event (optional)',
				'id'   => $prefix . 'all_day',
				'type' => 'checkbox',
			),
			array(
	            'name' => 'Start Date',
	            'desc' => 'The event start time',
	            'id'   => $prefix . 'start_time',
	            'type' => 'text_datetime_timestamp',
	        ),
	        array(
	            'name' => 'End Date',
	            'desc' => 'The event end time',
	            'id'   => $prefix . 'end_time',
	            'type' => 'text_datetime_timestamp',
	        ),
	        array(
				'name' => 'Recurring Event',
				'desc' => '',
				'id'   => $prefix . 'recurring_title',
				'type' => 'title',
			),
			array(
				'name' => 'Recurring Event',
				'desc' => 'Tick to turn on (optional)',
				'id'   => $prefix . 'recurring',
				'type' => 'checkbox',
			),
			array(
				'name' => 'Recurring Pattern',
				'desc' => 'When the event will recur',
				'id' => $prefix . 'recurring_type',
				'type' => 'select',
				'options' => array(
					array( 'name' => 'Daily', 'value' => 'day', ),
					array( 'name' => 'Weekly', 'value' => 'week', ),
					array( 'name' => 'Monthly', 'value' => 'month', ),
					array( 'name' => 'Yearly', 'value' => 'year', ),
				),
			),
			array(
	            'name' => 'End Date',
	            'desc' => 'The end date for the recurring event',
	            'id'   => $prefix . 'recurring_end',
	            'type' => 'text_date',
	        ),
	        array(
				'name' => 'Event Details',
				'desc' => '',
				'id'   => $prefix . 'match_title',
				'type' => 'title',
			),
			array(
	            'name' => 'Venue',
	            'desc' => 'The event location',
	            'id'   => $prefix . 'venue',
	            'type' => 'text_medium',
	        ),
	        array(
	            'name' => 'Address',
	            'desc' => 'The event location',
	            'id'   => $prefix . 'address',
	            'type' => 'text_medium',
	        ),
	        array(
				'name' => 'Show Directions',
				'desc' => 'Show directions to location (optional)',
				'id'   => $prefix . 'show_directions',
				'type' => 'checkbox',
			),
	        /*array(
				'name' => 'Show Map',
				'desc' => 'Show google map (optional)',
				'id'   => $prefix . 'show_map',
				'type' => 'checkbox',
			),*/
	        array(
	            'name' => 'Event Price',
	            'desc' => 'The event price',
	            'id'   => $prefix . 'price',
	            'type' => 'text_money',
	        ),
	        array(
				'name' => 'Organizer contact info',
				'desc' => '',
				'id'   => $prefix . 'match_title',
				'type' => 'title',
			),
			array(
	            'name' => 'Name',
	            'desc' => '(optional)',
	            'id'   => $prefix . 'organizer',
	            'type' => 'text_medium',
	        ),
	        array(
	            'name' => 'Phone',
	            'desc' => '(optional)',
	            'id'   => $prefix . 'phone',
	            'type' => 'text_medium',
	        ),
	        array(
	            'name' => 'Email',
	            'desc' => '(optional)',
	            'id'   => $prefix . 'email',
	            'type' => 'text_medium',
	        ),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'match_details',
		'title'      => 'Match Details',
		'pages'      => array( 'events' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Only fill in below values if this is a match event',
				'desc' => 'Location and date will be taken from above fields',
				'id'   => $prefix . 'match_title',
				'type' => 'title',
			),
			array(
				'name' => 'Match Event',
				'desc' => 'Tick to confirm this is a match event (optional)',
				'id'   => $prefix . 'match',
				'type' => 'checkbox',
			),
			array(
	            'name' => 'Meet Time',
	            'desc' => 'The match meet time',
	            'id'   => $prefix . 'match_meet',
	            'type' => 'text_time',
	        ),
	        array(
	            'name' => 'Pushback',
	            'desc' => 'The match pushback time',
	            'id'   => $prefix . 'match_pushback',
	            'type' => 'text_time',
	        ),
	        array(
	            'name' => 'Opposition',
	            'desc' => 'The opposition',
	            'id'   => $prefix . 'opposition',
	            'type' => 'text_medium',
	        ),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'users',
		'title'      => 'Users',
		'pages'      => array( 'events' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Select users to email the event (optional)',
				'desc' => '',
				'id'   => $prefix . 'users_title',
				'type' => 'title',
			),
			array(
				'name' => 'Email Users',
				'desc' => '',
				'id'   => $prefix . 'users',
				'type' => 'wp_users',
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'email_users',
		'title'      => 'Email Users',
		'pages'      => array( 'events' ), // Post type
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => '',
				'desc' => 'Send email to selected users about the upcoming event. You must publish or update the event first.',
				'id'   => $prefix . 'email_title',
				'type' => 'title',
			),
			array(
				'id'   => $prefix . 'ajax_btns',
				'type' => 'btns',
				'options' => array(
					array( 'id' => 'cancel_event', 'name' => 'Cancel Event', 'class' => 'submitdelete cancel-event re_send_email', 'data' => 'data-email_type="cancel"' ),
					array( 'id' => 'email_all_users', 'name' => 'Email Users', 'class' => 'button button-primary re_send_email', 'data' => 'data-email_type="all"' ),
				),
			),
		)
	);

	return $meta_boxes;

}

add_action( 'init', 'initialize_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function initialize_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'meta.php';

}

?>